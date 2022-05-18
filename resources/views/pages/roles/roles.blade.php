@extends('layouts.app')

@section('title','Roles')

@section('content')
<div class="container">
    <div class="row">
        <div class="col mt-3">
           <a href="{{route('roles.create')}}" class="btn principal-color text-white"><i class="fas fa-user-plus"></i> Registrar Rol</a>
        </div>
    </div>
    <div class="row mt-2 px-3 py-2">
        <div class="col p-3  bg-white rounded">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" cellpadding="0" id="tabla">
                    <thead>
                        <tr>
                            <th>Rol</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center
                            ">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $rol)
                        <tr>
                          <td>{{$rol->name}}</td>
                            @if ($rol->state)
                            <td class="text-center"><span class="badge badge-primary">Activo</span></td>  
                            @else
                            <td class="text-center"><span class="badge badge-danger">Deshabilitado</span></td>
                            @endif
                          <td>
                              <div class="d-flex justify-content-around flex-wrap">
                                @if ($rol->id !== 1)
                                    @if ($rol->state)
                                        <a href="{{route("roles.edit",$rol->id)}}"><i class="fas fa-pencil-ruler text-warning"></i></a>
                                    @endif
                                    <a href="{{route("roles.changeState",['id'=>$rol->id,'state'=>$rol->state])}}">
                                        @if ($rol->state)
                                            <i class="fas fa-lock text-danger"></i>
                                        @else
                                            <i class="fas fa-lock-open text-primary"></i>
                                        @endif
                                    </a>
                                @endif
                               
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