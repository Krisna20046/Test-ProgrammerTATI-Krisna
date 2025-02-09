<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['role', 'atasan'])->get();
        $atasan = User::all();
        $roles = Role::all();
        return view('user.index', compact('users', 'atasan', 'roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'atasan_id' => 'nullable|exists:users,id',
            'role_id' => 'nullable|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()
            ], 422);
        }

        try {
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'atasan_id' => $request->atasan_id
            ]);

            if ($request->role_id) {
                $user->userRole()->create([
                    'role_id' => $request->role_id,
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => 'User registered successfully',
                'token' => $token,
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to register user',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'atasan_id' => 'nullable|exists:users,id',
            'role_id' => 'nullable|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->messages()
            ], 422);
        }

        try {
            $user = User::findOrFail($id);

            $user->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'atasan_id' => $request->atasan_id,
            ]);

            if ($request->role_id) {
                UserRole::where('user_id', $user->id)->update(['role_id' => $request->role_id]);
            }

            return response()->json([
                'success' => 'User updated successfully',
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update user',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(User $id)
    {
        $id->delete();
        return response()->json(['success' => 'User deleted successfully'], 200);
    }
}

