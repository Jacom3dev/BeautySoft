@extends('layouts.app') @section('title',isset($cliente)?'Editar Cliente':'Registrar Cliente') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 col-md-8 col-lg-7 mt-4 p-2 px-4 bg-white rounded">
            <h3 class="text-center"> <strong style="color: rgba(2, 93, 113, 1);">{{isset($cliente)?'Editar Cliente.':'Registrar Cliente.'}}</strong></h3>
            <form method="POST" action="{{isset($cliente)?route('clientes.update',$cliente->id):route('clientes.store')}}" id="form-cliente">
                @csrf @if(isset($cliente)) @method('put') @endif @if (!isset($cliente))
                <input type="hidden" name="state" value="1"> @endif

                <div class="row">
                    <div class="col-12 col-sm-6 mt-2">
                        <input type="text" class="form-control @error('name') is-invalid border border-warning  @enderror" name="name" placeholder="Nombre*" value="{{isset($cliente)?$cliente->name:old('name')}}"> 
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 mt-2">
                        <input type="text" class="form-control @error('email') is-invalid border border-warning  @enderror" name="email" placeholder="Correo" value="{{isset($cliente)?$cliente->email:old('email')}}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-2">
                        <input type="number" class="form-control @error('cell') is-invalid border border-warning  @enderror" name="cell" placeholder="teléfono" value="{{isset($cliente)?$cliente->cell:old('cell')}}">
                        @error('cell')
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 mt-2">
                        <select class="form-control" class="form-control @error('document_id') is-invalid border border-warning  @enderror" name="document_id">
                            <option value="">Tipo de documento</option>
                            @foreach ($documentos as $documento)
                            <option value="{{$documento->id}}">{{$documento->name}}</option>
                            @endforeach
                        </select>
                        @error('document_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 mt-2">
                        <input type="number" class="form-control @error('document') is-invalid border border-warning  @enderror" name="document" placeholder="Documento*" value="{{isset($cliente)?$cliente->document:old('document')}}">
                        @error('document')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-2">
                        <input type="text" class="form-control @error('direction') is-invalid border border-warning  @enderror" name="direction" placeholder="Dirección" value="{{isset($cliente)?$cliente->direction:old('direction')}}">
                        @error('direction')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row py-4 justify-content-end">
                    <div class="col-6 col-sm-6 col-lg-4">
                        <button type="submit" class="btn principal-color btn-block text-white">
                            {{isset($cliente)?'Editar':'Registrar'}}
                        </button>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-2">
                        <a href="{{route('clientes.index')}}" class="btn btn-outline-dark btn-block" " data-bs-toggle="tooltip" data-bs-placement="left" title="Ir atrás">Volver</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="row justify-content-center ">
        <hr>
        <div class="col-12 ">
            <div class="row mt-3 ">
                <div class="col d-flex justify-content-center ">
                    <a href="{{route( 'clientes.index')}} " class="btn btn-outline-dark " " data-bs-toggle="tooltip" data-bs-placement="left" title="Ir atrás">Volver</a>
                    </div>
                </div>
        </div>
    </div> --}}
</div>
@endsection