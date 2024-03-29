@extends('layouts.app')
@section('title')
    Servicios
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col sticky-top" id="alt"></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-11 mt-4 p-2 bg-white rounded">
                <h3 class="text-center"> <strong style="color: rgba(2, 93, 113, 1);">Registrar Servicio.</strong></h3>
                <form action="{{ route('servicios.store') }}" class=" formulario-Crear" method="POST">
                    @csrf
                    <div class="row py-3 px-4 ">
                        <div class="col-12  col-md-6">
                            
                            <div class="row">
                                <div class="col-12 col-md-6 form-group">
                                    <label for="name">Nombre*</label>
                                    <input type="text"  id="name" placeHolder="Nombre*" value="{{old('name')}}"
                                        class="form-control  @error('name') is-invalid @enderror" name="name">
                                    @error('name')
                                         <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span> 
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 form-group">
                                    <label for="price-obra">Precio mano de obra*</label>
                                    <input type="number" id="price-obra" placeholder="Precio mano de obra*" value="{{old('price')}}"
                                        class="form-control @error('price') is-invalid @enderror" name="price_work">
                                    @error('price')
                                         <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span> 
                                    @enderror
                                </div>

                                <div class="col-12  form-group">

                                <label for="descri">Descripción</label>
                                    <textarea name="description" placeholder="Descripción" id="descri" 
                                        class="form-control @error('descriptcion') is-invalid @enderror ">{{old('description')}}</textarea>
                                    @error('descriptcion')
                                         <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span> 
                                    @enderror
                                </div>

                                <div class="col-12 pt-4 form-group">
                                    <label for="producto">Productos</label>
                                    <select name="producto_id" id="producto"
                                        class=" js-example-basic-single form-control @error('producto') is-invalid @enderror"
                                        onchange="precio_totalp()" style="width: 100%;">
                                        <option value="" disabled selected>Productos </option>
                                        @foreach ($producto as $value)
                                            @if ($value->state != 0)
                                                <option cantidadP="{{ $value->amount }}" precioP="{{ $value->price_sale }}"
                                                    value="{{ $value->id }}">
                                                    {{ $value->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('producto')
                                         <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span> 
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 form-group">

                                <label for="Cantidad">Cantidad</label>
                                    <input  type="number" placeholder="Cantidad" id="Cantidad"
                                        class="form-control @error('precioP') is-invalid @enderror" name="Cantidad">

                                    @error('Cantidad')
                                        <small class="">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 form-group">
                                    <label for="precioP">Precio Unidad</label>
                                    <input type="text" placeholder="Precio producto" id="precioP"
                                        class="form-control @error('precioP') is-invalid @enderror" name="precioP" readonly>

                                    @error('precioP')
                                         <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span> 
                                    @enderror
                                </div>

                                <div class="col-12 pb-md-0 pb-3 d-flex justify-content-end">
                                    <button type="button" onclick="agregar_Producto()" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Agregar producto al servicio"
                                        class="btn principal-color text-white"><i class="fas fa-plus"></i>

                                        <span> Agregar producto</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="row g-3">
                                <div class="col-12 form-group">

                                <label for="preciototalP">Precio final</label>
                                    <input type="text" placeholder="Precio final" id="preciototalP"
                                        class="form-control @error('precioP') is-invalid @enderror" name="precioP" readonly>

                                    @error('precioP')
                                         <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span> 
                                    @enderror
                                </div>
                                <div class="col-12 form-group table-responsive tbl_scroll">
                                    <table class="table table-bordered" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Subtotal</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbalaProducto"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row pb-3 px-4 justify-content-end">
                        <div class="col-12 col-md-6 col-lg-3 pb-md-0 pb-3">
                            <button type="submit" onclick="crear()"class="btn btn-block principal-color text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Registrar servicio ">
                                Crear
                            </button>
                        </div>
                        <div class="col-12 col-md-3 col-lg-2">
                            <a href="{{ route('servicios.index') }}" class="btn btn-outline-dark btn-block" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir atrás">Volver</a>
                        </div>
                    </div>

                    
                </form>
            </div>
        </div>

    </div>
@endsection
@section('js-alert')
    <script>
        //    THE SELECT OF PRODCUT'S  FUNCTIONS
        function precio_totalp() {

            let precioP = $("#producto option:selected").attr("preciop");

            $("#precioP").val(precioP);

        }

        function agregar_Producto() {
            let producto = $("#producto option:selected").text();
            let precioP = $("#producto option:selected").attr("preciop");
            let idP = $("#producto option:selected").val();
            let Cantidad = $("#Cantidad").val();
            let precioTotalP = $("#preciototalP").val();

            if (idP > 0 && Cantidad > 0) {
                let validacion = validar_producto();



                if (!validacion) {



                    $("#tbalaProducto").append(`
                            <tr id="tr-${idP}">
                                
                                    <input type="hidden" name="productos_id[]" value="${idP}" class="id_producto"/>
                                    <input type="hidden" name="cantidades[]" value="${Cantidad}" class="cantidad_producto"/>

                                <td>
                                    ${producto}
                                </td>
                                <td class="cantidad_p" >${Cantidad}</td>
                                <td>${precioP}</td>
                                <td class="sub_p">${
                                    parseInt(precioP) * parseInt(Cantidad)
                                }</td>
                                <td class="text-center">
                                <button type="button" class="btn btn-danger float-right " data-bs-toggle="tooltip" data-bs-placement="left" title="Eliminar de lista" onclick="EliminarP(${idP})"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            `);

                    let precioT = $("#preciototalP").val() || 0;

                    $("#preciototalP").val(parseInt(precioT) + (parseInt(Cantidad) * parseInt(precioP)));

                    $("#Cantidad").val("1");


                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: '!Ocurrio un Error¡',
                    text: 'Por favor seleccione un producto o coloque una cantidad mayor a 0 ',

                })
            }
        }

        function validar_producto() {
            let validation = false;


            if ($("table tbody#tbalaProducto tr").length > 0) {
                $("table tbody#tbalaProducto tr").each(function() {

                    if ($(this).find("input.id_producto").val() == $("#producto option:selected").val()) {
                        validation = true;

                      
                            $(this)
                                .find("input.cantidad_producto")
                                .val(
                                    parseInt(
                                        $(this).find("input.cantidad_producto").val()
                                    ) + parseInt($("#Cantidad").val())
                                );

                            let subtotal = parseInt(
                                $("#Cantidad").val() *
                                parseInt($("#precioP").val())
                            );
                            let precio_total = $("#preciototalP").val() || 0;

                            $("#preciototalP").val(
                                parseInt(precio_total) + parseInt(subtotal)
                            );

                            $(this)
                                .find("td.sub_p")
                                .text(
                                    parseInt($(this).find("td.sub_p").text()) +
                                    parseInt(
                                        parseInt($("#Cantidad").val()) *
                                        parseInt($("#precioP").val())
                                    )
                                );
                            $(this)
                                .find("td.cantidad_p")
                                .text(
                                    parseInt($(this).find("td.cantidad_p").text()) +
                                    parseInt($("#Cantidad").val())
                                );


                            $("#Cantidad").val("1");

                        



                    }
                });
            }

            return validation;
        }

        function EliminarP(idp) {
            let fila = $("#tr-" + idp);
            let subtotal = parseInt(fila.find("td.sub_p").text());
            fila.remove();
            let precioT = $("#preciototalP").val() || 0;
            $("#preciototalP").val(parseInt(precioT) - parseInt(subtotal));

        }

        //alerta 

       function crear() {
        $('.formulario-Crear').submit(function(e) {

        e.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        })

        swalWithBootstrapButtons.fire({
            title: '¿Estas seguro?',
            text: "El servicio se agregará",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, seguro.',
            cancelButtonText: 'No, cancelar.',
            confirmButtonColor: 'rgba(2, 93, 113, 1)',
            cancelButtonColor: 'red',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
               
                this.submit();
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Reviza que deseas cambiar e intente de nuevo ',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        })

        });
           
       }
    </script>
@endsection
