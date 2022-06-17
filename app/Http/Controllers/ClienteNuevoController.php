<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Documentos;
use App\Http\Requests\StoreClientes;
use App\Http\Requests\UpdateClientes;

class ClienteNuevoController extends Controller
{

    public function store(StoreClientes $request)
    {
        if (isset($request)) {
            Clientes::create($request->all());
            alert()->success('Cliente','Cliente registrado exitosamente.');
            return Redirect()->route('ventas.create');

        }else {
            alert()->success('Cliente Nuevo','No se pudo crear el cliente.');
               
        }
    }

}
