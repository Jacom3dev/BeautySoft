@extends('layouts.app')
@section('title')
    Detalle Producto
@endsection

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-10 col-md-8 col-lg-7 mt-4 p-2 px-4 bg-white rounded" style="position: relative; top:40px;">
        <h3 class="text-center"> <strong style="color: rgba(2, 93, 113, 1);">Detalle de producto.</strong></h3>
          @if($productos->img != "")
            <img src="{{$productos->img}}" class="card-img-top"  height="200">
          @else
            <a href="{{route('productos.edit',$productos->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Agregar imagen" class="nav-link btn"><h5 class="alert alert-secondary"><small>FALTA AGREGAR UNA IMAGEN. </small></h5></a>
          @endif
          <div class="row">
            <div class="col-12 col-md-6">
              <h5 class="card-title"> <b>Nombre del Producto:</b>  </h5>
              <p class="card-text">
                {{$productos->name}}
              </p>
            </div>
            <div class="col-12 col-md-6">
              <h5 class="card-title "> <b>Precio al que se compro:</b>  </h5>
              <p class="card-text">
                @if ($productos->price_buys != 0)
                &#36;{{number_format($productos->price_buys)}}
                @else
                    sin Precio Compra
                @endif
              </p>
            </div>
            <div class="col-12 col-md-6">
              <h5 class="card-title "> <b>Precio al que se vendera:</b>  </h5>
              <p class="card-text">
                @if ($productos->price_sale != 0)
                &#36;{{number_format($productos->price_sale)}}
                @else
                    sin Precio Venta
                @endif
              </p>
            </div>
            <div class="col-12 col-md-6">
              <h5 class="card-title "> <b>Cantidad:</b>  </h5>
              <p class="card-text">
                {{$productos->amount}}
              </p>
            </div>
            <div class="col-12 pt-3">
                <h5 class="card-title"> <b>Estado:</b> </h5>
                <p class="card-text"> 
                    @if ($productos->state) 
                        <i><p class="alert alert-info">Activo</p></i> 
                    @else
                        <i><p class="alert alert-danger">Deshabilitado</p></i> 
                    @endif 
                </p>
            </div>
          </div>
          <div class="row justify-content-center mb-3">
            <div class="col-md-2" >
              <a class="btn btn-outline-dark btn-block" href="/productos"  data-bs-toggle="tooltip" data-bs-placement="left" title="Ir atrás">Volver</a>
            </div>
          </div> 
    </div>
  </div>
</div>
  
@endsection