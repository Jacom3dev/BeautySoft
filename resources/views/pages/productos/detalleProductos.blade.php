@extends('layouts.app')
@section('title')
    Detalle Producto
@endsection

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-6">
      <div id="Crear"  >
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content" >
            <div class="modal-header">
              <h5 class="modal-title" id="CrearLabel">Detalle Producto</h5>
            </div>
            @if($productos->img != "")
            <img src="{{$productos->img}}" class="card-img-top"  height="200">
            @else
            <a href="{{route('productos.edit',$productos->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Agregar imagen" class="nav-link btn"><h5 class="alert alert-secondary"><small>FALTA AGREGAR UNA IMAGEN. </small></h5></a>
            @endif
            <div class="modal-body">
                <h5 class="card-title">Nombre del Producto: </h5><p class="card-text">{{$productos->name}}</p>
              <h5 class="card-title ">Precio: </h5><p class="card-text">{{$productos->price}}</p>
              <h5 class="card-title ">Cantidad: </h5><p class="card-text">{{$productos->amount}}</p>
              
            </div>
            <div class="row justify-content-end" style="margin-bottom:10px;">
              <div class="col-md-3" >
                <a class="btn btn-outline-dark" href="/productos"  data-bs-toggle="tooltip" data-bs-placement="left" title="Regresar"><i class="glyphicon glyphicon-edit"></i>Cancelar</a>
              </div>
              
            </div>
          </div>
        </div>
      </div>  
    </div>
  </div>
</div>
  
@endsection