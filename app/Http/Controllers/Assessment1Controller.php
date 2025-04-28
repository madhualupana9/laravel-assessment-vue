<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class Assessment1Controller extends Controller
{
    public function index()
    {
        return view('layouts.app');
    }

    public function indexApi()
    {
        $users = User::with('details')->get();
        return response()->json($users);
    }

    public function showApi(User $user)
    {
        $user->load('details');
        return response()->json($user);
    }

    public function create()
    {
        return view('layouts.app');

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prefixname' => 'nullable|string',
            'firstname' => 'required|string',
            'middlename' => 'nullable|string',
            'lastname' => 'required|string',
            'suffixname' => 'nullable|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'photo' => 'nullable|string',
            'password' => 'sometimes|required|string|min:8|confirmed',
            'password_confirmation' => 'sometimes|required_with:password',
            'type' => 'nullable|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user = User::create($validated);
        return redirect()->route('assessment1.index')->with('success', 'User created successfully');
    }

    public function show(User $user)
    {
        return view('layouts.app'); 
    }

    public function edit(User $user)
    {
        return view('layouts.app');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'prefixname' => 'nullable|string',
            'firstname' => 'required|string',
            'middlename' => 'nullable|string',
            'lastname' => 'required|string',
            'suffixname' => 'nullable|string',
            'username' => 'required|string|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'photo' => 'nullable|string',
            'password' => 'nullable|confirmed',
            'type' => 'nullable|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully',
                'data' => $user
            ]);
        }
        return redirect()->route('assessment1.index')->with('success', 'User updated successfully');
    }


    public function destroy(Request $request, User $User)
    {
        $User->delete();
    
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully',
                'data' => $User
            ]);
        }
    
        return redirect()->route('assessment1.index')->with('success', 'User deleted successfully');
    }

   
}
