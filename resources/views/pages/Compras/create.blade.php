@extends('layouts.app')

@section('title', 'Crear Compras')

 @section('content')
<div class="row justify-content-center">
    <div class="col">
        <div class="card  shadow-lg border-0 rounded-lg mt-3 booking">
            <div class="col-12 py-3">
                <ul class="nav nav-pills d-flex justify-content-around">
                    <li class="nav-item">
                        <a class=" btn btn-outline-dark active" aria-current="page" data-toggle="tab" href="#Exis">Generar compra de
                                productos existentes</a>
                    </li>
                    <li class="nav-item">
                        <a class=" btn btn-outline-dark" href="#New" data-toggle="tab">Generar compra de
                            productos nuevos</a>
                    </li>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form class="d-flex align-content-around justify-content-center " action="{{ Route('compras.store') }}" method="POST" id="formulario-Crear">
                    @csrf

                    <div class="row justify-content-around">
                        {{-- Proveedor form --}}
                        <div class="col-12 text-dark form-group mb-4">
                            <div class=" row">
                                <div class="col-6  ">
                                    <select class="form-control" name="id_supplier" id="id_supplier" required="required" required>
                                            <option value="">Proveedor</option>
                                            @foreach ($proveedor as $Key => $provider)
                                                <option value="{{ $provider->NIT }}">{{ $provider->supplier }}</option>
                                            @endforeach
                                            </option>
                                        </select>
                                </div>

                                <div class="col-6">
                                    <input name="price_total" type="text" class="form-control " id="total" placeholder="Precio" readonly>
                                </div>
                            </div>
                        </div>

                        {{-- productos FORM --}}
                        <div class="col-6 text-dark form-group">
                            <div class="tab-content">
                                <div class="chart tab-pane active" id="Exis" style="position: relative;">
                                    <div class="row g-3">
                                        <div class="col-12 form-group mt-3">
                                            <select class="form-control" name="productos" id="productos" onchange="Agg_Attr()">
                                                    <option value="">Producto</option>
                                                    @foreach ($productos as $Key => $product)
                                                        <option price="{{ $product->price_buys }}" amount="{{ $product->amount }}"
                                                            value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                        </div>

                                        <div class="col-6 form-group">
                                            <input name="amount" type="number" class="form-control " id="amount" placeholder="Cantidad">
                                        </div>

                                        <div class="col-6 form-group">
                                            <input name="price" type="text" class="form-control" id="price" placeholder="Precio*">
                                        </div>

                                        <div class="col-12 d-flex justify-content-end ">
                                            
                                            <button class="btn principal-color text-white" onclick="Agg()" type="button">
                                                        <i class="fas fa-plus"></i>
                                                        <span> Agregar Producto</span>
                                                    </button>
                                        </div>
                                    </div>
                                </div>

                                {{--Nuevo producto--}}
                                <div class="chart tab-pane" id="New" style="position: relative;">
                                    <div class="row g-3">
                                        <div class="col-12 form-group mt-3">
                                            <input type="text" placeholder="Nombre*" class="form-control  @error('name') is-invalid @enderror" name="name" id="nombre"> @error('name')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="col-6 form-group">
                                            <input type="number" placeholder="Cantidad*" class="form-control @error('amount') is-invalid @enderror" name="amount" value="amount" id="cantidad"> @error('amount')
                                            <div class="invalid-feedback">El campo debe tener como minimo 1 de cantidad.</div>
                                            @enderror
                                        </div>



                                        <div class="col-6 form-group">
                                            <input type="number" placeholder="Precio" class="form-control @error('price') is-invalid @enderror" name="price" id="precio"> @error('price')
                                            <div class="invalid-feedback">El campo debe tener como minimo 3 digitos.</div>
                                            @enderror
                                        </div>

                                        <div class="col-12 d-flex justify-content-end ">
                                            <button class="btn principal-color text-white" onclick="AgNuevoP()" type="button">
                                                        <i class="fas fa-plus"></i>
                                                        <span> Agregar Producto</span>
                                                    </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="col-6 ">
                            <div class="row">
                                <div class="col tbl_scroll tabla-responsive">
                                    <table class="table  table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Precio total</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tblProductos">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="row justify-content-end pb-3">
                <div class="col-6 col-lg-2">
                    <button type="submit" class="btn btn-block principal-color text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Registrar Compra">
                            Crear
                        </button>
                </div>
                <div class="col-3 col-lg-1">
                    <a href="{{ route('compras.index') }}" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Regresar">Volver</a>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>


@endsection
@section('JS')
<script>
    function Agg_Attr() {
        let price = $("#productos option:selected").attr("price");
        $("#price").val(price);
    }
    let p = 0;
    //NUEVOS PRODUCTOS 
    function AgNuevoP() {
       
        p++;
        let idp = p;
        
        
        let name = $("#nombre").val();
        let amount = $("#cantidad").val();
        let price = $("#precio").val();


        $("#tblProductos").append(`
                                            <tr id="tr-0${idp}">
                                                    <input type="hidden" name="idPN[]" value="${idp}" />
                                                    <input type="hidden" name="amountsPN[]" value="${amount}"/>
                                                    <input type="hidden" name="pricesPN[]" value="${price}" />
                                                    <input type="hidden" name="namePN[]" value="${name}" />
                                                <td>
                                                  ${name}
                                                </td>

                                                <td> 
                                                    ${amount}
                                                </td>
                                                <td >
                                                    ${price}
                                                </td>
                                                

                                                <td>
                                                    ${parseInt(price) * parseInt(amount) }
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="DeleteNP(${idp},${parseInt(price) * parseInt(amount)})"><i class="fas fa-trash-alt"></i></button>
                                                
                                                </td>
                                            </tr>  
                                        `);



        let price_t = $("#total").val() || 0;
        $("#total").val(parseInt(price_t) + parseInt(price) * parseInt(amount));
        
    }

    //PRODUCTOS YA EXISTENTES
    function Agg() {



        let id = $("#productos option:selected").val();
        let name = $("#productos option:selected").text();
        // let name = $("#name").val();
        let amount = $("#amount").val();
        let price = $("#price").val();

        if (id >= 0) {

            let validate = validar_producto();
            console.log(validate);

            if (!validate) {
                $("#tblProductos").append(`
                                    <tr id="tr-${id}">
                                    
                                            <input type="hidden" name="ids[]" value="${id}" class="id" />
                                            
                                            <input type="hidden" name="amounts[]" value="${amount}"class ="amount"/>
                                            <input type="hidden" name="prices[]" value="${price}" /> 
                                        <td>
                                        ${name}
                                        </td>

                                        <td class="cantidad_p">
                                            ${amount}
                                        </td>
                                        <td >
                                            ${price}
                                        </td>
                                        

                                        <td class="sub_p">
                                            ${parseInt(price) * parseInt(amount) }
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="Delete(${id})"><i class="fas fa-trash-alt"></i></button>
                                        
                                        </td>
                                    </tr> 
                                `);



                let total = $("#total").val() || 0;
                $("#total").val(parseInt(total) + parseInt(price) * parseInt(amount));

            }



        }

    }

    function validar_producto() {
        let validation = false;



        if ($("table tbody#tblProductos tr").length > 0) {
            $("table tbody#tblProductos tr").each(function() {

                if ($(this).find("input.id").val() == $("#productos option:selected").val()) {
                    validation = true;

                    $(this)
                        .find("input.amount")
                        .val(
                            parseInt(
                                $(this).find("input.amount").val()
                            ) + parseInt($("#amount").val())
                        );

                    let subtotal = parseInt(
                        $("#amount").val() *
                        parseInt($("#price").val())
                    );
                    let precio_total = $("#total").val() || 0;

                    $("#total").val(
                        parseInt(precio_total) + parseInt(subtotal)
                    );

                    $(this)
                        .find("td.sub_p")
                        .text(
                            parseInt($(this).find("td.sub_p").text()) +
                            parseInt(
                                parseInt($("#amount").val()) *
                                parseInt($("#price").val())
                            )
                        );
                    $(this)
                        .find("td.cantidad_p")
                        .text(
                            parseInt($(this).find("td.cantidad_p").text()) +
                            parseInt($("#amount").val())
                        );


                }
            });
        }

        return validation;
    }
    function DeleteNP(idp,price) {

        
        let fila = $("#tr-0" +idp);

        let subtotal = price;


        fila.remove();
        let precioT = $("#total").val() || 0;

        $("#total").val(parseInt(precioT) - parseInt(subtotal));


    }
    function Delete(id) {
       
        let fila = $("#tr-" + id);
        let subtotal = parseInt(fila.find("td.sub_p").text());
        fila.remove();
        let precioT = $("#total").val() || 0;

        $("#total").val(parseInt(precioT) - parseInt(subtotal));
        


    }
</script>
@endsection


