<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\LogHarian;
use Illuminate\Support\Facades\Validator;

class LogController extends Controller
{
    public function index()
    {
        $logs = LogHarian::where('user_id', auth()->user()->id)->get();
        return view('log-harian.index', compact('logs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'aktivitas' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        $log = LogHarian::create([
            'user_id' => auth()->user()->id,
            'tanggal' => $request->tanggal,
            'aktivitas' => $request->aktivitas,
        ]);

        return response()->json([
            'success' => 'Log created successfully',
            'log' => $log
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $log = LogHarian::find($id);

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'aktivitas' => 'required|string',
            'status' => 'nullable|in:Pending,Disetujui,Ditolak',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        $log->tanggal = $request->tanggal;
        $log->aktivitas = $request->aktivitas;
        $log->status = $request->status ?? 'Pending';
        $log->save();

        return response()->json([
            'success' => 'Log updated successfully',
            'log' => $log
        ], 200);
    }

    public function destroy(LogHarian $id)
    {
        $id->delete();
        return response()->json(['success' => 'LogHarian deleted successfully'], 200);
    }


    public function index_verifikasi()
    {
        $atasanId = Auth::id();
        $bawahanIds = User::where('atasan_id', $atasanId)->pluck('id');
        $logs = LogHarian::select('log_harian.*', 'users.nama as user_nama', 'roles.role_name as role_nama')
                        ->join('users', 'log_harian.user_id', '=', 'users.id')
                        ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                        ->join('roles', 'user_roles.role_id', '=', 'roles.id')
                        ->whereIn('log_harian.user_id', $bawahanIds)
                        ->orderByRaw('FIELD(log_harian.status, "Pending", "Disetujui", "Ditolak")')
                        ->get();
        return view('verifikasi.index', compact('logs'));
    }

    public function verifikasi(Request $request, $id)
    {
        $log = LogHarian::find($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Pending,Disetujui,Ditolak',
            'catatan_verifikasi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        $log->status = $request->status;
        $log->catatan_verifikasi = $request->catatan_verifikasi;
        $log->verified_by = Auth::id();
        $log->save();

        return response()->json([
            'success' => 'Log updated successfully',
            'log' => $log
        ], 200);
    }
}


