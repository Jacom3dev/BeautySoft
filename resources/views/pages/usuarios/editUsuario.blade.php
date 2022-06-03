
@extends('layouts.app')

@section('title','Editar Usuario')

@section('content')
<div class="container px-4">
    <div class="row"></div>
    <div class="row mt-3 py-2 bg-white rounded">
            <div class="col-12 mt-4 pt-3">
                <!-- Nav tabs -->
                <ul class="nav nav-pills justify-content-around" id="myTab" role="">
                    <li class="nav-item" >
                    <a href="#Info" class=" btn btn-outline-dark btn-block active mb-md-0 mb-3" id="home-tab" aria-current="page" data-toggle="tab">Editar Informacion de Usuario.</a>
                    </li>
                    <li class="nav-item">
                    <a href="#Pass" class=" btn btn-outline-dark btn-block" id="profile-tab" data-toggle="tab">Editar Contraseña.</a>
                    </li>
                </ul>
                
            </div>
            <div class="col-12">
                <!-- Tab panes -->
                <div class="tab-content" style="min-height: 25rem; max-height: 25rem">
                    <div class="chart tab-pane active" id="Info" style="position: relative;">
                        <div class="row justify-content-center">
                            <div class="col-10 col-md-8 col-lg-7 mt-4">
                                <h3 class="text-center"> <strong style="color: rgba(2, 93, 113, 1);">Editar Informacion de usuario.</strong></h3>
                                <form method="POST" action="{{route('usuarios.update', $user->id)}}">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-12 col-sm-6 mt-2">
                                            <input  type="text" class="form-control @error('name') is-invalid border border-warning  @enderror" name="name" value="{{$user->name}}" placeholder="Nombre">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6 mt-2">
                                            <input type="text" class="form-control @error('cell') is-invalid border border-warning  @enderror" name="cell" value="{{$user->cell}}" placeholder="Celular">
                                            @error('cell')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                    
                                    <div class="row">
                                        <div class="col mt-2">
                                            <input  type="email"class="form-control @error('email') is-invalid border border-warning  @enderror" name="email" value="{{$user->email}}" placeholder="Correo">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                    
                                    <div class="row">
                                       <div class="col mt-2">
                                           <select name="rol_id" class="form-control">
                                               @foreach ($roles as $rol)
                                                    <option value="{{$rol->id}}">{{$rol->name}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                    </div>
                    
                                    <div class="row">
                                        <div class="col mt-2">
                                            <input id="direction" type="text"class="form-control @error('direction') is-invalid border border-warning  @enderror" name="direction" value="{{$user->direction}}" placeholder="Dirreccion" >
                                            @error('direction')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                    
                                    <input type="hidden" name="state" value="{{isset($user)?$user->state:'1'}}">
                    
                                    <div class="row py-3 justify-content-end">
                                        <div class="col-12 col-sm-6 col-lg-4 pb-md-0 pb-3">
                                            <button type="submit" class="btn principal-color btn-block text-white" id="btn-user">{{isset($user)?'Editar':'Register'}}
                                            </button>
                                        </div>
                                        
                                        <div class="col-12 col-sm-4 col-lg-3 pb-md-0 pb-3">
                                            <a href="{{route('usuarios.index')}}" class="btn btn-outline-dark btn-block">Volver</a>
                                        </div>
                                    </div>
                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="Pass" style="position: relative;"> 
                        <div class="row justify-content-center">
                            <div class="col-10 col-md-8 col-lg-6 mt-4">
                                <h3 class="text-center"> <strong style="color: rgba(2, 93, 113, 1);">Editar contraseña.</strong></h3>
                                <form method="POST" action="{{route('usuarios.updatePassword', $user->id)}}"  id="form-user">
                                    @csrf
                                    @method('put')
    
                                    <div class="row">
                                        <div class="col-12 mt-2">
                                            <input  type="text" class="form-control @error('password') is-invalid border border-warning  @enderror" name="password" placeholder="Contraseña">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
    
                                    <div class="row py-3 justify-content-end">
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <button type="submit" class="btn principal-color btn-block text-white" id="btn-user">{{isset($user)?'Editar':'Register'}}
                                            </button>
                                        </div>
                                        
                                        <div class="col-12 col-md-4 col-lg-3">
                                            <a href="{{route('usuarios.index')}}" class="btn btn-outline-dark btn-block">Volver</a>
                                        </div>
                                    </div>
    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
            {{-- <div class="row justify-content-center">
                <hr>
                <div class="col-12">
                    <div class="row mt-3">
                        <div class="col d-flex justify-content-center">
                            <a href="{{route('usuarios.index')}}" class="btn btn-outline-dark">Volver</a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
@endsection