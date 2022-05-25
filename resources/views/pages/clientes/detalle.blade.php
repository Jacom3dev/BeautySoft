@extends('layouts.app')

@section('title','Clientes')
@section('content')
    <div class="container">
        <div class="row justify-content-center pt-4">
            <div class="col-4">
                <div class="card" style="width: 20rem;">
                    <div class="card-header">Detalle de Cliente</div>
                    <div class="card-body">
                        <h5 class="card-title">Nombre: </h5><p class="card-text">{{$cliente->name}}</p>
                        <h5 class="card-title ">EMail: </h5><p class="card-text">
                            @if (isset($cliente->email))
                            {{$cliente->email}}
                            @else
                            Sin Correo.
                            @endif</p>
                        <h5 class="card-title ">Tipo De Documento: </h5><p class="card-text">
                            @if ($cliente->document_id ==1)
                            C.C
                        @else
                            T.I
                        @endif</p>
                        <h5 class="card-title ">Numero Documento: </h5><p class="card-text">{{$cliente->document}}</p>
                        <h5 class="card-title ">Celuala: </h5><p class="card-text">
                            @if (isset($cliente->cell))
                            {{$cliente->cell}}
                            @else
                                Sin celular
                            @endif
                            </p>
                        <h5 class="card-title ">Dirección: </h5><p class="card-text">
                            @if (isset($cliente->direction))
                            {{$cliente->direction}}
                            @else
                                Sin dirección.    
                            @endif
                            </p>
                        <h5 class="card-title">Estado:</h5>
                        <p class="card-text"> 
                            @if ($cliente->state)
                                <td><span class="badge badge-primary">Activo</span></td>  
                            @else
                                <td><span class="badge badge-danger">Deshabilitado</span></td>
                            @endif </p>
                    </div>
                    <div class="card-foother">
                        <div class="row my-3 justify-content-end">
                            <div class="col d-flex justify-content-center">
                                <a href="{{route('clientes.index')}}" class="btn btn-outline-dark" ">Volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- x --}}
    </div>
@endsection