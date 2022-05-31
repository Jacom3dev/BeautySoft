@extends('layouts.app')
@section('title')
Productos
@endsection

@section('content')

<div class="container">
    {{-- <div class="row pt-2">
        <a href="{{route('productos.create')}}">
            <button class="btn principal-color text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Registrar producto">Crear producto</button>
        </a>
    </div> --}}
    
    <div class="row pt-2">
        <a href="{{route('productos.create')}}">
            <button class="btn principal-color text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Registrar producto">
                <i class="fab fa-product-hunt"></i>
                Crear producto
            </button>
        </a>
    </div>

    <div class="row mt-2">
            <div class="col">
                <div class="dt-responsive">
                    <table class="table table-striped table-bordered nowrap" cellpadding="0" id="tabla">
                         <thead class="text-center">
                            <tr>
                               
                                <th scope="col">Nombre Producto</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
         
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ( $productos as $value  )
                            <tr>
                                
                                <td>{{$value->name}}</td>
                                <td class="text-center">  
                                    
                                @if($value->img != '')
                                    <a href="{{route('productos.show',$value->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="ver imagen"><i class="fas fa-image text-primary"></i></i></a>    
                                @else 
                                    <i class="fas fa-eye-slash text-danger" data-bs-toggle="tooltip" data-bs-placement="left" title="sin imagen"    ></i>
                                @endif
                                </td>
                                <td>{{$value->amount}}</td>
                                <td>&#36;{{number_format($value->price_sale)}}</td>
                                <td class="text-center">
                                @if($value->state == 1)
                                <span class="badge badge-primary">Activo</span>

                                @else 
                                <span class="badge badge-danger">Desactivado</span>
                                @endif      
                                </td>
                                <td class=" d-flex justify-content-around">
                                    @if($value->state == 1)
                                    <a href="{{route("productos.changeState",["id"=>$value->id,"state"=>0])}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Inhabilitar"  > <span class=""><i class="fas fa-ban text-danger"></i></span></a>

                                    @else 
                                    <a href="{{route("productos.changeState",["id"=>$value->id,"state"=>1])}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Habilitar"  ><span class=""><i class="far fa-check-circle text-primary"></i></span></a>
                                    @endif 
                                    <a href="{{route('productos.edit',$value->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Editar" ><i class="far fa-edit text-warning"></i></a>
                                    <a href="{{route('productos.show',$value->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Ver detalle" ><i class="fas fa-info-circle text-primary"></i></a>
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
@section('js')
<script>
$(document).ready(function() {
$('#TadaBaseProductos').DataTable({


        processing: true,
        serverSide: true,
        // ajax:,
        columns:[
          
            {
                data:'nombre',
                name:'nombre'
            },
            {
                data:'cantidad',
                name:'cantidad'
            },
            {
                data:'precio',
                name:'precio'
            },
            {
                data:'editar',
                name:'editar',
                orderable: false,
                searchable: false
            },
            {
                data:'detalle',
                name:'detalle',
                orderable: false,
                searchable: false
            },
            ],

        "language": {
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "zeroRecords": "Sin resultados encontrados",
            "info":  "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty":" Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente ",
            "previous": " Anterior"
            }
        }
    });

});
</script>
@endsection
