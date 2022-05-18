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
            <h5 class="text-center">Editar Servicio</h5>
            <form action="{{route('servicios.update',$servicios->id)}}" class="formulario-Editar row justify-content-around" method="POST"  >
                    @csrf
                    @method("PUT")
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 form-group">
                                
                                <input type="text"  placeHolder="Nombre*" value="{{$servicios->name}}"class="form-control  @error('name') is-invalid @enderror" name="name">
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>                         
                                    @enderror
                                </div>
                                <div class="col-12 form-group">
                                <input type="number"  placeholder="Precio*" value="{{$prec}}" class="form-control @error('price') is-invalid @enderror" name="price">
                                    @error('price')
                                    <div class="invalid-feedback">{{$message}}</div>                         
                                    @enderror
                                </div>
                                <div class="col-12 form-group">
                                   
                                <textarea name="description" placeholder="descripcion"  id="descri" class="form-control @error('descriptcion') is-invalid @enderror ">{{$servicios->description}}</textarea>
                                @error('descriptcion')
                                <div class="invalid-feedback">{{$message}}</div>                         
                                @enderror
                                </div>
                                
                                </div>
                                <div class="col-md-6 form-group">
                                <input type="text" placeholder="Precio Total*" value="{{$servicios->price}}" id="preciototalP" class="form-control @error('precioP') is-invalid @enderror" name="precioP"
                                            readonly>
                                                
                                            @error('precioP')
                                            <div class="invalid-feedback">{{$message}}</div>                         
                                            @enderror
                                </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8 col-md-6">
                        <div class="form-group">
                            <div class="row g-3">
                                <div class="col-12 form-group">
                                <select name="producto_id"  id="producto" class=" js-example-basic-single form-control @error('producto') is-invalid @enderror" onchange="precio_totalp()">
                                        <option value="0"  disabled selected >Productos </option>
                                    @foreach ($producto as $value)
                                    
                                        @if($value->state != 0)
                                            <option precioP="{{$value->price}}" value="{{ $value->id }}">{{ $value->name }}</option>                        
                                        @endif
                                    @endforeach
                                </select>
                                  
                                @error('producto')
                                <div class="invalid-feedback">{{$message}}</div>                         
                                @enderror
                                </div>
                                <div class="col-12 col-md-6 form-group">
                               
                                <input type="number" placeholder="Cantidad*"  id="Cantidad" class="form-control @error('precioP') is-invalid @enderror" name="Cantidad"
                                value="1" >
                                        
                                    @error('Cantidad')
                                    <div class="invalid-feedback">{{$message}}</div>                         
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 form-group">
                                <input type="text"   placeholder="Precio*" id="precioP" class="form-control @error('precioP') is-invalid @enderror" name="precioP"
                                     readonly>
                                        
                                    @error('precioP')
                                    <div class="invalid-feedback">{{$message}}</div>                         
                                    @enderror
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                <button  type="button" onclick="agregar_Producto()" data-bs-toggle="tooltip" data-bs-placement="left" title="Agregar producto"class="btn principal-color text-white"><i class="fas fa-plus"></i>
                                        
                                        <span> Agregar</span>
                                    </button>
                                </div>
                                <div class="col-12 form-group pt-3">
                                    <table
                                        class="table table-bordered"
                                        cellspacing="0"
                                    >
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Subtotal</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbalaProducto">
                                        @foreach($detalle as $value)
                                                @foreach($producto as $key)
                                                    @if($value->servis_id == $servicios->id)
                                                        @if($value->product_id == $key->id)
                                                            <tr id="trp-{{$value->product_id}}" class="pr">
                                                                <td>
                                                                <input type="hidden" name="productos_id[]" value="{{$value->product_id}}" class="id_producto"/>
                                                                <input type="hidden" name="Cantidad_id[]" value="{{$value->amount}}" class="cantidad_producto"/>
                                                                {{$key->name}}</td>
                                                                <td class="cantidad_p" >{{$value->amount}}</td>
                                                                <td>{{$value->price}}</td>
                                                                <td class="sub_p">{{$value->amount*$key->price}}</td>
                                                                <td><button type="button" class="btn btn-danger float-right " data-bs-toggle="tooltip" data-bs-placement="left" title="Eliminar de lista" onclick="EliminarP({{$key->id}})"><i class="fas fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between" >
                   
                    <div class="col-2">
                        <button type="submit"  class="btn principal-color text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Crear Servicio">Actualizar</button>
                        
                    </div>
                    <div class="col-1">
                    <a href="{{route('servicios.index')}}"  class="btn btn-outline-dark" data-bs-dismiss="modal" data-bs-toggle="tooltip" data-bs-placement="left" title="Retroceder">Salir</a>
                
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>
@endsection
@section('js-alert')
<script>
  //  THE SELECT OF PRODCUT'S  FUNCTIONS
function precio_totalp(){

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
                    
                    $("#preciototalP").val(parseInt(precioT)+(parseInt(Cantidad)*parseInt(precioP)));
                   
                    $("#Cantidad").val("1");
                   
                
            }
        }else{
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
            $("table tbody#tbalaProducto tr").each(function () {
                
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

$('.formulario-Editar').submit(function(e){

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
        text: "El servico se Editara",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, seguro',
        cancelButtonText: 'No, cancele',
        reverseButtons: false
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'El servico se ha Editado',
                showConfirmButton: false,
                timer:2000
            })
            this.submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Revice que desea cambiar e intente de nuevo ',
                showConfirmButton: false,
                timer:2000
            })
        }
    })

});

</script>
    
@endsection