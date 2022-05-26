@extends('layouts.app') 
@section('tittle') Compras
@section('content')
<div class="container">
    <div class="row pt-4">
        <div class="col-4">
            <div class="card" style="width: 16rem;">
                <div class="card-header">
                    <h3 class="card-title text-secondary">Detalle de compra</h3>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Creado por: </h5>
                    <p class="card-text">{{$Compra->usuario->name }}</p>
                    <h5 class="card-title ">Nombre Proveedor: </h5>
                    <p class="card-text">{{ $Compra->prov->supplier }}</p>
                    <h5 class="card-title ">Precio: </h5>
                    <p class="card-text">{{ $Compra->price }}</p>
                    <h5 class="card-title ">Fecha: </h5>
                    <p class="card-text">{{ $Compra->created_at }}</p>
                    <h5 class="card-title ">Estado: </h5>
                    <p class="card-text">
                        @if ($Compra->state)
                        <i><p class="alert alert-info">Realizada</p></i> @else
                        <i><p class="alert alert-danger">Cancelada</p></i> @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="col-8">
            @if (count($productos) != 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" cellpadding="0">
                    <thead>
                        <tr>
                            <th scope="col">Nombre Producto</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Estado</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $value)
                        <tr class="text-center">
                            <td>{{ $value->name }}</td>
                            <td>
                                @if($value->img != '')
                                <img src="{{ $value->img }}" style="width: 2rem; height: 2rem;" alt=""> @else
                                <i class="fas fa-eye-slash text-danger" data-bs-toggle="tooltip" data-bs-placement="left" title="sin imagen"></i> @endif
                            </td>
                            <td>{{ $value->amount }}</td>
                            <td>{{ $value->price }}</td>
                            <td class="text-center">

                                @if ($value->state == 1)
                                <!-- <a  class="btn  btn-primary btn-ms " >Activo</a> -->

                                <span class="badge badge-success">Activo</span> @else
                                <!-- <a  class="btn  btn-danger btn-ms" >Desactivado</a>  -->

                                <span class="badge badge-danger">Desactivado</span> @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>


<div class="row justify-content-center">
    <hr>
    <div class="col-12">
        <div class="row mt-3">
            <div class="col d-flex justify-content-center">
                <a href="{{ route('compras.index') }}" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir atrás">Volver</a>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    let text = document.getElementById('text').innerText;
    let cortar = text.slice(0, text.length - 1)
    console.log(cortar);

    document.getElementById('text').innerText = cortar
</script>

@endsection