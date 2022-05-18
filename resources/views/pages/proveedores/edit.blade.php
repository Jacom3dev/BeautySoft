@extends('layouts.app')

@section('title', 'Editar Proveedor')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 mt-4 p-2 bg-white rounded">
            <h3 class="text-center"> <strong style="color: rgba(2, 93, 113, 1);">Editar Proveedor.</strong></h3>
            <form action="{{route('proveedores.update',$proveedor->NIT)}}" method="POST"">
                @csrf
                @method("PUT")
                <input type="hidden" name="NIT" value="{{$proveedor->NIT}}">
                <div class="row  px-3 pt-3">
                    <div class="form-group col-md-6">
                        <input  type="text" name="supplier" id="supplier" class="form-control @error('supplier') is-invalid border border-warning  @enderror" id="suplier" placeholder="Nombre*"  value="{{isset($proveedor)?$proveedor->supplier:old('supplier')}}">
                        @error('supplier')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <input name="enterprise" type="text" class="form-control @error('enterprise') is-invalid border border-warning  @enderror" id="enterprise" placeholder="Empresa*" value="{{isset($proveedor)?$proveedor->enterprise:old('enterprise')}}">
                        @error('enterprise')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <input name="cell" type="text" class="form-control @error('cell') is-invalid border border-warning  @enderror" id="cell" placeholder="Teléfono Celular" value="{{isset($proveedor)?$proveedor->cell:old('cell')}}">
                        @error('cell')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <input name="email" type="email" class="form-control @error('email') is-invalid border border-warning  @enderror" id="email" placeholder="Correo Electrónico" value="{{isset($proveedor)?$proveedor->email:old('email')}}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <input name="direction" type="text" class="form-control round @error('direction') is-invalid border border-warning  @enderror" id="direction" placeholder="Dirección" value ="{{isset($proveedor)?$proveedor->direction:old('direction')}}">
                        @error('direction')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                        @enderror
                    </div>

                </div>
                
                <div class="row justify-content-end pb-3 pr-3">
                    <div class="col-4">
                        <button type="submit" class=" btn principal-color btn-block text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Editar Proveedor">Editar</button>
                    </div>
                    <div class="col-2">
                        <a href="{{route('proveedores.index')}}" class="btn btn-outline-dark btn-block" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir Atrás">Volver</a>
                    </div>
                </div> 
            </form>
        </div>
    </div>
</div>






@endsection