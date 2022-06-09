@extends('layouts.app')
@section('title',isset($rol)?'Editar Rol':'Registrar rol')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 col-md-8 col-lg-6 mt-5 p-2 px-4 bg-white rounded">
            <h3 class="text-center"> <strong style="color: rgba(2, 93, 113, 1);">{{isset($rol)?'Editar Rol':'Registrar Rol'}}</strong></h3>
            <form method="POST" action="{{isset($rol)?route('roles.update',$rol->id):route('roles.store')}}">
                @csrf
                @if(isset($rol))
                 @method('put')
                @endif
                <input type="hidden" name="state" value="{{isset($rol)?$rol->state:'1'}}">
                <div class="row mt-3">
                    <div class="col">
                        <label for="rol">Rol*</label>
                        <input type="text" id="rol" class="form-control @error('name') is-invalid border border-warning  @enderror" name="name" placeholder="Rol*" value="{{isset($rol)?$rol->name:old('name')}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3 justify-content-end py-3 ">
                    <div class="col-4">
                        @if($roles == "registrar")
                        <button type="submit" class="btn principal-color btn-block text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Registrar rol ">
                           Registrar
                        </button>
                        @else
                        <button type="submit" class="btn principal-color btn-block text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Editar rol">
                           Editar
                        </button>
                        @endif
                    </div>
                    
                    <div class="col-2 d-flex justify-content-center">
                        <a href="{{route('roles.index')}}" class="btn btn-outline-dark btn-block"  data-bs-toggle="tooltip" data-bs-placement="left" title="Ir atrás">Volver</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="row justify-content-center">
        <hr>
        <div class="col-12">
            <div class="row mt-3">
                <div class="col d-flex justify-content-center">
                    <a href="{{route('roles.index')}}" class="btn btn-outline-dark" >Volver</a>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
