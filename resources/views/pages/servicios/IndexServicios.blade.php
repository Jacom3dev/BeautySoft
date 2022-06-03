@extends('layouts.app')
@section('title')
 Servicios
@endsection

@section('content')
<div class="container">
    <div class="row pt-2">
        <a href="{{route('servicios.create')}}">
            <button class="btn principal-color text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Registrar servicio" >
                <i class="fas fa-concierge-bell"></i>
                Crear servicio
            </button>
        </a>
    </div>
  
    <div class="row mt-2">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap" cellpadding="0" id="tabla">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Nombre Servicio</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ( $servicios as $value  )
                            <tr>
                                
                                <td>{{$value->name}}</td>
                                <td>&#36;{{number_format($value->price)}}</td>
                                <td>{{$value->description}}</td>
                                <td class="text-center">
                                @if($value->state == 1)
                                <span class="badge badge-primary">Activo</span>

                                @else 
                                <span class="badge badge-danger">Desactivado</span>
                                @endif      
                                </td>
                                <td class=" d-flex justify-content-around">
                                    @if($value->state == 1)
                                    <a href="{{route("servicios.changeState",["id"=>$value->id,"state"=>0])}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Inhabilitar"  > <span class=""><i class="fas fa-ban text-danger"></i></span></a>

                                    @else 
                                    <a href="{{route("servicios.changeState",["id"=>$value->id,"state"=>1])}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Habilitar"  ><span class=""><i class="far fa-check-circle text-primary"></i></span></a>
                                    @endif   
                                    <a href="{{route('servicios.edit',$value->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Editar" ><i class="far fa-edit text-warning"></i></a>
                                    <a href="{{route('servicios.show',$value->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Ver detalle" ><i class="fas fa-info-circle text-primary"></i></a>
                                
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
</div>



@section('js')
<script>
$(document).ready(function() {
$('#TadaBaseServicios').DataTable({


        processing: true,
        serverSide: true,
        ajax:'listar/servicios',
        columns:[{
            data: 'name',
            name: 'name'
        },
        {
            data: 'description',
            name: 'description'
        },
        {
            data: 'price',
            name: 'price'
        },
        {
            data: 'state',
            name: 'state',
            orderable: false,
            searchable: false
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
        },],

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
@endsection