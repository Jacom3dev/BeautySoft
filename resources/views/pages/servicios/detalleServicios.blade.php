@extends('layouts.app')
@section('title')
    Detalle Servicio
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center" >
        <div class="col-12 text-center py-2">
            <h3> <strong style="color: rgba(2, 93, 113, 1);">Productos usados en el servicio</strong></h3>
        </div>
        <div class="col-6 col-lg-4">
            <div class="card  card-detalle">
                <div class="card-body">
                    <h5 class="text-center">Detalle Servicios</h5>
                    <p class="card-title">Nombre del Servicio: </p><p class="card-text">{{$servicios->name}}</p>
                    <p class="card-title ">Precio: </p><p class="card-text">&#36;{{number_format( $servicios->price)}}</p>
                    <p class="card-title ">Descripcion: </p><p class="card-text">{{$servicios->description}}</p>
                    <p class="card-title ">Estado: </p><p class="card-text">
                    @if ($servicios->state ==1)
                        <i><p class="alert alert-info">El servicio se puede realizar</p></i>           
                    @else
                        <i><p class="alert alert-danger">El servicio se canceló.</p></i>  
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-7" > 
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" cellpadding="0">
                    <thead>
                        <tr>
                            <th scope="col">Nombre Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Estado</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($producto as $value)
                                <tr class="text-center">
                                    <td>{{ $value->name }}</td>
                                    
                                    <td>{{ $value->amount }}</td>
                                    <td>&#36;{{number_format(  $value->price_sale )}}</td>
                                    <td class="text-center">
                                        @if ($value->state == 1)
                                            <!-- <a  class="btn  btn-primary btn-ms " >Activo</a> -->

                                            <span class="badge badge-success">Activo</span>
                                        @else
                                            <!-- <a  class="btn  btn-danger btn-ms" >Desactivado</a>  -->

                                            <span class="badge badge-danger">Desactivado</span>
                                        @endif
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center">
            <hr>
            <div class="col-12">
                <div class="row ">
                    <div class="col d-flex justify-content-center">
                    <a href="{{route('servicios.index')}}"  class="btn btn-outline-dark" data-bs-dismiss="modal" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir atrás">Volver</a>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection