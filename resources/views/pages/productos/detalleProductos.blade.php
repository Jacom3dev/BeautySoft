@extends('layouts.app')
@section('title')
    Detalle Producto
@endsection

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-10 col-md-8 col-lg-7 mt-4 p-2 px-4 bg-white rounded">
        <h3 class="text-center"> <strong style="color: rgba(2, 93, 113, 1);">Detalle de producto.</strong></h3>
          @if($productos->img != "")
            <img src="{{$productos->img}}" class="card-img-top"  height="200">
          @else
            <a href="{{route('productos.edit',$productos->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Agregar imagen" class="nav-link btn"><h5 class="alert alert-secondary"><small>FALTA AGREGAR UNA IMAGEN. </small></h5></a>
          @endif
          <div class="row">
            <div class="col-12">
              <h5 class="card-title">Nombre del Producto: </h5><p class="card-text">{{$productos->name}}</p>
            </div>
            <div class="col-12">
              <h5 class="card-title ">Precio: </h5><p class="card-text">{{$productos->price}}</p>
            </div>
            <div class="col-12">
              <h5 class="card-title ">Cantidad: </h5><p class="card-text">{{$productos->amount}}</p>
            </div>
          </div>
          <div class="row justify-content-end mb-3">
            <div class="col-md-3" >
              <a class="btn btn-outline-dark btn-block" href="/productos"  data-bs-toggle="tooltip" data-bs-placement="left" title="Regresar">Volver</a>
            </div>
          </div> 
    </div>
  </div>
</div>
  
@endsection