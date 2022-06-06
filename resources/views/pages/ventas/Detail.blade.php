@extends('layouts.app') 
@section('title', 'Ventas') 
@section('content')
    <div class="container">
        
        <div class="row justify-content-center" >
            <div class="col-12 text-center py-2">
                <h3> <strong style="color: rgba(2, 93, 113, 1);">Detalle de la Venta.</strong></h3>
            </div>
            <div class="col-6 col-md-4">
                <div class="card card-detalle">
                    <div class="card-body">
                        <p class="card-title">Registrado por: </p><p class="card-text">{{ $Ventas->usuario->name }}</p>
                        <p class="card-title ">Nombre Cliente: </p><p class="card-text">{{ $Ventas->cliente->name }}</p>
                        <p class="card-title ">Precio Total: </p><p class="card-text">{{ $Ventas->price}}</p>
                        <p class="card-title ">Fecha: </p><p class="card-text">{{ $Ventas->created_at->format('D d M Y h:i A') }}</p>
                        <p class="card-title ">Estado: </p><p class="card-text">
                        @if ($Ventas->state)
                            <i><p class="alert alert-info">Realizada</p></i>           
                        @else
                            <i><p class="alert alert-danger">Cancelada.</p></i>  
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7" > 
                
                <div class="card-header ">
                    <ul class="nav nav-pills justify-content-center">
                        
                        @if (count($productos) != 0 && count($servicios) != 0)
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" data-toggle="tab" href="#prod">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#serv" data-toggle="tab">Servicios</a>
                            </li>
                        @elseif (count($productos) != 0 && count($servicios) == 0)
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" data-toggle="tab" href="#prod">Productos</a>
                            </li>
                        @elseif (count($servicios) != 0 && count($productos) == 0)
                            <li class="nav-item">
                                <a class="nav-link active" href="#serv" data-toggle="tab">Servicios</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class=" card-body tab-content">

                    @if (count($productos) != 0 && count($servicios) != 0)
                        <div class="chart tab-pane active" id="prod" style="position: relative;">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" cellpadding="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombre Producto</th>
                                                    <th scope="col">Imagen</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Precios</th>
                                                    <th scope="col">Estado</th>
                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($productos as $value)
                                                        <tr class="text-center">
                                                            <td>{{ $value->name }}</td>
                                                            <td>
                                                                @if($value->img != '')
                                                                <img src="{{ $value->img }}" style="width: 2rem; height: 2rem;" alt="">   
                                                                @else 
                                                                    <i class="fas fa-eye-slash text-danger" data-bs-toggle="tooltip" data-bs-placement="left" title="sin imagen"    ></i>
                                                                @endif
                                                            </td>
                                                            <td>{{ $value->amount }}</td>
                                                            <td>{{ $value->price }}</td>
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
                        </div>

                        <div class="chart tab-pane" id="serv" style="position: relative;">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" cellpadding="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Descripción</th>
                                                    <th scope="col">Precios</th>
                                                    <th scope="col">Estado</th>
                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($servicios as $value)
                                                        <tr>
                                                            <td>{{ $value->name }}</td>
                                                            <td>{{ $value->description }}</td>
                                                            <td>{{ $value->price }}</td>
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
                        </div>
                    @elseif (count($productos) != 0 && count($servicios) == 0)
                        <div class="chart tab-pane active" id="prod" style="position: relative;">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" cellpadding="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombre Producto</th>
                                                    <th scope="col">Imagen</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Precios</th>
                                                    <th scope="col">Estado</th>
                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($productos as $value)
                                                        <tr class="text-center">
                                                            <td>{{ $value->name }}</td>
                                                            <td>
                                                                @if($value->img != '')
                                                                    <img src="{{ $value->img }}" style="width: 2rem; height: 2rem;" alt="">   
                                                                @else 
                                                                    <i class="fas fa-eye-slash text-danger" data-bs-toggle="tooltip" data-bs-placement="left" title="sin imagen"    ></i>
                                                                @endif
                                                            </td>
                                                            <td>{{ $value->amount }}</td>
                                                            <td>{{ $value->price }}</td>
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
                        </div>
                    @elseif (count($servicios) != 0 && count($productos) == 0)
                        <div class="chart tab-pane active" id="serv" style="position: relative;">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" cellpadding="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Descripción</th>
                                                    <th scope="col">Precios</th>
                                                    <th scope="col">Estado</th>
                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($servicios as $value)
                                                        <tr>
                                                            <td>{{ $value->name }}</td>
                                                            <td>{{ $value->description }}</td>
                                                            <td>{{ $value->price }}</td>
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
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <hr>
            <div class="col-12">
                <div class="row ">
                    <div class="col d-flex justify-content-center">
                        <a href="{{ route('ventas.index') }}" class="btn btn-outline-dark">Volver</a>
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