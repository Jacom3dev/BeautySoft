<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\User;
use App\Http\Requests\StoreRoles;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','validarRol']);
    }
    public function index()
    {
        $roles = Roles::all();
        return view('pages.roles.roles',compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.roles.formRol');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoles $request)
    {
        Roles::create($request->all());
        alert()->success('Rol','Rol registrado');
        return Redirect()->route('roles.index');
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
        $rol = Roles::find($id);
        if ($rol==null) {
            alert()->error('roles','rol no encontrado');
            return redirect("/roles/index");
        }
        return view('pages.roles.formRol',compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRoles $request, $id)
    {
        $input = $request->all();
        $rol = Roles::find($id);
        $rol->update($input);
        alert()->success('Rol','Rol  editado con exito');
        return  Redirect()->route('roles.index');
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
    public function changeState($id,$state)
    {
        if ($state == 0 || $state == 1) {
            $users = User::all();
            $rol = Roles::find($id);
            if ($rol==null) {
                alert()->error('roles','rol no encontrado');
                return redirect("/roles/index");
            }
            if ($id == 1) {
                alert()->error('Ups','No se puede deshabilitar el rol administrador');
                return Redirect()->route('roles.index');
            }else {
                try {
                    $rol->update([
                        'state' => !$state
                    ]);
                    foreach ($users as $value) {
                        if ($value->rol_id == $id) {
                            $user = User::find($value->id);
                            $user->update([
                                'state' => !$state
                            ]);
                        }
                    }
                    alert()->success('Rol','Cambio de estado con exito');
                    return Redirect()->route('roles.index');
                } catch (\Throwable $th) {
                    alert()->error('Rol','El rol no existe');
                    return Redirect()->route('roles.index');
                }

            }
        }else {
            alert()->info('Ups','El estado del rol no existe');
            return Redirect()->route('roles.index');
        }


    }
}
