@extends('layouts.app')

@section('title','Usuarios')
@section('content')
    <div class="container">
        <div class="row justify-content-center pt-4">
            <div class="col-10 col-md-8 col-lg-7 p-2 px-4 bg-white rounded">
                <div class="card-header">
                    <h3 class="text-center"> 
                        <strong style="color: rgba(2, 93, 113, 1);">
                            Detalle de Usuario.
                        </strong>
                    </h3>
                </div>
                
                <div class="card-body row py-3">

                    <div class="col-12 col-md-6 py-3">
                        <h5 class="card-title"> <b>Nombre:</b> </h5>
                        <p class="card-text">{{$user->name}}</p>
                    </div>

                    <div class="col-12 col-md-6 py-3">
                        <h5 class="card-title "> <b>Correo:</b> </h5>
                        <p class="card-text">
                            @if (isset($user->email))
                            {{$user->email}}
                            @else
                            Sin Correo.
                            @endif
                        </p>
                    </div>


                    <div class="col-12 col-md-6 py-3">
                        <h5 class="card-title "> <b>Numero de teléfono:</b> </h5>
                        <p class="card-text">
                            
                            @if (isset($user->cell))
                                {{$user->cell}}
                            @else
                                Sin Celular.    
                            @endif
                        </p>
                    </div>


                    <div class="col-12 col-md-6 py-3">
                        <h5 class="card-title "> <b>Dirección:</b> </h5>
                        <p class="card-text">
                            @if (isset($user->direction))
                            {{$user->direction}}
                            @else
                                Sin dirección.    
                            @endif
                        </p>
                    </div>
                    
                    <div class="col-12 col-md-6 py-3">
                        <h5 class="card-title "> <b>Rol:</b> </h5>
                        <p class="card-text">
                            {{$user->rol_name}}
                        </p>
                    </div>

                    <div class="col-12 pt-3">
                        <h5 class="card-title"> <b>Estado:</b> </h5>
                        <p class="card-text"> 
                            @if ($user->state) 
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
                            <a href="{{route('usuarios.index')}}" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir atrás">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection