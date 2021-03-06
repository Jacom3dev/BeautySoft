@extends('layouts.app')
@section('title')
     Agenda
@endsection

@section('content')
<style>
div {
  margin-bottom: 10px;
  position: relative;
}

input[type="number"] {
  width: 100px;
}



input + span {
    
  padding-right: 30px;
}


input:invalid+span:after {
  position: absolute;
  content: '✖';
  padding-left: 5px;
}

input:valid+span:after {
  position: absolute;
  content: '✓';
  padding-left: 5px;
}

/* span::after {
  padding-left: 5px;
}

input:invalid + span::after {
  content: "✖";
}

input:valid + span::after {
  content: "✓";
} */
</style>


    <!-- Modal Crear -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-11 mt-3 p-3 bg-white rounded">
                <div class="row">
                    <div class="col-12 pt-3 text-center">
                        <h3> <strong style="color: rgba(2, 93, 113, 1);">Editar Agenda.</strong></h3>
                    </div>
                </div>
                    <form class="formulario-Editar justify-content-around" method="POST" action="{{route('agenda.update',$cita->id)}}" id="formulario-Editar">
                                @csrf
                                @method("PUT")
                                <div class="row"> 
                                    {{-- CLIENTE FORM --}}
                                    <div class="col-12  col-md-12 col-lg-6">
                                        <div class="row p-4 ">
                                            <div class="col-12 col-lg-6 form-group">
                                            
                                            
                                                <label for="cliente">Cliente*</label>
                                                <input type="text" id="cliente"   value="{{$nombre}}" class="form-control @error('cliente_id') is-invalid @enderror"
                                                name="cliente_id" readonly>
                                                    
            
                                                @error('cliente_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
            
                                            </div>
                                            <div class="col-12 col-lg-6 form-group">
                                                <label for="fechaC">Fecha</label>
                                                <input type="date" id="fechaC"   value="{{$cita->date}}" class="form-control @error('fecha') is-invalid @enderror"
                                                    name="date" readonly>
                                                    
                                                @error('date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>                                  
            
                                            <div class="col-12 col-md-6 form-group">
                                                <label for="appt-time">Hora*</label>
                                                <input type="time" style="width: 100%;" id="appt-time" value="{{$cita->hourI}}"min="09:00" max="19:30"  class="form-control @error('hora') is-invalid @enderror"
                                                    name="hourI">                                                
                                                    <span class="validity"></span>
                                            
                                                @error('hourI')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-6 form-group">
                                                <label for="tiempo">Duración</label>
                                                <input type="number" id="tiempo" class="form-control "  value="{{$i}}"placeholder="Duración Min*" style="width: 100%;">
                                                <input type="hidden" name="hourF" id="hora_final">
                                            </div>
                                        
                                            <div class="col-md-12 form-group mb-5">
                                                <label for="descri">Descripción</label>
                                                <textarea name="description" id="descri" class="form-control @error('descripcion') is-invalid @enderror "
                                                    placeholder="Descripción">{{$cita->description}}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
            
                                            </div>
                                            
                                            <div class="col-12 col-sm-6  form-group">
            
                                            <label for="servicio">Servicios</label>
                                                <select name="servicio_id" id="servicio"
                                                    class="js-example-basic-single @error('servicio') is-invalid @enderror"
                                                    onchange="precio_total()" style="width: 100%;">
                                                    <option value="">Sercivios</option>
                                                    @foreach ($servicios as $value)
                                                        @if($value->state != 0)
                                                            <option precio="{{ $value->price }}" value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
            
                                                @error('servicio')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
            
                                            </div>
            
                                            <div class="col-12 col-sm-6  form-group">
                                                <label for="precio">Precio servicio</label>
                                                
                                                <input type="text" id="precio"
                                                    class="form-control @error('precio') is-invalid @enderror" name="precio" 
                                                    placeholder="Precio de Servicio" readonly>
            
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
            
                                            </div>
                                            
                                            <div class="col-12 form-group d-flex justify-content-end">
                                                <button type="button" onclick="agregar_Servicio()" data-bs-toggle="tooltip"
                                                    data-bs-placement="left" title="Agregar producto"
                                                    class="btn principal-color text-white"><i class="fas fa-plus"></i>
                                                    <span> Agregar Servicio</span> </button>
                                            </div>
            
                                        </div>
                                    </div>
                                    {{-- SERVICIO FORM --}}
                                    <div class="col-12 col-md-12 col-lg-6">
                                        <div class=" row p-4">
                                            <div class="col-12  form-group">
                                                <input type="text" id="preciototal"
                                                    class="form-control @error('precio') is-invalid @enderror text-center" value="{{$cita->price}}"name="price"
                                                    placeholder="Precio Total" readonly>
            
                                                    @error('precio')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
            
                                            </div>
                                            
                                            <div class="col-12 text-center">
                                                <h5 class=" text-secondary">Servicios.</h5>
                                            </div>
            
                                            <div class="col-12 mt-2 tbl2_scroll table-responsive ">
                                                <table id="TadaBaseCitas w-100" class="table  table-bordered">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th scope="col">Servicio</th>
                                                            <th scope="col">Precio</th>
                                                            <th scope="col">Accion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbalaServicio">
                                                        @foreach($detalle as $value)
                                                            @foreach($servicios as $key)
                                                                @if($cita->id == $value->schedule_id)
                                                                    @if($key->id == $value->servis_id)
                                                                    <tr id="tr-{{$value->servis_id}}" >
                                                                        <td>
                                                                        <input type="hidden" name="servicios_id[]" value="{{$value->servis_id}}"/>
                                                                        {{$key->name}}</td>
                                                                        <td>{{$value->price}}</td>
                                                                        <td><button type="button" class="btn btn-danger float-right " onclick="Eliminar({{$value->servis_id}},{{$value->price}})">Eliminar</button>
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
                                
                                <div class="row justify-content-end">
                                    <div class="col-6 col-sm-3">
                                        <button type="submit"   onclick="actualizar()"  class="btn principal-color text-white w-100" data-bs-toggle="tooltip" data-bs-placement="left" title="Actualizar" >Actualizar</button> 
                                        
                                    </div>
                                    <div class="col-6 col-sm-2">
                                        <a class="btn btn-outline-dark" style="width: 100%;"  href="{{route('agenda.index') }}" data-bs-toggle="tooltip" data-bs-placement="left" title="Regresar"
                                            data-bs-dismiss="modal">Volver</a>
                                    </div>
                                </div>
                            
                        </div>
                    </form>
        </div>
    </div>
@endsection
@section('js-alert')
<script src="/plugins/fullcalendar-5.10.1/moment/moment.min.js "></script>
    
    <script>
        
        // SERVICIO FORM
        function precio_total() {

            let precio = $("#servicio option:selected").attr("precio");
            console.log(precio);
            $("#precio").val(precio);

        }
        
        // ALERT CREAT CITA
        function actualizar(){
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
                    confirmButtonColor: 'rgba(2, 93, 113, 1)',
                    cancelButtonColor: 'red',
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
                            confirmButtonColor: 'rgba(2, 93, 113, 1)',
                            timer:2000
                        })
                    }
                })

            });
           
            // var fecha = new Date();
            // var min = $("#tiempo").val();
            // var Hora = $("#appt-time").val();

            // let re = fecha.setMinutes(Hora + min);
            // let ret=  Hora + ":" + fecha.getMinutes();
            
            let fecha = $("#fechaC").val();
            let hora = $("#appt-time").val();
            let tiempo = $("#tiempo").val();
            let hora_final = moment( moment(fecha+" "+hora).add(tiempo,'m')).format('HH:mm:ss');
            
            $("#hora_final").val(hora_final);
        }    
        function agregar_Servicio() {

            let servicio = $("#servicio option:selected").text();
            
            let precio = $("#servicio option:selected").attr("precio");
            
            let id = $("#servicio option:selected").val()
           
            if (precio > 0) {
                $('#tbalaServicio').append(`
            <tr id="tr-${id}" >
                <td>
                <input type="hidden" name="servicios_id[]" value="${id}"/>
                ${servicio}</td>
                <td>${precio}</td>
                <td><button type="button" class="btn btn-danger float-right " onclick="Eliminar(${id},${precio})">Eliminar</button>
                </td>
            </tr>
        
        `);

                let precioTotal = $("#preciototal").val() || 0;
                $("#preciototal").val(parseInt(precioTotal) + parseInt(precio));
            } else {
                
               
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: '!Ocurrio un Error¡',
                    text: 'Por favor seleccione un producto o coloque una cantidad mayor a 0 ',
                    showConfirmButton: false,
                    timer: 2500
                })
            

            }
        }

        function Eliminar($id, $precio) {
            console.log($id);
            $("#tr-" + $id).remove();
            let precioTotal = $("#preciototal").val() || 0;
            $("#preciototal").val(parseInt(precioTotal) - parseInt($precio));
        }
        // PRODUCTO FORM
        function precio_totalp() {

            let precioP = $("#producto option:selected").attr("preciop");
            // console.log(precioP);
            $("#precioP").val(precioP);

        }

     

        function EliminarP($idP, $precioP) {
            $("#trp-" + $idP).remove();

            let precioTotalP = $("#preciototalP").val() || 0;
            $("#preciototalP").val(parseInt(precioTotalP) - $precioP);
            $("#Cantidad").val(1);
        }
        
        
    </script>
@endsection