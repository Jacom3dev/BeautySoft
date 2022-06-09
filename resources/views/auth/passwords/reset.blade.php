<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('/')}}/css/login.css">
    <title>Cambiar contraseña</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 fondo mt-5 px-5 py-2">
                <div class="row">
                    <div class="col-12">
                        <h2 class="title">
                            BeautySoft
                        </h2>
                    </div>
                    <div class="col-12">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <div class="col">
                                <input id="email" type="hidden" class="input @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" readonly >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="new-password" autofocus>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <input id="password-confirm" type="password" class="input" name="password_confirmation" placeholder="Confirmar contraseña"  required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col offset-md-4">
                                <button type="submit" class="boton" >
                                    {{ __('Cambiar contraseña') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="col-12">
                        <img src="{{url('/')}}/imagenes/barber.svg" class="img-barber" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>