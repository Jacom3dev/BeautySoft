@extends('layouts.app')

@section('title', 'Compras')

@section('content')
<div class="row justify-content-center">
  <div class="col">
    <div class="card  shadow-lg border-0 rounded-lg mt-5 booking">
      <div class="card-header">Registrar compra</div>
        <div class="card-body">
                <form class="d-flex align-content-around justify-content-center " action="{{Route('compras.store')}}"  method="POST" id="formulario-Crear">
                        @csrf
                        <div class="row justify-content-around">
                            {{-- Proveedor form --}}
                              <div class="col-4 text-dark form-group bg-light mb-3">
                                    <div class=" row">
                                          <div class="col-12  m-2">
                                              <select  class="form-control" name="id_supplier" id="id_supplier"  required="required" required>
                                                <option value="">Proveedor*</option>
                                                    @foreach($proveedor as $Key=> $provider)
                                                    <option value="{{$provider->NIT}}">{{$provider->supplier}}</option>
                                                    @endforeach
                                                </option>
                                              </select> 
                                          </div>
                                
                                          <div class="col-6 m-2">
                                            <input name="price_total" type="text" class="form-control " id="price_total" placeholder="Precio*" readonly>
                                          </div>         
                                    </div>
                              </div>

                              {{-- productos FORM --}}
                              <div class="col-7 text-dark form-group bg-light mb-3" >
                                          <div class="row g-3">
                                                <div class="col-md-6 m-2">        
                                                        <select  class="form-control" name="productos" id="productos"  onchange="Agg_Attr()">
                                                          <option value="">Producto</option>
                                                              @foreach($productos as $Key=> $product)
                                                              <option price="{{$product->price}}" amount="{{$product->amount}}" value="{{$product->id}}">{{$product->name}}</option>
                                                              @endforeach
                                                        </select>
                                                </div>
                                            
                                                <div class="col-md-2 m-2">
                                                  <input name="amount" type="number" class="form-control " id="amount" >
                                                </div>

                                                <div class="col-md-6 m-2">
                                                  <input name="price" type="text" class="form-control" id="price" placeholder="Precio*"  readonly>
                                                </div> 

                                                <div class="col-md-12 my-3">
                                                  <button  type="button" onclick="Agg()" class="btn principal-color text-white btn-block">agregar producto</button> 
                                                </div>
                                                    
                                                <div class="col-12">
                                                      <table id="TadaBaseCitas" class="table  table-bordered">
                                                          <thead>
                                                              <tr>
                                                                  <th scope="col">Producto</th>
                                                                  <th scope="col">Cantidad</th>
                                                                  <th scope="col">Precio</th>
                                                                  <th scope="col">Precio total</th>
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
                               <div class="col-md-12">
                                    <button type="submit" class="btn  btn-block  principal-color text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Registrar Compra">Crear</button>
                               </div>
                         </div>   
                 </form>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@section('JS')
<script>
   function Agg_Attr(){
                let price=$("#productos option:selected").attr("price");
                $("#price").val(price);
            }

  function Agg(){

      let id = $("#productos option:selected").val();
      let name = $("#productos option:selected").text();
      // let name = $("#name").val();
      let amount = $("#amount").val();
      let price = $("#price").val();
    
    if (id >= 0) {

                let validate = validar_producto();
                console.log(validate);

                if(!validate){
                            $("#tblProductos").append(`
                                    <tr id="tr-${id}">
                                    
                                            <input type="hidden" name="ids[]" value="${id}" class="id" />
                                            <input type="hidden" name="amounts[]" value="${amount}"class ="amount"/>
                                            <input type="hidden" name="amounts[]" value="${price}" />
                                            
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
                            
                            
                            
                            let price_t = $("#price_total").val() || 0;
                                $("#price_total").val(parseInt(price_t) + parseInt(price) * parseInt(amount));  
                            
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
                    let precio_total = $("#price_total").val() || 0;

                    $("#price_total").val(
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
function Delete(id){
let fila = $("#tr-" + id);
     let subtotal = parseInt(fila.find("td.sub_p").text());
    fila.remove();
    let precioT = $("#price_total").val() || 0;
        
    $("#price_total").val(parseInt(precioT) - parseInt(subtotal));
  

}
</script>
@endsection