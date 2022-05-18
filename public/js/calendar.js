var calendar=null;
document.addEventListener('DOMContentLoaded', function() {

    let formulario =document.querySelector("form");

    var calendarEl = document.getElementById('calendar');

     calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale:"es",
      headerToolbar:{
          left:'prev,next today',
          center:'title',
          right:'dayGridMonth,timeGridWeek,listWeek'
      },
      // events:"http://127.0.0.1:8000/Cita/Listar",
      // dateClick:function(info) {
      //     $("#Crear").modal("show");
      // }
    //   CLIENTE FORM CREAT
    // -------------------------------
      navLinks:true,
      selectable:true,
      selectMirror:true,
      select: function (arg) {
        const N = new Date;
        let R = N.toISOString().split('T')[0];
        let f = moment(arg.startStr).format("YYYY-MM-DD");
        if (R <= f) {
         
          let h = moment(arg.startStr).format('HH:mm:ss');

          $("#Crear").modal("show");
          $("#fechaC").val(f);
          $("#horaC").val(h);
          $("#tiempo").val();
          calendar.render();
          console.log(R);
        } else {
          Swal.fire({
            position: 'top',
            icon: 'error',
            title: 'Porfavor seleccione una fecha futura o actual ',
            showConfirmButton: false,
            timer: 1500
          })
        }
         
        
      },
      // --------------------------------
      eventClick: function(info) {
        let id =info.event.extendedProps.idC;
        
        
        $("#Opciones").modal("show");
        $("#opcionesDetalle").prop('href','/agenda/detalle/'+id);
        $("#opcionesEditar").prop('href','http://127.0.0.1:8000/Cita/Editar/'+id);
        
        

      },
      editable:true,
      events:{
          url:" /agenda/listar/lista/agenda" ,
          method: 'GET',

          failure: function() {
            Swal.fire({
              position: 'top',
              icon: 'error',
              title: 'Tenemos un pequeño problema porfavor intente ingresar más tarde.',
              showConfirmButton: false,
              timer: 3500
            })
          },

    
        // any other sources...
      },
      // eventBackgroundColor:'#008000',
     
     
      
    });
    calendar.render();
    
  });

        // CLIENTE CREAT
      // -------------------------
function limpiar() {
  $("#Opciones").modal('hide');
  $("#Crear").modal('hide');
  $(".form-control").val("");
  $("#Cantidad").val(1);
  $(".sr").remove();
  $(".pr").remove();
}

function CrearCita() {
  var form =  new FormData(document.getElementById("formulario-Crear"));
  let nombre = $("#nombre").val();
  let fecha = $("#fechaC").val();
  let hora = $("#horaC").val();
  let direccion = $("#direc").val();
  let descrip = $("#descri").val();
  let servicio = $("#servicio").val();
  let producto = $("#producto").val();

  let tiempo = $("#tiempo").val();
  let hora_final = moment( moment(fecha+" "+hora).add(tiempo,'m')).format('HH:mm:ss');

  
   
   
   
  form.append("hourF",hora_final); 
   $.ajax({
    url:"/agenda/guardar",
    type: 'post',
    data: form,
    processData: false,
    contentType: false,
   }).done(function(respuesta) {

      if (respuesta && respuesta.ok) {
         calendar.refetchEvents();
        Swal.fire({
          position: 'top',
          icon: 'success',
          title: 'La fue cita asignada con exito.',
          showConfirmButton: false,
          timer: 1500
        })
        limpiar();
        
      }else{
       
        Swal.fire({
          position: 'top',
          icon: 'error',
          title: 'La cita no se asignó, porfavor rectifique los datos.',
          showConfirmButton: false,
          timer: 1500
        })
       
        
      }
   })

}
     // --------------------------