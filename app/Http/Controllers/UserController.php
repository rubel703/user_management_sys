<?php

namespace App\Http\Controllers;

use App\Models\
{
    User,
    Role
};
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', ['users' => User::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create', ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | string | max:255',
            'email' => 'required | email | unique:users,email',
            'password' => 'required | string | min:5',
            'roles' => 'required | array'
        ]);
        $user = User::create($request->all());
        $user->roles()->attach($request->input('roles'));
        return redirect()->route('users.index')->with('success', 'User created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', ['users' => $user,'roles' => Role::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', ['users' => $user, 'roles' => Role::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required | string | max:255',
            'email' => 'required | email | unique:users,email,' . $user->id,
            'password' => 'nullable | string | min:5',
            'roles' => 'required | array'
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        if($request->filled('password')){
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }
        /*
       attach = add id,
       detach = delete id,
       sync = detach + attach
       */
        $user->roles()->sync($request->input('roles'));
        return redirect()->route('users.index')->with('success', 'User update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted Successfully');
    }
}
