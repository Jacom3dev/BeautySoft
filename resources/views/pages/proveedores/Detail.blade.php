@extends('layouts.app')

@section('title','Proveedor')
@section('content')
    <div class="container">
        <div class="row justify-content-center pt-4">
            <div class="col-10 col-md-8 col-lg-7 p-2 px-4 bg-white rounded">
                <div class="card-header">
                    <h3 class="text-center">
                        <strong style="color: rgba(2, 93, 113, 1);">
                            Detalle de proveedor
                        </strong>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6 py-3">
                            <h5 class="card-title"> <b>Empresa:</b>  </h5>
                            <p class="card-text">
                                {{$proveedor->enterprise}}
                            </p>
                        </div>
                        <div class="col-12 col-md-6 py-3">
                            <h5 class="card-title "> <b>Proveedor Proveedor:</b> </h5>
                            <p class="card-text">
                                {{$proveedor->supplier}}
                            </p>
                        </div>
                        <div class="col-12 col-md-6 py-3">
                            <h5 class="card-title "> <b>Teléfono:</b> </h5>
                            <p class="card-text">
                                {{$proveedor->cell}}
                            </p>
                        </div>
                        <div class="col-12 col-md-6 py-3">
                            <h5 class="card-title "> <b>Correo Electrónico:</b> </h5>
                            <p class="card-text">
                                {{$proveedor->email}}
                            </p>
                        </div>
                        <div class="col-12 col-md-6 py-3">
                            <h5 class="card-title "> <b>Dirección:</b> </h5>
                            <p class="card-text">
                                {{$proveedor->direction}}
                            </p>
                        </div>
                        <div class="col-12">
                            <h5 class="card-title "> <b>Estado:</b> </h5>
                            <p class="card-text"> 
                                @if ($proveedor->state)
                                    <i><p class="alert alert-info">Activo</p></i> 
                                @elseif(!$proveedor->state)
                                    <i><p class="alert alert-info">Deshabilitado</p></i> 
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-foother">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-12 col-md-3 ">
                            <a href="{{route('proveedores.index')}}" class="btn btn-outline-dark btn-block" data-bs-toggle="tooltip" data-bs-placement="left" title="Regresar">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection