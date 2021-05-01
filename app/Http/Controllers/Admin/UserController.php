<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::All();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id_document' => 'required|unique:users|digits:11',
            'phone' => 'required|unique:users|digits:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'place' => 'required|unique:users|numeric'
        ]);

        $password = bcrypt($request->password);

        $user = User::create($request->all());
        $user->password = $password;
        $user->save();

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.edit', $user)->with('info', 'El usuario ha sido creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::All();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'id_document' => "required|digits:11|unique:users,id_document,$user->id",
            'phone' => "required|digits:10|unique:users,phone,$user->id",
            'email' => "required|email|unique:users,email,$user->id",
            'password' => 'required|min:8',
            'place' => "required|numeric|unique:users,place,$user->id"
        ]);

        $user->roles()->sync($request->roles);

        $user->update($request->all());
        
        $password = bcrypt($request->password);
 
        $user->password = $password;
        $user->save();

        return redirect()->route('admin.users.edit', $user)->with('info', 'El usuario se ha actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('info', 'El usuario ha sido eliminado con exito');
    }
}
