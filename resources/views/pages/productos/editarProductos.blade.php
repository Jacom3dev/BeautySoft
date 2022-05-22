@extends('layouts.app')
@section('title')
    Editar Producto
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col -10 col-md-8 col-lg-7 mt-4 p-2 px-4 bg-white rounded">
            <h3 class="text-center"> <strong style="color: rgba(2, 93, 113, 1);">Editar producto.</strong></h3>
            <form action="{{route('productos.update',$productos->id)}}" method="POST" class="formulario-Crear" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="row px-4 pt-3 ">
                    <input type="hidden" name="id" value="{{$productos->id}}"/>
                    <div class="col-md-6 form-group">
                        <input type="text"  placeholder="Nombre*"class="form-control  @error('name') is-invalid @enderror" name="name" value="{{$productos->name}}">
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>                         
                        @enderror
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <input type="file"  placeholder="Imagen" value="{{$productos->img}} "class="form-control @error('img') is-invalid @enderror" name="img" accept="image/*"   >
                        @error('img')
                        <div class="invalid-feedback">{{$message}}</div>                         
                        @enderror
                    </div>
    
                    <div class="col-md-6 form-group">
                        <input type="number"  placeholder="Precio*" class="form-control @error('price') is-invalid @enderror" name="price" value="{{$productos->price}}">
                        @error('price')
                        <div class="invalid-feedback">El campo debe tener como minimo 3 digitos.</div>                         
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <form action="{{route('productos.destroy',$productos->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <div class="col-md-6 form-group">
                                <button type="submit" class="btn btn-danger">
                                    eliminar
                                </button>
                            </div>
                        </form>
                    </div>
                   
                </div>
                

                <div class="row px-4 pb-3 justify-content-end">
                    <div class="col-6 col-lg-4">
                        <button type="submit" class="btn btn-block principal-color text-white">
                            Editar
                        </button>
                    </div>
                    <div class="col-3 col-lg-2">
                        <a href="/productos" class="btn btn-outline-dark btn-block">Volver</a>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div> 
@endsection
@section('js-alert')
<script>
// ALERT OF CREATE
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
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'El producto se editara',
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