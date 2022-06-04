@extends('layouts.app')
@section('title')
    Editar Producto
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col -10 col-md-8 col-lg-7 mt-4 p-2 px-4 bg-white rounded" style="position: relative;top:80px;">
            <h3 class="text-center"> <strong style="color: rgba(2, 93, 113, 1);">Editar producto.</strong></h3>
            <form action="{{route('productos.update',$productos->id)}}" method="POST" class="formulario-Crear" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="row px-4 pt-3 ">
                    <input type="hidden" name="id" value="{{$productos->id}}"/>
                    <div class="col-md-12  form-group">
                        <label for="name">Nombre*</label>
                        <input type="text" id="name" placeholder="Nombre*"class="form-control  @error('name') is-invalid @enderror" name="name" value="{{$productos->name}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>                            
                        @enderror
                    </div>
                   
                    <div class="col-md-6 form-group">
                    <label for="price-venta">Precio venta*</label>
                        <input type="number" id="price-venta" placeholder="Precio venta*"   value="{{$productos->price_sale}}" class="form-control @error('price_sale') is-invalid @enderror" name="price_sale">
                        @error('price_sale')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>                           
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                    <label for="price-buy">Precio compra</label>
                        <input type="number" id="price-buy" placeholder="Precio compra"   value="{{$productos->price_buys}}" class="form-control @error('price_buy') is-invalid @enderror" name="price_buy">
                        @error('price_buy')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>                         
                        @enderror
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label for="img" id="label_img"  class="btn principal-color btn-block text-white mt-3"> 
                        @if(!isset($productos->img))
                            <i class="fas fa-image"></i> <t>Seleccionar</t> Imagen<c></c>
                        @else 
                            Imagen: <small>{{$productos->img}}</small>
                        @endif
                        </label>

                        <input type="file"  id="img" placeholder="Imagen" onchange="imagen()" value="{{$productos->img}} "class="form-control @error('img') is-invalid @enderror" name="img" accept="image/*"  
                        style="display: none; width: 100%;" >
                        @error('img')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>                             
                        @enderror
                    </div>
                    
                   
                </div>
                

                <div class="row px-4 pb-3 justify-content-end">
                    <div class="col-12 col-lg-4 pb-lg-0 pb-3">
                        <button type="submit" onclick="crear()" class="btn btn-block principal-color text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Actualizar informacion">
                            Editar
                        </button>
                    </div>
                   
                </form>
                    @if($productos->img != null)
                     <div class="col-12  col-lg-5 pb-lg-0 ">
                        <form action="{{route('productos.destroy',$productos->id)}}" id="eliminar-imagen" method="POST">
                            @csrf
                            @method("DELETE")
                            <div class="col form-group">
                                <button type="submit" onclick="eliminar_imagen()" class="btn btn-danger btn-block" data-bs-toggle="tooltip" data-bs-placement="left" title="Eliminar imagen">
                                    eliminar imagen
                                </button>
                            </div>
                        </form>
                    </div>
                    @endif
                    <div class="col-12 col-lg-2">
                        <a href="/productos" class="btn btn-outline-dark btn-block" data-bs-toggle="tooltip" data-bs-placement="left" title="Regresar">Volver</a>
                    </div>
                
                </div>
            
        </div>
    </div>
</div> 
@endsection
@section('js-alert')
<script>
// ALERT OF CREATE

    function imagen() {
        let imagen1 = $('#img').val();
        console.log(imagen1);
        
        @if(!isset($productos->img))
            if (imagen1 != "") {
                $('#label_img i').removeClass();
                $('#label_img c').text(`: `);
                $('#label_img t').text(``);
                $('#label_img').append( ` <small> ${imagen1}</small>`);
            }
        @else 
            if (imagen1 != "") {
                $('#label_img i').removeClass();
                $('#label_img c').text(`: `);
                $('#label_img t').text(``);
                $('#label_img small').text( ` ${imagen1}`);
            };
        @endif

    }
    function eliminar_imagen() {
        $('#eliminar-imagen').submit(function(e){
        
        e.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn rgba(2, 93, 113, 1)',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        })

        swalWithBootstrapButtons.fire({
            title: '¿Estas seguro?',
            text: "se eliminara la imagen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, seguro',
            cancelButtonText: 'No, cancele',
            confirmButtonColor: 'rgba(2, 93, 113, 1)',
            cancelButtonColor: 'red',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                
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
    }

    function crear() {
        
        $('.formulario-Crear').submit(function(e){
        
        e.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn rgba(2, 93, 113, 1)',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        })

        swalWithBootstrapButtons.fire({
            title: '¿Estas seguro?',
            text: "El producto se Editara",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, seguro',
            cancelButtonText: 'No, cancele',
            confirmButtonColor: 'rgba(2, 93, 113, 1)',
            cancelButtonColor: 'red',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                
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
    }


</script>
    
@endsection