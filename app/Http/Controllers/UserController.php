<?php

namespace App\Http\Controllers;

use App\User;
use App\Role\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

        $this->middleware('check_user_role:' . UserRole::ROLE_ADMIN);
    }

    public function index($role)
    {
        switch (strtoupper($role)) {
            case UserRole::ROLE_ADMIN:
            case UserRole::ROLE_OPERATOR:
                return view('user', ['role' => $role]);    
                break;

            default:
                return abort(404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);

        return response()->json([
            'error' => false,
            'user'  => $user,
        ], 200);
    }

    public function show($role, $id)
    {
        $user = User::find($id);

        return response()->json([
            'error' => false,
            'user'  => $user
        ], 200);
    }

    public function update(Request $request, $role, $id)
    {
        $validator = Validator::make($request->input(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return response()->json([
            'error' => false,
            'user'  => $user,
        ], 200);
    }

    public function destroy($role, $id)
    {
        $user = User::destroy($id);

        return response()->json([
            'error' => false,
            'user'  => $user,
        ], 200);
    }

    public function json($role)
    {
        return datatables(DB::table('users')
            ->where('role', '=', $role))
            ->toJson();
    }
}
