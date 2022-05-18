<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Documentos;
use App\Http\Requests\StoreClientes;
use App\Http\Requests\UpdateClientes;
class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $clientes = Clientes::select('clientes.*','tipo_documentos.name as document_type')->join('tipo_documentos','clientes.document_id','=','tipo_documentos.id')->get();
        return view('pages.clientes.clientes',compact("clientes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documentos = Documentos::all();
        return view('pages.clientes.formCliente',compact('documentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientes $request)
    {
        Clientes::create($request->all());
        alert()->success('Cliente','Cliente registrado');
        return Redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Clientes::find($id);
        return view('pages.clientes.detalle',compact("cliente"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Clientes::find($id);
        $documentos = Documentos::all();
        return view('pages.clientes.formCliente',compact('cliente','documentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientes $request, $id)
    {
        $input = $request->all();
        $cliente = Clientes::find($id);
        $cliente->update($input);
        alert()->success('Cliente','Cliente  editado con exito');
        return  Redirect()->route('clientes.index');
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
        $cliente = Clientes::find($id);
        $cliente->update([
            'state' => !$state
        ]);
        alert()->success('Cliente','Cambio de estado con exito');
        return Redirect()->route('clientes.index');
    }
}
