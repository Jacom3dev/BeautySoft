@extends('layouts.app')
@section('title')
    Crear Producto
@endsection

@section('content')
<div id="Crear" class="container" >
    <div class="row justify-content-center">
        <div class="col-10 col-md-8 col-lg-7 mt-4 p-2 px-4 bg-white rounded" style="position: relative;top:50px;">    
            <h3 class="text-center"> <strong style="color: rgba(2, 93, 113, 1);">Crear producto.</strong></h3>
            <form action="{{route('productos.store')}}" method="POST" class="formulario-Crear" enctype="multipart/form-data">
                @csrf
                
                <div class="row pt-3 px-3">
                    <div class="col-md-12 form-group">
                            <input type="text"  placeholder="Nombre*"  value="{{old('name')}}" class="form-control  @error('name') is-invalid @enderror" name="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <small>{{ $message }}</small>
                            </span>                              
                            @enderror
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <input type="file" placeholder="Imagen"   value="{{old('img')}}"class="form-control @error('img') is-invalid @enderror" name="img" accept="image/*" value="null" >
                        @error('img')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>                               
                        @enderror
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <input type="number"   placeholder="Cantidad*" class="form-control @error('amount') is-invalid @enderror" name="amount">
                        @error('amount')

                        <span class="invalid-feedback" role="alert">
                            <small>El campo debe tener como minimo 1 de cantidad.</small>
                        </span>                          
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <input type="number"  placeholder="Precio venta*"   value="{{old('price_sale')}}" class="form-control @error('price_sale') is-invalid @enderror" name="price_sale">
                        @error('price_sale')
                        <div class="invalid-feedback">El campo debe tener como minimo 3 digitos.</div>                         
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <input type="number"  placeholder="Precio compra"   value="{{old('price_buy')}}" class="form-control @error('price_buy') is-invalid @enderror" name="price_buy">
                        @error('price_buy')
                        <div class="invalid-feedback">El campo debe tener como minimo 3 digitos.</div>                         
                        @enderror
                    </div>

                </div>

                <div class="row py-4 justify-content-end">
                    <div class="col-6 col-sm-6 col-lg-4">
                        <button type="submit" onclick="crear()" class="btn principal-color btn-block text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Crear">
                            Crear   
                        </button>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-2">
                        <a href="/productos" class="btn btn-outline-dark btn-block" data-bs-toggle="tooltip" data-bs-placement="left" title="Retroceder" >Volver</a>
                    </div>
                </div>
               
            </form>
        </div>
    </div>
</div>
@endsection
@section('js-alert')
<script>
    function crear() {
        
        $('.formulario-Crear').submit(function(e){
        
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
            text: "El producto se Editara",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, seguro',
            cancelButtonText: 'No, cancele',
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