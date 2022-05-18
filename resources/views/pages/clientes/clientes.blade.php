@extends('layouts.app')

@section('title','Clientes')

@section('content')
<div class="container">
    <div class="row">
        <div class="col mt-3">
           <a href="{{route('clientes.create')}}" class="btn principal-color text-white"><i class="fas fa-user-plus"></i> Registrar Cliente</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col p-4  bg-white rounded">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" cellpadding="0" id="tabla">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Tipo documento</th>
                            <th>Documento</th>
                            <th>Celular</th>
                            <th>Direccion</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                        <tr>
                          <td>{{$cliente->name}}</td>
                          <td>{{$cliente->email}}</td>
                          <td>{{$cliente->document_type}}</td>
                          <td>{{$cliente->document}}</td>
                          <td>{{$cliente->cell}}</td>
                          @if ($cliente->direction !='')
                          <td><span>{{$cliente->direction}}</span></td>
                          @else
                          <td><span>Sin direccion</span></td>
                          @endif


                          @if ($cliente->state)
                            <td><span class="badge badge-primary">Activo</span></td>  
                          @else
                            <td><span class="badge badge-danger">Deshabilitado</span></td>
                          @endif
                          <td>
                              <div class="d-flex justify-content-between flex-wrap">
                                @if ($cliente->state)
                                    <a href="{{route("clientes.edit",$cliente->id)}}"><i class="far fa-edit text-warning"></i></a>
                                @endif
                                <a href="{{route("clientes.changeState",['id'=>$cliente->id,'state'=>$cliente->state])}}">
                                @if ($cliente->state)
                                    <i class="fas fa-user-slash text-danger"></i>
                                @else
                                    <i class="far fa-user text-primary"></i> 
                                @endif</a>
                                <a href="{{route("clientes.show",$cliente->id)}}"><i class="fas fa-info-circle text-success"></i></a>
                              </div>
                           </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>
@endsection