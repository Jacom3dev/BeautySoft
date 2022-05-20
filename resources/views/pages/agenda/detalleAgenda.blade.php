@extends('layouts.app')
@section('title')
     Agenda
@endsection

@section('content')
<div class="container-fluid">
    <div class="row" >
        <div class="col-12 text-center py-2">
            <h3> <strong style="color: rgba(2, 93, 113, 1);">Servicios usados en la cita</strong></h3>
        </div>
        <div class="col-4">
            <div class="card" style="width: 16rem; margin-left:100px;">
                <div class="card-body">
                    <h5 class="text-center">Detalle Cita</h5>
                    <p class="card-title">Nombre del cliente: </p><p class="card-text">{{$nombre}}</p>
                    <p class="card-title ">direccion: </p><p class="card-text">
                        @if($cita->direction != "")
                            {{$cita->direction}}
                        @else
                            <p class="alert alert-info"> La cita se realizara en el establecimiento.</p>      
                        @endif    
                    </p>
                    @if($cita->description !=  "")
                    <p class="card-title ">Descripcion: </p><p class="card-text">{{$cita->description}}</p>
                    
                    @endif
                    <p class="card-title ">fecha: </p><p class="card-text">{{$fecha}}</p>
                    <p class="card-title ">hora inicio de la cita: </p><p class="card-text">{{$horaI}}</p>
                    <p class="card-title ">hora finalizacion de la cita: </p><p class="card-text">{{$horaF}}</p>
                    <p class="card-title ">Estado: </p><p class="card-text">
                    @if ($cita->state_id ==2)
                        <i><p class="alert alert-info">LA CITA  ESTA POR REALIZARCE. </p></i>           
                    @elseif($cita->state_id == 1)
                        <i><p class="alert alert-danger">LA CITA  SE CANCELO/REALIZO.</p></i>
                    @elseif($cita->state_id == 3)
                        <i><p class="alert alert-warning ">LA CITA ESTA EN EJECUCION.</p></i>    
                    @endif
                    <br>
                    <a href="{{route('agenda.index')}}"  class="btn btn-outline-dark" data-bs-dismiss="modal" data-bs-toggle="tooltip" data-bs-placement="left" title="Retroceder">Volver</a>
                </div>
            </div>
        </div>
        <div class="col-7" > 
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" cellpadding="0">
                    <thead>
                        <tr>
                            <th scope="col">Nombre Producto</th>
                            
                            <th scope="col">Precios</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servicios as $value)
                                <tr class="text-center">
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->price }}</td>
                                    
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection