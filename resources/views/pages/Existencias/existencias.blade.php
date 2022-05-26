@extends('layouts.app')

@section('title', 'Existencias')


@section('content')

<div class="container">
    <form action="{{route('existencias.index')}}" method="get">
        <div class="row justify-content-end pt-4">
            <div class="col-3">
                <input class="form-control" type="text" name="textoBusqueda" id="textoBusqueda" placeholder="Buscar">
            </div>
            <div class="col-1">
                <button type="submit" class="btn principal-color text-white">Buscar</button>
            </div>
        </div>
    </form>

    <div class="row justify-content-center flex-row flex-wrap py-3">
        @if(count($productos) <= 0)
            <div class="col-16">
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="fas fa-exclamation-triangle text-dager"></i>
                <div>
                     Producto no existe
                </div>
                </div>
            </div>
        @else
            @foreach ( $productos as $value  )

                @if($value->amount < 5)
                    <div class="col-3">
                        
                        <div class="card "  style="width: 15rem;">
                            {{-- <img src="{{$value->img}}" class="card-img-top" style=" height: 13rem;" alt="{{$value->img}}"> --}}
                            <div class="card-header p-3 ">
                                @if($value->img != "")
                                <img src="{{$value->img}}" class="card-img-top" style="height: 13rem;">
                                @else
                                <a href="{{route('productos.edit',$value->id)}}"  style="height: 13rem; padding-top: 4rem;" data-bs-toggle="tooltip" data-bs-placement="left" title="Agregar imagen" class="nav-link btn"><h5 class="alert alert-secondary"><small>FALTA AGREGAR UNA IMAGEN. </small></h5></a>
                                @endif
                            </div>
                            <div class="card-body d-flex justify-content-center">
                                <h5 class="card-title"><b>{{$value->name}}</b></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-dark"> <b> Cantidad:</b> {{$value->amount}}</li>
                                <li class="list-group-item"> <b> Precio: </b>{{$value->price}}</li>
                            </ul>
                            <div class="card-body text-center">
                                <!-- <a href="{{route('compras.create')}}" class="btn principal-color text-white">Comprar Producto</a> -->
                                <a href="{{route('compras.create')}}" type="button" class="btn principal-color text-white position-relative">
                                    Comprar Producto
                                    <!-- <span class="position-absolute top-0 start-150 translate-middle p-1 bg-danger border border-light rounded-circle"></span> -->
                                </a>
                            </div>
                        </div>
                        
                    </div>
                @else
                    <div class="col-3 flex-wrap-row">
                        <div class="card w-1" style="width: 15rem;">
                            <div class="card-header p-3">
                                @if($value->img != "")
                                <img src="{{$value->img}}" class="card-img-top" style="height: 13rem;">
                                @else
                                <a href="{{route('productos.edit',$value->id)}}"  style="height: 13rem; padding-top: 4rem;" data-bs-toggle="tooltip" data-bs-placement="left" title="Agregar imagen" class="nav-link btn"><h5 class="alert alert-secondary"><small>FALTA AGREGAR UNA IMAGEN. </small></h5></a>
                                @endif
                            </div>
                            <div class="card-body d-flex justify-content-center">
                                <h5 class="card-title"><b>{{$value->name}}</b></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b> Cantidad:</b> {{$value->amount}}</li>
                                <li class="list-group-item"><b> Precio: </b> {{$value->price}}</li>
                            </ul>
                            <div class="card-body text-center">
                                <a href="{{route('compras.create')}}" class="btn principal-color text-white">Comprar Producto</a>
                            </div>
                        </div>
                        
                    </div>
                @endif

            @endforeach
        @endif
    </div>

    <div class="row justify-content-center">
        <div class="col-auth">
            {{$productos->links()}}
        </div>
    </div>
</div>

@endsection