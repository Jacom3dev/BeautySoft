@extends('layouts.app')

@section('title','Clientes')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="text-center text-warning mt-2">Detalle Cliente</h3>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col p-4 bg-white rounded">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" cellpadding="0" id="tabla">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Tipo documento</th>
                                <th>Documento</th>
                                <th>Telefono</th>
                                <th>Direccion</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$cliente->name}}</td>
                                <td>{{$cliente->email}}</td>
                                <td>@if ($cliente->document_id ==1)
                                    C.C
                                @else
                                    T.I
                                @endif</td>
                                <td>{{$cliente->document}}</td>
                                <td>{{$cliente->cell}}</td>
                                <td>{{$cliente->direction}}</td>
                                @if ($cliente->state)
                                  <td><span class="badge badge-primary">Activo</span></td>  
                                @else
                                  <td><span class="badge badge-danger">Deshabilitado</span></td>
                                @endif   
                              </tr> 
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
        <div class="row justify-content-center">
            <hr>
            <div class="col-12">
                <div class="row mt-3">
                    <div class="col d-flex justify-content-center">
                        <a href="{{route('clientes.index')}}" class="btn btn-outline-dark" ">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection