@extends('layouts.app')

@section('title','Usuarios')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="text-center text-warning mt-2">Detalle Usuario</h3>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col p-4 bg-white rounded">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" cellpadding="0" id="tabla">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Rol</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->cell}}</td>
                                <td>{{$user->direction}}</td>
                                <td>@if ($user->rol_id === 1)Administrador @else Empleado @endif </td>
                                @if ($user->state)
                                  <td><span class="badge badge-primary">Activo</span></td>  
                                @else
                                  <td><span class="badge badge-danger">Deshabilitado</span></td>
                                @endif   
                              </tr> 
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{route('usuarios.index')}}" class="btn btn-outline-dark" ">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection