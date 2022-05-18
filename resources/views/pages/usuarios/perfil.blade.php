@extends('layouts.app')

@section('title','Perfil')

@section('content')
<div class="container">
    <br>
    <div class="row perfil m-2 p-3">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h5 class="text-center title">Información Personal</h5>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <img src="{{url('/')}}/imagenes/profile.png" class="img-profile" alt="profile">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form action="{{route('perfil.updateInfo',$user->id)}}" method="POST" class="p-2">
                        @csrf
                        @method('put')
                        <div class="row mt-3">
                            <div class="col">
                                <input type="text" placeholder="Nombre" name="name" class="input" value="{{$user->name}}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                                @enderror
                            </div>
                        </div>
                       <div class="row mt-3">
                            <div class="col">
                                <input type="text" placeholder="Direccion" name="direction" class="input" value="{{$user->direction}}">
                                @error('direction')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                                @enderror
                            </div>
                       </div>
                       <div class="row mt-3">
                            <div class="col">
                                <input type="text" placeholder="celullar" name="cell" class="input" value="{{$user->cell}}">
                                @error('cell')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                                @enderror
                            </div>
                       </div>
                       <div class="row mt-5">
                           <div class="col d-flex justify-content-center">
                               <button type="submit" class="boton">Actualizar</button>
                           </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col d-flex flex-column justify-content-between">
            <div class="row">
                <div class="col">
                    <h5 class="text-center title">Información Acceso</h5>
                </div>
            </div>
            <div class="row ">
                <div class="col">
                    <form action="{{route('perfil.updatePassword',$user->id)}}" method="POST" class="p-2">
                        @csrf
                        @method('put')
                        <div class="row mt-3">
                            <div class="col">
                                <input type="email" placeholder="correo" class="input" name="email" value="{{$user->email}}"  @if ($user->rol_id ==1)   readonly @endif>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                            </div>
                        </div>
                       <div class="row mt-3">
                            <div class="col">
                                <input  type="password" class="form-control @error('password') is-invalid border border-warning  @enderror" name="password" placeholder="Contraseña">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                       </div>
                       <div class="row mt-3">
                            <div class="col">
                                <input  type="password" class="form-control" placeholder="Confirmar contraseña"  name="password_confirmation">
                            </div>
                       </div>
                       <ul>
                    </ul>
                        <div class="row mt-5">
                           <div class="col d-flex justify-content-center">
                               <button type="submit" class="boton">Actualizar</button>
                           </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
