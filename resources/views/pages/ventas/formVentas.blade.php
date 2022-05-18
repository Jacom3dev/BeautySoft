@extends('layouts.app')
@section('title', 'Ventas')
@section('content')

<div class="container">
    <div class="row">
        <div class="col sticky-top" id="alt"></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11 mt-3 p-3 bg-white rounded">
            <div class="row pb-2">
                <div class="col-12">
                    <ul class="nav nav-pills d-flex justify-content-around">
                        <li class="nav-item">
                            <a class=" btn btn-outline-dark active" aria-current="page" data-toggle="tab" href="#prod">Generar Venta de
                                Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class=" btn btn-outline-dark" href="#serv" data-toggle="tab">Generar Venta de Servicios</a>
                        </li>
                        </li>
                    </ul>
                </div>
                
            </div>
            <hr>
            <form action="{{ route('ventas.store') }}" method="post">
                @csrf
                <div class="row pt-3">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6 form-group">
                                    <select class="js-example-basic-single form-control
                                        @error('cliente') is-invalid border border-warning  @enderror" name="cliente"
                                        id="cliente">
                                        <option value="" disabled selected>
                                            Clientes
                                        </option>
                                        @foreach($clientes as $value)
                                        <option value="{{ $value->id }}">
                                            {{ $value->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('cliente')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <input class="form-control text-center" type="number" name="precio_total"
                                        id="precio_total" placeholder="precio Total" readonly />
                                </div>
                            </div>

                            <div class="row">
                                <div class=" col tab-content">

                                    <div class="chart tab-pane active" id="prod" style="position: relative;">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="row pt-4">
                                                    <div class="col-12 form-group">
                                                        <select class="js-example-basic-single form-control"
                                                            name="producto" id="producto" onchange="todoprod()">
                                                            <option value="" disabled selected>
                                                                Productos
                                                            </option>
                                                            @foreach($productos as $value)
                                                            <option precioP="{{ $value->price }}"
                                                                cant="{{ $value->amount }}" value="{{ $value->id }}">
                                                                {{ $value->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <input type="hidden" name="cant" id="canti" />
                                                        <input class="form-control" type="number" name="cantidad"
                                                            id="cantidad" placeholder="Cantidad" />
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <input class="form-control" type="number" name="precio_producto"
                                                            id="precio_producto" placeholder="Precio de Producto"
                                                            readonly />
                                                    </div>
                                                    <div class="col-12 pb-3 d-flex justify-content-end">
                                                        <button class="btn principal-color text-white"
                                                            onclick="agregar_producto()" type="button">
                                                            <i class="fas fa-plus"></i>
                                                            <span> Agregar Producto</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <!-- TBL Productos -->
                                                    <div class="col-12 table-responsive  tbl_scroll">
                                                        <table class="table table-bordered w-100" cellspacing="0">
                                                            <thead class="">
                                                                <tr>
                                                                    <th>Nombre</th>
                                                                    <th>Cantidad</th>
                                                                    <th>Precio</th>
                                                                    <th>Subtotal</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tblProductos"></tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chart tab-pane" id="serv" style="position: relative;">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-12 form-group mt-4">
                                                        <select class="js-example-basic-single form-control w-100"
                                                            name="servicio" id="servicio"
                                                            onchange="cargar_precio_servicio()">
                                                            <option value="" disabled selected>
                                                                Servicios
                                                            </option>
                                                            @foreach($servicios as $value)
                                                            <option precios="{{ $value->price }}"
                                                                value="{{ $value->id }}">
                                                                {{ $value->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <input class="form-control" type="number" name="precio_servicio"
                                                            id="precio_servicio" placeholder="Precio de Servicio"
                                                            readonly />
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button class="btn principal-color text-white"
                                                            onclick="agregar_servicio()" type="button">
                                                            <i class="fas fa-plus"></i>
                                                            <span> Agregar Servicio</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <!-- TBL Servicios -->
                                                    <div class="col-12 table-responsive tbl_scroll">
                                                        <table class="table table-bordered" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nombre</th>
                                                                    <th>Precio</th>
                                                                    <th>Subtotal</th>
                                                                    <th>Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tblServicios"></tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-6 col-lg-2">
                        <button type="submit" class="btn btn-block principal-color text-white">
                            Crear Venta.
                        </button>
                    </div>
                    <div class="col-3 col-lg-1">
                        <a href="{{ route('ventas.index') }}" class="btn btn-outline-dark">Volver</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<<<<<<< HEAD

@endsection 




 @section('script_ventas')

=======
@endsection


@section('script_ventas')
>>>>>>> 577c2e8e31317e832b192ff5ff48ad5068819cd7
<script>
    function todoprod() {
        cargar_preciop(), cargar_cantidad();
    }

    function cargar_preciop() {
        let precio = $("#producto option:selected").attr("preciop");

        $("#precio_producto").val(precio);
    }

    function cargar_precio_servicio() {
        let precio = $("#servicio option:selected").attr("precios");

        $("#precio_servicio").val(precio);
    }

    function cargar_cantidad() {
        let cant = $("#producto option:selected").attr("cant");

        $("#canti").val(cant);
    }

    function agregar_producto() {
        let producto_id = $("#producto option:selected").val();
        let cantidad = $("#cantidad").val();

        if (producto_id > 0) {
            if (cantidad > 0) {

                let validacion = validar_producto();

                console.log(validacion);

                if (!validacion) {
                    let producto_text = $("#producto option:selected").text();
                    let precio = $("#precio_producto").val();
                    let cant = $("#canti").val();

                    if (parseInt(cantidad) < parseInt(cant)) {
                        $("#tblProductos").append(`
                            <tr id="tr-${producto_id}">
                                
                                    <input type="hidden" name="producto_id[]" value="${producto_id}" class="id_producto"/>
                                    <input type="hidden" name="cantidades[]" value="${cantidad}" class="cantidad_producto"/>

                                <td>
                                    ${producto_text}
                                </td>
                                <td class="cantidad_p" >${cantidad}</td>
                                <td>${precio}</td>
                                <td class="sub_p">
                                ${parseInt(precio) * parseInt(cantidad)}</td>
                                <td class="text-center">
                                    <button  type="button" class="btn btn-danger" onclick="eliminar(${producto_id})"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            `);

                        let precioT = $("#precio_total").val() || 0;
                        $("#precio_total").val(
                            parseInt(precioT) +
                            parseInt(precio) * parseInt(cantidad)
                        );

                        $("#producto").val("");
                        $("#cantidad").val("");
                        $("#precio_producto").val("");
                    } else {

                        Swal.fire({
                            icon: 'warning',
                            title: '¡Atención!',
                            text: `-${producto_text}- insuficiente, ${cant} productos disponibles.`,
                        })
                        /*  $("#alt").append(`
                                    <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                                        <strong>¡Atención! {{ Auth::user()->name }}</strong>
                                        <hr> 
                                        -${producto_text}- insuficiente, ${cant} productos disponibles.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    `); */
                    }
                }
            } else {

                Swal.fire({
                    icon: 'warning',
                    title: '¡Atención!',
                    text: `Ingresar una cantidad.`,
                })
            }
        } else {
            Swal.fire({
                icon: 'warning',
                title: '¡Atención!',
                text: `Seleccionar un producto.`,
            })
        }
    }

    function validar_producto() {
        let validation = false;



        if ($("table tbody#tblProductos tr").length > 0) {
            $("table tbody#tblProductos tr").each(function () {

                if ($(this).find("input.id_producto").val() == $("#producto option:selected").val()) {
                    validation = true;

                    $(this)
                        .find("input.cantidad_producto")
                        .val(
                            parseInt(
                                $(this).find("input.cantidad_producto").val()
                            ) + parseInt($("#cantidad").val())
                        );

                    let subtotal = parseInt(
                        $("#cantidad").val() *
                        parseInt($("#precio_producto").val())
                    );
                    let precio_total = $("#precio_total").val() || 0;

                    $("#precio_total").val(
                        parseInt(precio_total) + parseInt(subtotal)
                    );

                    $(this)
                        .find("td.sub_p")
                        .text(
                            parseInt($(this).find("td.sub_p").text()) +
                            parseInt(
                                parseInt($("#cantidad").val()) *
                                parseInt($("#precio_producto").val())
                            )
                        );
                    $(this)
                        .find("td.cantidad_p")
                        .text(
                            parseInt($(this).find("td.cantidad_p").text()) +
                            parseInt($("#cantidad").val())
                        );

                    $("#producto").val("");
                    $("#cantidad").val("");
                    $("#precio_producto").val("");
                }
            });
        }

        return validation;
    }


    function agregar_servicio() {
        let id_servicio = $("#servicio option:selected").val();
        let servicio_text = $("#servicio option:selected").text();
        let precioS = $("#precio_servicio").val();
        if (id_servicio != 0) {
            $("#tblServicios").append(`
            <tr id="tr-${id_servicio}">
                
                    <input type="hidden" name="servicio_id[]" value="${id_servicio}"/>
                <td>
                    ${servicio_text}
                </td>
                <td>${precioS}</td>
                <td>${parseInt(precioS)}</td>
                <td class="text-center">
                    <button  type="button" class="btn btn-danger" onclick="eliminar_servicio(${id_servicio},(${parseInt(
                precioS
            )}))"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            `);

            let precioT = $("#precio_total").val() || 0;
            $("#precio_total").val(parseInt(precioT) + parseInt(precioS));

            $("#servicio").val("");
            $("#precio_servicio").val("");
        } else {
            Swal.fire({
                icon: 'warning',
                title: '¡Atención!',
                text: `Seleccionar Servicio.`,
            })

            // $("#alt").append(`
            // <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
            //         <strong>¡Atención! {{ Auth::user()->name }}</strong>
            //         <hr> 
            //         Seleccionar un servicio.
            //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            //             <span aria-hidden="true">&times;</span>
            //         </button>
            //     </div>
            //     `);
        }
    }

    function eliminar(id) {
        let fila = $("#tr-" + id);
        let subtotal = parseInt(fila.find("td.sub_p").text());
        fila.remove();
        let precioT = $("#precio_total").val() || 0;
        $("#precio_total").val(parseInt(precioT) - parseInt(subtotal));

    }

    function eliminar_servicio(id, price) {
        $("#tr-" + id).remove();
        let price_t = $("#precio_total").val() || 0;
        $("#precio_total").val(parseInt(price_t) - price);


    }
</script>

@endsection