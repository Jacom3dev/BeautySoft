@extends('layouts.app')
@section('title')
    Detalle Cita
@endsection

@section('content')

<div id="Crear"  >
    <div class="modal-dialog modal-dialog-scrollable" style="max-width:1400px;">
      <div class="modal-content" >
            <div class="modal-header">
            <h5 class="modal-title" id="CrearLabel">Detalle Cita</h5>
            
            </div>
            <div class="modal-body">
             <h5 class="card-title">Nombre del cliente: </h5><p class="card-text">{{$citas->name_Cliente}}</p>
          <h5 class="card-title ">Precio: </h5><p class="card-text">{{$citas->price}}</p>
          <h5 class="card-title ">Fecha : </h5><p class="card-text">{{$citas->date}}  </p>
          <h5 class="card-title ">Hora Inicio : </h5><p class="card-text">{{$horaI}}  </p>
          <h5 class="card-title ">Hora Final : </h5><p class="card-text">{{$horaF}}  </p>
          <h5 class="card-title ">Servicio: </h5><p class="card-text">
            
            @foreach ($servicios as $key)
                @foreach ($detalleS as $ds)
                    @if ($citas->id == $ds->schedule_id)
                        @if ($key->state==1)
                            @if ($key->id ==$ds->servis_id)
                           
                                 El servicio es {{$key->name}}. 
                            
                                
                            
                            @endif               
                        @else
                            <i><p class=" alert alert-danger">EL SERVICO FUE DESACTIVADO.</p></i>   
                        @endif
                    @endif 
                @endforeach 
            @endforeach                
           

            </p>
            
            
            <h5 class="card-title ">Direccion: </h5><p class="card-text">{{$citas->direction}}</p>
          <h5 class="card-title ">Descripcion: </h5><p class="card-text">{{$citas->description}}</p>
          <h5 class="card-title ">Estado: </h5><p class="card-text">
            @if ($citas->estado ==1)
                <i><p class="alert alert-info">LA CITA SE VA A REALIZARA.</p></i>           
            @else
                <i><p class="alert alert-danger">LA CITA FUE HECHA O SE CANCELO.</p></i>  
            @endif 
         
          </p>
            </div>
            <div class="modal-footer">
                <a class="btn  btn-danger btn-ms" href="/productos" ><i class="glyphicon glyphicon-edit"></i>Cancelar</a>
            </div>
            
      </div>
    </div>
  </div>    
@endsection