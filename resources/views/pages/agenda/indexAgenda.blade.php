@extends('layouts.app')

@section('title')
    Agenda
@endsection

@section('content')
    <!-- calendario -->
    <div class="container">
        <div class="row px-3 py-2">
            <div class="col p-3 bg-white">
                <div id="calendar">

                </div>
            </div>
        </div>
    </div>



    <!-- Modal Crear -->
    <div class="modal fade" id="Crear" tabindex="-1" aria-labelledby="CrearLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content ">
                {{-- <div class="modal-header"> --}}
                <div class="row">
                    <div class="col-12 pt-3 text-center">
                        {{-- <h4 class="modal-title  text-secondary" id="CrearLabel"></h4> --}}
                        <h3 class="text-center"> <strong style="color: rgba(2, 93, 113, 1);">Agendar cita</strong></h3>
                    </div>
                </div>
                {{-- </div> --}}
                <div class="modal-body ">
                    <form class="d-flex align-content-around justify-content-around " action="" id="formulario-Crear">
                        @csrf
                        <div class="row  p-4 "> 
                            {{-- CLIENTE FORM --}}
                            <div class="col-12  col-md-12 col-lg-6">
                                <div class="row">
                                    <div class="col-6 form-group">
                                        <select name="cliente_id"
                                            class="js-example-basic-single form-control @error('cliente_id') is-invalid @enderror "
                                            style="width: 100%">
                                            <option value="" selected>Cliente</option>
                                            @foreach ($clientes as $value)
                                                @if($value->state != 0)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
    
                                        @error('cliente_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
    
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <input type="date" id="fechaC" class="form-control @error('fecha') is-invalid @enderror"
                                            name="date" readonly>
                                        @error('fecha')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                    <div class="col-12 col-lg-4  form-group">
                                        <input type="time" id="horaC" class="form-control @error('hora') is-invalid @enderror"
                                            name="hourI">
                                        @error('hora')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-lg-4  form-group">
                                        <input type="number" id="tiempo" class="form-control " placeholder="Duración*">
    
                                    </div>
                                    <div class="col-12 col-lg-4 form-group">
                                        <input type="text" id="direc"
                                            class="form-control @error('direccion') is-invalid @enderror" name="direction"
                                            placeholder="Dirección">
                                        @error('direccion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 form-group mb-5">
                                        <textarea name="description" id="descri" class="form-control @error('descripcion') is-invalid @enderror "
                                            placeholder="Descripción"></textarea>
                                        @error('descripcion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
    
                                    </div>
                                    
                                    <div class="col-12 col-lg-6  form-group">
    
                                        <select name="servicio_id" id="servicio"
                                            class=" form-control @error('servicio') is-invalid @enderror"
                                            onchange="precio_total()">
                                            <option value="">Servicios</option>
                                            @foreach ($servicios as $value)
                                                @if($value->state != 0)
                                                    <option precio="{{ $value->price }}" value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
    
                                        @error('servicio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
    
                                    </div>
    
                                    <div class="col-12 col-lg-6  form-group">
    
                                        <input type="text" id="precio"
                                            class="form-control @error('precio') is-invalid @enderror" name="precio" 
                                            placeholder="Precio de Servicio" readonly>
    
                                        @error('precio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
    
                                    </div>
                                    
                                    <div class="col-12 form-group d-flex justify-content-end">
                                        <button type="button" onclick="agregar_Servicio()" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Agregar producto"
                                            class="btn principal-color text-white"><i class="fas fa-plus"></i>
                                            <span> Agregar Servicio</span> </button>
                                    </div>
    
                                </div>
                            </div>
                            {{-- SERVICIO FORM --}}
                            <div class="col-12 col-md-12 col-lg-6">
                                <div class=" row">
                                    <div class="col-12  form-group">
                                        <input type="text" id="preciototal"
                                            class="form-control @error('precio') is-invalid @enderror text-center" name="price"
                                            placeholder="Precio Total" readonly>
    
                                        @error('precio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
    
                                    </div>
                                    
    
                                    <div class="col-12 mt-2 tbl2_scroll table-responsive ">
                                        <table id="TadaBaseCitas w-100" class="table  table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">Servicio</th>
                                                    <th scope="col">Precio</th>
                                                    <th scope="col">Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbalaServicio">
    
                                            </tbody>
                                        </table>
                                    </div>
    
                                </div>
                            </div>
                        </div>
                       
                </div>
                <div class="row py-4 px-3 justify-content-end">
                    <div class="col-6 col-md-4 col-lg-3">
                        {{-- <button type="submit"  class="btn btn-success">crear</button> --}}
                        <button type="button" onclick="CrearCita()" class="btn principal-color text-white w-100"
                            id="btnCrear">Agendar</button>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <a  onclick="limpiar()" class="btn btn-outline-dark btn-block"
                            data-bs-dismiss="modal">Volver
                        </a>
                    </div>



                </div>
                </form>
            </div>

        </div>
    </div>
    </div>

    {{-- MODAL OPCIONES --}}
    <div class="modal" id="Opciones" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Opciones de la cita</h5>

                </div>
                <div class="modal-body" id="op">
                    <button type="button" onclick="limpiar()" class="btn btn-secondary"
                        data-bs-dismiss="modal">salir</button>
                    <a class="btn  btn-warning btn-ms" id="opcionesEditar" href=""><i
                            class="glyphicon glyphicon-edit"></i>Editar</a>
                    <a class="btn  btn-primary btn-ms" id="opcionesDetalle" href=""><i
                            class="glyphicon glyphicon-edit"></i>Detalle</a>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('js-alert')

    <script src="/js/calendar.js "></script>
    <script src="/plugins/fullcalendar-5.10.1/moment/moment.min.js "></script>
    <script src="/plugins/fullcalendar-5.10.1/lib/main.min.js"></script>
    <script src="/plugins/fullcalendar-5.10.1/lib/locales-all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // SERVICIO FORM
        function precio_total() {

            let precio = $("#servicio option:selected").attr("precio");
            console.log(precio);
            $("#precio").val(precio);

        }

        function agregar_Servicio() {

            let servicio = $("#servicio option:selected").text();
            
            let precio = $("#servicio option:selected").attr("precio");
            
            let id = $("#servicio option:selected").val()
           
            if (precio > 0) {
                $('#tbalaServicio').append(`
            <tr id="tr-${id}" >
                <td>
                <input type="hidden" name="servicios_id[]" value="${id}"/>
                ${servicio}</td>
                <td>${precio}</td>
                <td class="text-center">
                    <button  type="button" class="btn btn-danger" onclick="Eliminar(${id},${precio})"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        
        `);

                let precioTotal = $("#preciototal").val() || 0;
                $("#preciototal").val(parseInt(precioTotal) + parseInt(precio));
            } else {
                
               
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: '!Ocurrio un Error¡',
                    text: 'Por favor seleccione un producto o coloque una cantidad mayor a 0 ',
                    showConfirmButton: false,
                    timer: 2500
                })
            

            }
        }

        function Eliminar($id, $precio) {
            console.log($id);
            $("#tr-" + $id).remove();
            let precioTotal = $("#preciototal").val() || 0;
            $("#preciototal").val(parseInt(precioTotal) - parseInt($precio));
        }
        // PRODUCTO FORM
        function precio_totalp() {

            let precioP = $("#producto option:selected").attr("preciop");
            // console.log(precioP);
            $("#precioP").val(precioP);

        }

        function reordenar() {}

        function EliminarP($idP, $precioP) {
            $("#trp-" + $idP).remove();

            let precioTotalP = $("#preciototalP").val() || 0;
            $("#preciototalP").val(parseInt(precioTotalP) - $precioP);
            $("#Cantidad").val(1);
        }
        // ALERT CREAT CITA
        $('#formulario-Crear').submit(function(e) {

            e.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: '¿Estas seguro?',
                text: "La cita se Agregara",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, seguro',
                cancelButtonText: 'No, cancele',
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        'La cita se ha Agregado',
                        'Ya puede ver la en la tabla citas',
                        'success'
                    )
                    this.submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'La cita no fue Agregada',
                        'Revice que decea cambiar o regrese a la tabla citas',
                        'error'
                    )
                }
            })

        });
    </script>
@endsection
