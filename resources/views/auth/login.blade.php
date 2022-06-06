<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('/')}}/css/login.css">
    <title>Login</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-11 col-md-8 col-lg-6 fondo mt-5 px-5 py-2">
                <div class="row">
                    <div class="col-12">
                        <h2 class="title">
                            BeautySoft
                        </h2>
                    </div>
                    <div class="col-12">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col">
                                    <input id="email" type="email" class="input @error('email') is-invalid border border-warning  @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <div class="col">
                                    <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
    
                            <div class="row mb-2">
                                <div class="col d-flex justify-content-end">
                                    @if (Route::has('password.request'))
                                    <a class="recuperar" href="{{ route('password.request') }}" target="_blank">
                                        {{ __('Restablecer Contraseña') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col d-flex justify-content-center">
                                    <button type="submit" class="boton">
                                       Iniciar sesión
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
    @include('sweetalert::alert')
    {{-- Sweetalert2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('error'))
    <script>
       Swal.fire(
            'Error de login',
            "{{Session::get("error")}}",
            'success'
        )
    </script>
    @endif
</body>
</html>