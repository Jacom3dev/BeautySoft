
@extends('layouts.app')

@section('title', 'Compras')
@section('content')
<div class="container">
    <div class="row">
        <div class="col mt-3">
           <a href="{{route('compras.create')}}" class="btn principal-color text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Registrar Compra">
                <i class="fas fa-cart-plus"></i>
                Crear Compra
            </a>
        </div>
    </div> 
    {{-- <div class="row mt-2">
        <div class="col">
            <div class="dt-responsive">
                <table class="table table-striped table-bordered nowrap" style="width:100%" id="tabla">
                    <thead class="text-center">
                        <tr>
                            <th>usuario</th>
                            <th>Proveedor</th>
                            <th>Precio</th>
                            <th>Fecha de registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead> 
                    <tbody>
                    @foreach($compra as $value) 
                        <tr>
                            <td>
                                {{$value->usuario->name}}
                            </td>
                            <td>
                                {{$value->prov->supplier}}
                            </td>
                            <td>
                                {{$value->price}}
                            </td>
                            <td> {{$value->created_at}}</td>
                            <td class="d-flex justify-content-around">
                            @if($value->state)
                                    <a href="/compras/{{$value->id}}/{{$value->state}}" class="" data-bs-toggle="tooltip" data-bs-placement="left" title="Habilitar"><i class="fas fa-times-circle text-danger"></i></a>
                                @elseif(!$value->state)
                                    <a href="/compras/{{$value->id}}/{{$value->state}}" class="" data-bs-toggle="tooltip" data-bs-placement="left" title="Deshabilitar"><i class="fas fa-check-circle text-success"></i></a>
                                @endif
                                    <a href="{{route('compras.show', $value->id)}}" class="" data-bs-toggle="tooltip" data-bs-placement="left" title="Detalle"><i class="fas fa-info-circle text-success"></i></a>

                            </td>
                        </tr>
                    @endforeach
                
                    </tbody>
                </table>
                <a href="{{route('compras.export')}}">descargar</a>
            </div> 
        </div>
    </div> --}}
    
    <div class="row mt-2">
        <div class="col p-4  bg-white rounded">
            <div class="dt-responsive">
                <table class="table table-striped table-bordered nowrap" style="width:100%" id="tabla">
                    <thead>
                        <tr>
                            <th>usuario</th>
                            <th>Proveedor</th>
                            <th>Precio</th>
                            <th>Fecha de registro</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead> 
                    <tbody>
                    @foreach($compra as $value) 
                        <tr>
                            <td>
                                {{$value->usuario->name}}
                            </td>
                            <td>
                                {{$value->prov->supplier}}
                            </td>
                            <td>
                                {{$value->price}}
                            </td>
                            <td> {{$value->created_at}}</td>
                            <td class="text-center">
                                @if ($value->state)
                                <span class="badge badge-primary">Realizada</span>
                            @elseif(!$value->state)
                                <span class="badge badge-danger">Cancelada</span>
                            @endif
                            </td>
                            <td class="d-flex justify-content-around">
                            @if($value->state)
                                    <a href="/compras/{{$value->id}}/{{$value->state}}" class="" data-bs-toggle="tooltip" data-bs-placement="left" title="Habilitar"><i class="fas fa-times-circle text-danger"></i></a>
                                
                                @endif
                                    <a href="{{route('compras.show', $value->id)}}" class="" data-bs-toggle="tooltip" data-bs-placement="left" title="Detalle"><i class="fas fa-info-circle text-primary"></i></a>

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