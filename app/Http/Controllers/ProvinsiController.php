<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Http;

class ProvinsiController extends Controller
{
    public function sync()
    {
        try {
            $response = Http::get('https://wilayah.id/api/provinces.json');
            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['data']) && is_array($data['data'])) {
                    foreach ($data['data'] as $provinsi) {
                        Provinsi::updateOrCreate(
                            ['code' => $provinsi['code']], 
                            ['name' => $provinsi['name']] 
                        );
                    }
                    return response()->json(['success' => 'Data provinsi berhasil disinkronisasi']);
                } else {
                    return response()->json(['error' => 'Struktur data tidak valid'], 500);
                }
            } else {
                return response()->json(['error' => 'Gagal mengambil data dari API'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function getData()
    {
        $provinsis = Provinsi::orderBy('code')->get();
        return response()->json($provinsis);
    }

    public function getDataDetail($id)
    {
        $provinsi = Provinsi::where('code', $id)->first();
        return response()->json($provinsi);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $provinsi = Provinsi::create([
            'name' => $request->name,
        ]);

        return response()->json($provinsi);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        $provinsi = Provinsi::where('code', $id)->firstOrFail();
        $provinsi->update([
            'name' => $request->name,
        ]);
    
        return response()->json($provinsi);
    }

    public function destroy($id)
    {
        $provinsi = Provinsi::where('code', $id)->firstOrFail();
        $provinsi->delete();
        
        return response()->json(['success' => 'Data provinsi berhasil dihapus']);
    }
}
