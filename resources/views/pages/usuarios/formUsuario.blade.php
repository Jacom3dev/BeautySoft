@extends('layouts.app')

@section('title','Registrar Usuario')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 col-md-8 col-lg-8 mt-4 p-3 px-5 bg-white rounded">
            <h3 class="text-center"> <strong style="color: rgba(2, 93, 113, 1);">Registrar Usuario.</strong></h3>
            <form method="POST" action="{{route('usuarios.store')}}">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-6 mt-2">
                        <label for="name">Nombre*</label>
                        <input  type="text" id="name" class="form-control @error('name') is-invalid border border-warning  @enderror" name="name" value="{{old('name')}}" placeholder="Nombre*">
                        @error('name')
                         <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 mt-2">
                        <label for="cell">Celular</label>
                        <input type="text" id="cell" class="form-control @error('cell') is-invalid border border-warning  @enderror" name="cell" value="{{old('cell')}}" placeholder="Celular">
                        @error('cell')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col mt-2">
                        <label for="email">Correo*</label>
                        <input  type="email" id="email" class="form-control @error('email') is-invalid border border-warning  @enderror" name="email" value="{{old('email')}}" placeholder="Correo*">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6 mt-2">
                        <label for="pass">Contraseña*</label>
                        <input  type="password" id="pass" class="form-control @error('password') is-invalid border border-warning  @enderror" name="password" placeholder="Contraseña*">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="col-12 col-sm-6 mt-2">
                        <label for="select_rol">Rol*</label>
                        <select name="rol_id" id="select_rol" class="form-control">
                            <option value="" disabled selected>Rol</option>
                            @foreach ($roles as $rol)
                                <option value="{{$rol->id}}">{{$rol->name}}</option>
                            @endforeach
                        </select>
                        @error('rol_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col mt-2">
                        <label for="direction">Dirección</label>
                        <input id="direction" type="text"class="form-control @error('direction') is-invalid border border-warning  @enderror" name="direction" value="{{old('direction')}}" placeholder="Dirección" >
                        @error('direction')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <input type="hidden" name="state" value="1">

                <div class="row pt-4 pb-1 justify-content-end">
                    <div class="col-12 col-sm-6 col-lg-4 pb-md-0 pb-3">
                        <button type="submit" class="btn principal-color btn-block text-white" id="btn-user" data-bs-toggle="tooltip" data-bs-placement="left" title="Registrar usuario">Registrar</button>
                    </div>
                    
                    <div class="col-12 col-sm-4 col-lg-2 ">
                        <a href="{{route('usuarios.index')}}" class="btn btn-outline-dark btn-block" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir atrás">Volver</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
    {{-- <div class="row justify-content-center">
        <hr>
        <div class="col-12">
            <div class="row mt-3">
                <div class="col d-flex justify-content-center">
                    <a href="{{route('usuarios.index')}}" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir atrás">Volver</a>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
