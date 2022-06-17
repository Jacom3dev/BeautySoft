<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('/')}}/css/login.css">
    <title>Enviar email</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 fondo mt-5 px-5 py-2">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-12">
                            <h2 class="title">
                                BeautySoft
                            </h2>
                        </div>
                        <div class="col">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror input" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Ingrese su correo" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <button class="boton mt-3" type="submit" data-bs-toggle="tooltip" data-bs-placement="left" title="Enviar correo de recuperación">Enviar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <img src="{{url('/')}}/imagenes/barber.svg" class="img-barber" alt="">
                        </div>
                    </div>
                </form>

                
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
    {{-- Sweetalert2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('status'))
    <script>
       Swal.fire(
            'Correo enviado',
            'Se ha enviado el correo, por favor, revise su bandeja de entrada',
            'success'
        )
    </script>
    @endif
</body>
</html>


