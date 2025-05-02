<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::with('company')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dni' => 'required|string|max:8',
            'email' => 'required|string|email|max:255|unique:users',
            'position' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'dni' => $request->dni,
            'position' => $request->position,
            'password' => Hash::make($request->password),
            'company_id' => auth()->user()->company_id,
            'is_active' => true,
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dni' => 'required|string|max:8',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'position' => 'required|string|max:255',
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'dni' => $request->dni,
            'position' => $request->position,
            'is_active' => true,
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return Inertia::render('Users/Index', [
            'users' => User::all(),
        ]);
    }
}
