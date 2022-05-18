<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UpdateInfoPerfil;
use App\Http\Requests\UpdatePassword;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id =  Auth()->user()->id;
        $user = User::find($id);
        return view('pages.usuarios.perfil',compact("user"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function perfil(){
      
    }

    public function updateInfo(UpdateInfoPerfil $request, $id)
    {
        $input = $request->all();
        $usuario = User::find($id);
        $usuario->update($input);
        alert()->success('Usuario','Informacion editada con exito');
        return  Redirect()->route('usuarios.perfil');
    }

    public function updatePassword(UpdatePassword $request, $id)
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $usuario = User::find($id);
        $usuario->update($input);
        alert()->success('Usuario','Informacion editada con exito');
        return  Redirect()->route('usuarios.perfil');
    }
}
