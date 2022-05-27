@extends('layouts.app')

@section('title','Usuarios')

@section('content')
<div class="container">
    <div class="row">
        <div class="col mt-4">
           <a href="{{route('usuarios.create')}}" class="btn principal-color text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Registrar usuario"><i class="fas fa-user-plus" ></i> Crear Usuario</a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col p-4  bg-white rounded">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" cellpadding="0" id="tabla">
                    <thead class="text-center">
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->rol_name}}</td>
                          @if ($user->state)
                            <td class="text-center"><span class="badge badge-primary">Activo</span></td>  
                          @else
                            <td class="text-center"><span class="badge badge-danger">Deshabilitado</span></td>
                          @endif 
                           <td class="text-center">
                              <div class="d-flex justify-content-between flex-wrap" data-bs-toggle="tooltip" data-bs-placement="left" title="Ver detalle">
                                @if ($user->rol_id != 1 && $user->rol_state == 1)
                                    @if ($user->state)    
                                        <a href="{{route("usuarios.edit",$user->id)}}"><i class="far fa-edit text-warning" data-bs-toggle="tooltip" data-bs-placement="left" title="Editar"></i></a>
                                    @endif
                                    <a href="{{route("usuarios.changeState",['id'=>$user->id,'state'=>$user->state])}}">
                                        @if ($user->state)
                                        <i class="fas fa-user-slash text-danger" title="Deshabilitar"></i>
                                        @else
                                            <i class="far fa-user text-primary" title="Habilitar"></i> 
                                        @endif
                                    </a>
                                @endif
                               
                                <a href="{{route("usuarios.show",$user->id)}}"><i class="fas fa-info-circle text-primary"></i></a>
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