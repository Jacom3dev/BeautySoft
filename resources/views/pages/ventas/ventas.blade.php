@extends('layouts.app')

@section('title', 'Ventas')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col mt-4">
                <a href="{{ route('ventas.create') }}" class="btn principal-color text-white"  data-bs-toggle="tooltip" data-bs-placement="left" title="Registrar venta" >
                    <i class="fas fa-tag"></i>
                    Crear Venta</a>
            </div>
        </div>
        <div class="row mt-2 px-3 py-2">
            <div class="col p-3  bg-white rounded">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover nowrap" style="width:100%" cellpadding="0" id="tabla">
                        <thead class="text-center">
                            <tr>
                                <th>Nombre Vendedor</th>
                                <th>Nombre Cliente</th>
                                <th>Precio</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($Ventas as $value)
                                <tr>
                                    <td>{{ $value->usuario->name }}</td>
                                    <td>{{ $value->cliente->name }}</td>

                                    <!-- <td>
                                        @foreach ($productos as $producto)
                                            @if ($value->id === $producto->sale_id)
                                            <span id="text">{{ $producto->name }}: <b>{{ $producto->amount }},</b></span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                            @foreach ($servicios as $servicio)
                                                @if ($value->id === $servicio->sale_id && $servicio->id != '')
                                                <span id="text">{{ $servicio->name }},</b></span>
                                            @else
                                                <span>Sin servicios</span>
                                                @endif
                                                @endforeach
                                    </td> -->
                                    <td>&#36;{{number_format( $value->price) }}</td>
                                    <td>{{ $value->created_at->format('D d M Y \ h:i a') }}</td>
                                    <td class="text-center">
                                        @if ($value->state)
                                            <span class="badge badge-primary">Realizada</span>
                                        @elseif(!$value->state)
                                            <span class="badge badge-danger">Anulada</span>
                                        @endif
                                    </td>
                                    <td class=" d-flex justify-content-around ">
                                        @if (Auth::user()->rol_id == 1)
                                            @if ($value->state)
                                                <a href="/ventas/{{ $value->id }}/{{ $value->state }}"
                                                    class=""><i class="fas fa-times-circle text-danger" data-bs-toggle="tooltip" data-bs-placement="left" title="Anular"></i></a>
                                            @elseif(!$value->state)
                                            
                                            @endif
                                        @endif

                                       
                                        <a href="{{ route('ventas.show', $value->id) }}" class=""><i
                                                class="fas fa-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="Ver detalle"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        let text = $("#text").innerText;
        let cortar = text.substr(0, -1)

        $("#text").innerText = cortar
    </script>
@endsection
