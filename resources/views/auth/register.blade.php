@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 mt-4 p-2 bg-white rounded">
            <h5 class="text-center">Registrar Ususario</h5>
            <form method="POST"  action="{{ route('register') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nombre" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col">
                        <input id="cell" type="text" class="form-control @error('cell') is-invalid @enderror" name="cell" value="{{ old('cell') }}" placeholder="Celular"  autocomplete="cell" autofocus>
                        @error('cell')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Correo" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña" required autocomplete="new-password">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <input id="direction" type="text" class="form-control @error('direction') is-invalid @enderror" name="direction" value="{{ old('direction') }}" placeholder="Dirreccion" required autocomplete="direction">
                        @error('direction')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <input type="hidden" name="state" value="1">

                <div class="row mb-0">
                    <div class="col">
                        <button type="submit" class="btn principal-color btn-block text-white">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <hr>
        <div class="col-12">
            <div class="row mt-3">
                <div class="col d-flex justify-content-center">
                    <a href="{{route('usuarios.index')}}" class="btn btn-outline-dark" ">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
