@extends('layouts.app')

@section('title','Clientes')
@section('content')
    <div class="container">
        <div class="row justify-content-center pt-4">
            <div class="col-10 col-md-8 col-lg-7 p-2 px-4 bg-white rounded">
                <div class="card-header">
                    <h3 class="text-center"> 
                        <strong style="color: rgba(2, 93, 113, 1);">
                            Detalle de Cliente
                        </strong>
                    </h3>
                </div>
                
                <div class="card-body row py-3">

                    <div class="col-12 col-md-6 py-3">
                        <h5 class="card-title"> <b>Nombre:</b> </h5>
                        <p class="card-text">{{$cliente->name}}</p>
                    </div>

                    <div class="col-12 col-md-6 py-3">
                        <h5 class="card-title "> <b>EMail:</b> </h5>
                        <p class="card-text">
                            @if (isset($cliente->email))
                            {{$cliente->email}}
                            @else
                            Sin Correo.
                            @endif
                        </p>
                    </div>

                    <div class="col-12 col-md-6 py-3">
                        <h5 class="card-title "> <b>Tipo De Documento:</b> </h5>
                        <p class="card-text">
                            @if ($cliente->document_id ==1)
                            C.C
                            @else
                                T.I
                            @endif
                        </p>
                    </div>

                    <div class="col-12 col-md-6 py-3">
                        <h5 class="card-title "> <b>Numero Documento:</b> </h5>
                        <p class="card-text">
                            {{$cliente->document}}
                        </p>
                    </div>

                    <div class="col-12 col-md-6 py-3">
                        <h5 class="card-title "> <b>Celuala:</b> </h5>
                        <p class="card-text">
                            @if (isset($cliente->cell))
                            {{$cliente->cell}}
                            @else
                                Sin celular
                            @endif
                        </p>
                    </div>

                    <div class="col-12 col-md-6 py-3">
                        <h5 class="card-title "> <b>Dirección:</b> </h5>
                        <p class="card-text">
                            @if (isset($cliente->direction))
                            {{$cliente->direction}}
                            @else
                                Sin dirección.    
                            @endif
                        </p>
                    </div>

                    <div class="col-12 pt-3">
                        <h5 class="card-title"> <b>Estado:</b> </h5>
                        <p class="card-text"> 
                            @if ($cliente->state) 
                                <i><p class="alert alert-info">Activo</p></i> 
                            @else
                                <i><p class="alert alert-danger">Deshabilitado</p></i> 
                            @endif 
                        </p>
                    </div>

                </div>
                <div class="card-foother">
                    <div class="row my-2 justify-content-end">
                        <div class="col d-flex justify-content-center">
                            <a href="{{route('clientes.index')}}" class="btn btn-outline-dark" ">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- x --}}
    </div>
@endsection