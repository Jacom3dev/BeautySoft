@extends('layouts.app')
@section('title')
    Crear Producto
@endsection

@section('content')
<div id="Crear" class="container" >
    <div class="row">
        <div class="col">
            <div class="modal-dialog modal-dialog-scrollable" >
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="CrearLabel">Crear Producto</h5>
                </div>
                    <div class="modal-body">
                
                        <form action="{{route('productos.store')}}" method="POST" class="formulario-Crear row g-3" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="col-md-6">
                                
                                    <br>
                                    <input type="text"  placeholder="Nombre*" class="form-control  @error('name') is-invalid @enderror" name="name">
                                    @error('name')
                                    <div class="invalid-feedback">{{$message}}</div>                         
                                    @enderror

                                
                            </div>
                            
                            <div class="col-md-6">
                                
                              <br>
                                <input type="file" placeholder="Imagen"  class="form-control @error('img') is-invalid @enderror" name="img" accept="image/*" value="null" >
                                @error('img')
                                <div class="invalid-feedback">{{$message}}</div>                         
                                @enderror
                            
                            </div>
                            <div class="col-md-6">
                                
                                <br>
                                <input type="number"   placeholder="Cantidad*"class="form-control @error('amount') is-invalid @enderror" name="amount" value="1">
                                @error('amount')
                                <div class="invalid-feedback">El campo debe tener como minimo 1 de cantidad.</div>                         
                                @enderror
                            
                            </div>

                            <div class="col-md-6">
                                
                                <br>
                                <input type="number"  placeholder="Precio*" class="form-control @error('price') is-invalid @enderror" name="price">
                                @error('price')
                                <div class="invalid-feedback">El campo debe tener como minimo 3 digitos.</div>                         
                                @enderror
                            
                            </div>

                            </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn principal-color text-white float-right " data-bs-toggle="tooltip" data-bs-placement="left" title="Crear">Crear</button>
                            <a class="btn btn-outline-dark" href="/productos"  data-bs-toggle="tooltip" data-bs-placement="left" title="Retroceder" ><i class="glyphicon glyphicon-edit"></i>Cancelar</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection
@section('js-alert')
<script>

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
        text: "El producto se Agregara",
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
                title: 'El producto se creara',
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