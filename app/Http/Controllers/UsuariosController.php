<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Http\Requests\StoreUsers;
use App\Http\Requests\UpdateUsers;
use App\Http\Requests\UpdatePasswordUser;
class UsuariosController extends Controller
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
        $users = User::select("users.*","roles.name as rol_name","roles.state as rol_state")->join('roles','users.rol_id',"=","roles.id")->get();
        return view('pages.usuarios.usuarios',compact("users"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Roles::where('state',1)->where('id','!=',1)->get();
        return view('pages.usuarios.formUsuario',compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsers $request)
    {
        $user = $request->all();
        User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'cell' => $user['cell'],
            'direction' => $user['direction'],
            'state' => $user['state'],
            'rol_id' => $user['rol_id'],
            'password' => Hash::make($user['password']),
        ]);
        alert()->success('Usuario','Usuario  registrado exitosamente.');
        return Redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user  = User::select("users.*","roles.name as rol_name","roles.state as rol_state")
        ->join('roles','users.rol_id',"=","roles.id")
        ->where('users.id', $id)
        ->first();


        if ($user == null) {
            alert()->error('Usuario','Usuario no encontrado.');
            return  Redirect()->route('usuarios.index');
        }
        return view('pages.usuarios.detalle',compact("user"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Roles::all()->where('id','!=', 1)->where('state',1);
        if ($user == null) {
            alert()->error('Usuario','Usuario no encontrado.');
            return  Redirect()->route('usuarios.index');
        }
        
        return view('pages.usuarios.editUsuario',compact("user","roles"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsers $request, $id)
    {
        $input = $request->all();
        $usuario = User::find($id);
        if ($usuario == null) {
            alert()->error('Usuario','Usuario no encontrado.');
            return  Redirect()->route('usuarios.index');
        }
        $usuario->update($input);
        alert()->success('Usuario','Usuario editado exitosamente.');
        return  Redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function changeState($id,$state)
    {
        $usuario = User::find($id);
        if ($usuario == null) {
            alert()->error('Usuario','Usuario no encontrado.');
            return  Redirect()->route('usuarios.index');
        }
        $usuario->update([
            'state' => !$state
        ]);
        alert()->success('Usuario','Cambio de estado con exito.');
        return  Redirect()->route('usuarios.index');
    }
    public function updatePassword(UpdatePasswordUser $request, $id)
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $usuario = User::find($id);
        if ($usuario == null) {
            alert()->error('Usuario','Usuario no encontrado.');
            return  Redirect()->route('usuarios.index');
        }
        $usuario->update($input);
        alert()->success('Usuario','Contraseña editada exitosamente.');
        return  Redirect()->route('usuarios.index');
    }

}
