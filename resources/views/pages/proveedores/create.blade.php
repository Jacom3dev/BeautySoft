@extends('layouts.app')

@section('title', 'Crear Proveedor')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-7 mt-4 p-2 bg-white rounded">
            <h3 class="text-center"> <strong style="color: rgba(2, 93, 113, 1);">Registrar Proveedor.</strong></h3>
            <form action="{{route('proveedores.store')}}" method="POST"">
                @csrf
                <div class="row px-3 pt-3">
                    <div class="form-group col-md-6">
                        <input  type="text" class="form-control @error('supplier') is-invalid border border-warning  @enderror" id="suplier" placeholder="Nombre*" name="supplier" value="{{isset($proveedores)?$proveedores->name:old('supplier')}}">
                        @error('supplier')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <input name="enterprise" type="text" class="form-control @error('enterprise') is-invalid border border-warning  @enderror" id="enterprise" placeholder="Empresa*" value="{{isset($proveedores)?$proveedores->name:old('enterprise')}}">
                        @error('enterprise')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col">
                        <input name="cell" type="text" class="form-control @error('cell') is-invalid border border-warning  @enderror" id="cell" placeholder="Teléfono Celular" value="{{isset($proveedores)?$proveedores->name:old('cell')}}">
                        @error('cell')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <input name="email" type="email" class="form-control @error('email') is-invalid border border-warning  @enderror" id="email" placeholder="Correo Electrónico" value="{{isset($proveedores)?$proveedores->name:old('email')}}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <input name="direction" type="text" class="form-control round @error('direction') is-invalid border border-warning  @enderror" id="direction" placeholder="Dirección" value ="{{isset($proveedores)?$proveedores->name:old('direction')}}">
                        @error('direction')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                        @enderror
                    </div>
                </div>
                
                <div class="row justify-content-end pb-3">
                    <div class="col-4">
                        <button type="submit" class=" btn principal-color btn-block text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Registrar Proveedor">Registrar</button>
                    </div>
                    <div class="col-2">
                        <div class="col d-flex justify-content-center">
                            <a href="{{route('proveedores.index')}}" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Ir Atrás">Volver</a>
                        </div>
                    </div>
                </div> 
            </form>
        </div>
    </div>
</div>



        
    






@endsection