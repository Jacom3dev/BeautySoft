@extends('layouts.app')
@section('title', 'Crear Compras')
@section('content')
<div class="row justify-content-center">
    <div class="col">
        <div class="card  shadow-lg border-0 rounded-lg mt-3 booking">
            <div class="col-12 py-3">
                <ul class="nav nav-pills d-flex justify-content-around">
                    <li class="nav-item mb-3 mb-md-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Comprar productos existentes">
                        <a class=" btn btn-outline-dark active" aria-current="page" data-toggle="tab" href="#Exis">Generar compra de
                            productos existentes</a>
                    </li>
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="left" title="Comprar productos nuevos">
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
                        <div class="col-12 text-dark form-group mb-0 mb-md-4">
                            <div class=" row">
                                <div class="col-12 col-md-6  form-group ">
                                    <select class="js-example-basic-single form-control w-100" name="id_supplier" id="id_supplier" required="required" required style="width: 100%;">
                                        <option value="">Proveedor</option>

                                        @foreach ($proveedor as $Key => $provider)
                                        @if($provider->state == 1)
                                        <option value="{{ $provider->NIT }}">{{ $provider->supplier }}</option>
                                        @endif
                                        @endforeach


                                        </option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6 form-group">
                                    <input name="price_total" type="text" class="form-control " id="total" placeholder="Precio" required="required" required readonly>
                                </div>
                            </div>
                        </div>

                        {{-- productos FORM --}}
                        <div class="col-12 col-md-6 text-dark form-group">
                            <div class="tab-content">
                                <div class="chart tab-pane active" id="Exis" style="position: relative;">
                                    <div class="row g-3">
                                        <div class="col-12 form-group mt-3">
                                            <select class="js-example-basic-single form-control w-100" name="productos" id="productos" onchange="Agg_Attr()" style="width: 100%;">
                                                <option value="">Producto</option>
                                                @foreach ($productos as $Key => $product)
                                                @if($product->state == 1 )
                                                <option price_buys="{{ $product->price_buys }}" price_sale="{{$product->price_sale}}" amount="{{ $product->amount }}" value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endif

                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12 col-md-6 form-group">
                                            <input name="amount" type="number" class="form-control " id="amount" placeholder="Cantidad">
                                        </div>
                                        <div class="col-12 col-md-6 form-group">
                                            <input type="number" placeholder="Precio venta*" value="{{old('price_sale')}}" class="form-control @error('price_sale') is-invalid @enderror" name="price_sale" id="price_sale">
                                            @error('price_sale')
                                            <div class="invalid-feedback">El campo debe tener como minimo 3 digitos.</div>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 form-group">
                                            <input type="number" placeholder="Precio compra" value="{{old('price_buys')}}" class="form-control @error('price_buys') is-invalid @enderror" name="price_buys" id="price_buys">
                                            @error('price_buys')
                                            <div class="invalid-feedback">El campo debe tener como minimo 3 digitos.</div>
                                            @enderror
                                        </div>

                                        <div class="col-12 d-flex justify-content-end ">

                                            <button class="btn principal-color text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Agregar producto existente a la compra" onclick="Agg()" type="button">
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

                                        <div class="col-12 col-md-6 form-group">
                                            <input type="number" placeholder="Cantidad*" class="form-control @error('amount') is-invalid @enderror" name="amount" value="amount" id="cantidad"> @error('amount')
                                            <div class="invalid-feedback">El campo debe tener como minimo 1 de cantidad.</div>
                                            @enderror
                                        </div>



                                        <div class="col-12 col-md-6 form-group">
                                            <input type="number" placeholder="Precio venta*" value="{{old('price_sale')}}" class="form-control @error('price_sale') is-invalid @enderror" name="price_sale" id="price_saleNew">
                                            @error('price_sale')
                                            <div class="invalid-feedback">El campo debe tener como minimo 3 digitos.</div>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-6 form-group">
                                            <input type="number" placeholder="Precio compra" value="{{old('price_buys')}}" class="form-control @error('price_buys') is-invalid @enderror" name="price_buys" id="price_buysNew">
                                            @error('price_buys')
                                            <div class="invalid-feedback">El campo debe tener como minimo 3 digitos.</div>
                                            @enderror
                                        </div>

                                        <div class="col-12 d-flex justify-content-end ">
                                            <button class="btn principal-color text-white" onclick="AgNuevoP()" data-bs-toggle="tooltip" data-bs-placement="left" title="Agregar producto nuevo a la compra" type="button">
                                                <i class="fas fa-plus"></i>
                                                <span> Agregar Producto</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="col-12 col-md-6 ">
                            <div class="row">
                                <div class="col-12 table-responsive  tbl_scroll">
                                    <table class="table  table-bordered w-100" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Precio Compra</th>
                                                <th scope="col">Subtotal</th>
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

            <div class="row justify-content-end pb-3 mr-3">
                <div class="col-12 col-md-6 col-lg-3">
                    <button type="submit" class="btn btn-block principal-color text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Registrar Compra">
                        Crear
                    </button>
                </div>
                <div class="col-12 col-md-3 col-lg-2">
                    <a href="{{ route('compras.index') }}" class="btn btn-outline-dark btn-block" data-bs-toggle="tooltip" data-bs-placement="left" title="Regresar">Volver</a>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection

@section('JS')
<script>
    let p = 0;

    //NUEVOS PRODUCTOS 

    function validar_Np() {
        let validation = false;
        if ($("table tbody#tblProductos tr").length > 0) {
            $("table tbody#tblProductos tr").each(function() {

                if ($(this).find("input.namePN").val() == $("#productos option:selected").val()) {
                    validation = true;

                    $(this)
                        .find("input.cantidad")
                        .val(
                            parseInt(
                                $(this).find("input.cantidad").val()
                            ) + parseInt($("#cantidad").val())
                        );

                    let subtotal = parseInt(
                        $("#cantidad").val() *
                        parseInt($("#price_saleNew").val())
                    );
                    let precio_total = $("#total").val() || 0;

                    $("#total").val(
                        parseInt(precio_total) + parseInt(subtotal)
                    );

                    $(this)
                        .find("td.subt")
                        .text(
                            parseInt($(this).find("td.subt").text()) +
                            parseInt(
                                parseInt($("#amount").val()) *
                                parseInt($("#price_saleNew").val())
                            )
                        );
                    $(this)
                        .find("td.cantidad_pN")
                        .text(
                            parseInt($(this).find("td.cantidad_pN").text()) +
                            parseInt($("#cantidad").val())
                        );


                }
            });
        }

        return validation;


    }
    // creaate new product
    function AgNuevoP() {
        let name = $("#nombre").val();
        let amount = $("#cantidad").val();
        let price_saleNew = $("#price_saleNew").val();
        let price_buysNew = $("#price_buysNew").val();
        console.log(price_buysNew);
        let total = $("#total");
        let nameProduct = "";
        @foreach($productos as $value)

        nameProduct = "{{$value->name}}";
        if (nameProduct == name) {

            return Swal.fire({
                icon: 'warning',
                title: '¡Lo sentimos!',
                text: `El producto que decea crear ya existe, por favor digite uno nuevo.`,
            });

        } else {

            nameProduct = "";
        }

        @endforeach


        if (price_buysNew != '') {
            if (amount != '') {
                let validation = validar_Np();
                if (!validation) {

                    p++;
                    let idp = p;

                    $("#tblProductos").append(`
                               <tr id="tr-0${idp}">
                                       <input type="hidden" name="idPN[]" value="${idp}" class="id"  id="id"/>
                                       <input type="hidden" name="amountsPN[]" value="${amount}" class="cantidad" id="cantidad"/>
                                       <input type="hidden" name="price_salePN[]" value="${price_saleNew}" />
                                       <input type="hidden" name="price_buysPN[]" value="${price_buysNew}" />
                                       <input type="hidden" name="namePN[]" value="${name}"  class="namePN"/>
                                   <td>
                                   ${name}
                                   </td>
           
                                   <td class="cantidad_pN"> 
                                       ${amount}
                                   </td>
                                   <td> 
                                       ${price_buysNew}
                                   </td>
                                   
                                   <td class="subt">
                                       ${parseInt(price_saleNew) * parseInt(amount) }
                                   </td>
           
                                   <td>
                                       <button type="button" class="btn btn-danger btn-sm" onclick="DeleteNP(${idp},${parseInt(price_buysNew) * parseInt(amount)})" data-bs-toggle="tooltip" data-bs-placement="left" title="Eliminar de la lista"><i class="fas fa-trash-alt"></i></button>
                                   
                                   </td>
                               </tr>                         
                           `);

                    let price_t = $("#total").val() || 0;
                    $("#total").val(parseInt(price_t) + parseInt(price_saleNew) * parseInt(amount));
                } else {
                    console.log();
                }


            } else {
                Swal.fire({
                    icon: 'warning',
                    title: '¡Atención!',
                    text: `Debe agregar almenos un producto a la compra.`,
                });

            }


        } else {
            Swal.fire({
                icon: 'warning',
                title: '¡Atención!',
                text: `Debe agregar el precio del producto a la compra.`,
            });
        }


    }

    //PRODUCTOS YA EXISTENTES
    function Agg_Attr() {
        let price_sale = $("#productos option:selected").attr("price_sale");
        $("#price_sale").val(price_sale);

        let price_buys = $("#productos option:selected").attr("price_buys");
        $("#price_buys").val(price_buys);

    }

    function Agg() {



        let id = $("#productos option:selected").val();
        let name = $("#productos option:selected").text();
        // let name = $("#name").val();
        let amount = $("#amount").val();
        let price_sale = $("#price_sale").val();
        let price_buys = $("#price_buys").val();
        console.log(price_buys);

        if (id > 0) {

            if (amount > 0) {
                let validate = validar_producto();
                console.log(validate);

                if (!validate) {
                    $("#tblProductos").append(`
                                            <tr id="tr-${id}">
                                            
                                                    <input type="hidden" name="ids[]" value="${id}" class="id" />
                                                    
                                                    <input type="hidden" name="amounts[]" value="${amount}"class ="amount"/>
                                                    <input type="hidden" name="prices_sale[]" value="${price_sale}" />
                                                    <input type="hidden" name="prices_buy[]" value="${price_buys}" /> 
                                                <td>
                                                ${name}
                                                </td>

                                                <td class="cantidad_p">
                                                    ${amount}
                                                </td>
                                                
                                                <td>
                                                ${price_buys}
                                                </td>

                                                <td class="sub_p">
                                                    ${parseInt(price_buys) * parseInt(amount) }
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="Delete(${id})"data-bs-toggle="tooltip" data-bs-placement="left" title="Eliminar de la lista"><i class="fas fa-trash-alt"></i></button>
                                                
                                                </td>
                                            </tr> 
                                        `);



                    let total = $("#total").val() || 0;
                    $("#total").val(parseInt(total) + parseInt(price_buys) * parseInt(amount));

                }



            } else {
                Swal.fire({
                    icon: 'warning',
                    title: '¡Atención!',
                    text: `Debe agregar almenos un producto a la compra.`,
                });

            }
        } else {

            Swal.fire({
                icon: 'warning',
                title: '¡Atención!',
                text: ` Registre el producto que decea comprar.`,
            });
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
                        parseInt($("#price_buys").val())
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
                                parseInt($("#price_buys").val())
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

    function DeleteNP(idp, price) {


        let fila = $("#tr-0" + idp);

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