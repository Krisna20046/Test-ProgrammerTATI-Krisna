<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('id', 'asc')->get();
        return view('role.index', compact('roles'));
    }

    public function getData()
    {
        $roles = Role::orderBy('id', 'asc')->get();
        return response()->json($roles);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|unique:roles|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        $role = Role::create([
            'role_name' => $request->role_name,
        ]);

        return response()->json([
            'success' => 'Role created successfully',
            'role' => $role
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        $validator = Validator::make($request->all(), [
            'role_name' => 'required|unique:roles|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        $role->role_name = $request->role_name;
        $role->save();

        return response()->json([
            'success' => 'Role updated successfully',
            'role' => $role
        ], 200);
    }

    public function destroy(Role $id)
    {
        $id->delete();

        return response()->json(['success' => 'Role deleted successfully'], 200);
    }
}


