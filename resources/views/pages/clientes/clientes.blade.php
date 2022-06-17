@extends('layouts.app')

@section('title','Clientes')

@section('content')
<div class="container">
    <div class="row">
        <div class="col mt-3" data-bs-toggle="tooltip" data-bs-placement="left" title="Registrar cliente">
           <a href="{{route('clientes.create')}}" class="btn principal-color text-white"><i class="fas fa-user-plus" ></i> Crear cliente</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col p-4  bg-white rounded">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" cellpadding="0" id="tabla">
                    <thead class="text-center">
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo documento</th>
                            <th>Documento</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                        <tr>
                          <td>{{$cliente->name}}</td>
                          <td>{{$cliente->document_type}}</td>
                          <td>{{$cliente->document}}</td>


                          @if ($cliente->state)
                            <td class="text-center"><span class="badge badge-primary">Activo</span></td>  
                          @else
                            <td class="text-center"><span class="badge badge-danger">Deshabilitado</span></td>
                          @endif
                          <td class="">
                              <div class="d-flex justify-content-between flex-wrap">
                                @if ($cliente->state)
                                    <a href="{{route("clientes.edit",$cliente->id)}}"><i class="far fa-edit text-warning" data-bs-toggle="tooltip" data-bs-placement="left" title="Editar"></i></a>
                                @endif
                                <a href="{{route("clientes.changeState",['id'=>$cliente->id,'state'=>$cliente->state])}}">
                                @if ($cliente->state)
                                    <i class="fas fa-user-slash text-danger" data-bs-toggle="tooltip" data-bs-placement="left" title="Inhablitar"></i>
                                @else
                                    <i class="far fa-user text-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="Habilitar"></i> 
                                @endif</a>
                                <a href="{{route("clientes.show",$cliente->id)}}"><i class="fas fa-info-circle text-primary"data-bs-toggle="tooltip" data-bs-placement="left" title="Ver detalle"></i></a>
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