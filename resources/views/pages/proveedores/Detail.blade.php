@extends('layouts.app')

@section('title','Proveedor')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                 <div class="card" style="width: 20rem;">
                    <div class="card-header">Detalle de proveedor</div>
                        <div class="card-body">
                            <h5 class="card-title">Empresa: </h5><p class="card-text">{{$proveedor->enterprise}}</p>
                            <h5 class="card-title ">Proveedor Proveedor: </h5><p class="card-text">{{$proveedor->supplier}}</p>
                            <h5 class="card-title ">Teléfono: </h5><p class="card-text">{{$proveedor->cell}}</p>
                            <h5 class="card-title ">Correo Electrónico: </h5><p class="card-text">{{$proveedor->email}}</p>
                            <h5 class="card-title ">Dirección   : </h5><p class="card-text">{{$proveedor->direction}}</p>
                            <h5 class="card-title ">Estado: </h5><p class="card-text"> 
                                @if ($proveedor->state)
                                    <span class="badge badge-success " >Activo</span>
                                @elseif(!$proveedor->state)
                                    <span class="badge badge-danger">Deshabilitado</span>
                                @endif</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <hr>  
            <div class="col-12">
                <div class="row mt-3">
                    <div class="col d-flex justify-content-center">
                        <a href="{{route('proveedores.index')}}" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Regresar">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection