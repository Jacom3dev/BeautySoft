

@extends('layouts.app')

@section('title','Proveedores')

@section('content')
<div class="container">
    <div class="row pt-3">
        <div class="col">
           <a href="{{route('proveedores.create')}}" class="btn principal-color text-white"  data-bs-toggle="tooltip" data-bs-placement="left" title="Registrar proveedor"><i class="fas fa-user-plus"></i> Crear Proveedor</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" cellpadding="0" id="tabla">
                    <thead class="text-center">
                        <tr>
                            
                            <th>Proveedor</th>
                            <th>Empresa</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($proveedor as $value)
                        <tr> 
                            
                            <td>{{$value->supplier}}</td>
                            <td>{{$value->enterprise}}</td>
                            <td>{{$value->cell}}</td>
                            @if($value->email != '')
                           
                             <td><span> {{$value->email}}</span></td>

                            @else
                            
                            <td><span> sin correo </span></td>

                            @endif
                            
                            @if($value->direction != '')
                            <td><span> {{$value->direction}}</span></td>
                            @else
                             <td><span>Sin direccion</span></td>

                            @endif
                          @if ($value->state)
                            <td class="text-center"><span class="badge badge-primary">Activo</span></td>  
                          @else
                            <td class="text-center"><span class="badge badge-danger">Deshabilitado</span></td>
                          @endif
                          <td>
                              <div class="d-flex justify-content-between flex-wrap">
                                <a href="{{route('proveedores.edit',$value->NIT)}}"><i class="far fa-edit text-warning"  data-bs-toggle="tooltip" data-bs-placement="left" title="Editar"></i></a>
                                <a href="{{route("proveedores.changeState",['NIT'=>$value->NIT,'state'=>$value->state])}}">
                                    @if ($value->state)
                                    <i class="fas fa-user-slash text-danger"  data-bs-toggle="tooltip" data-bs-placement="left" title="Deshabilitar"></i>
                                    @else
                                        <i class="far fa-user text-primary"  data-bs-toggle="tooltip" data-bs-placement="left" title="Habilitar"></i> 
                                    @endif</a>
                                </a>
                                <a href="{{route("proveedores.show",$value->NIT)}}"><i class="fas fa-info-circle text-primary"  data-bs-toggle="tooltip" data-bs-placement="left" title="Ver detalle"></i></a>
                              </div>
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