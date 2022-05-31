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
            title: 'Por favor seleccione una fecha futura o actual para poder generar la cita. ',
            showConfirmButton: true,
          })
        }
         
        
      },
      // --------------------------------
      eventClick: function(info) {
        let id =info.event.id;
        let state = info.event.extendedProps.estado;
        
        
        $("#Opciones").modal("show");
        $("#op").show();
        $("#estado").append(
          `
          <option cita_id="${id}"  value="2">Pendiente</option>
          <option cita_id="${id}"  value="3">En ejecución</option>
          <option cita_id="${id}"  value="1">Cancelado</option>
       `);
        if (state == 2) {
          
          $("#edit").show();
          $("#opcionesEditar").prop('href','/agenda/'+id+'/edit');
          $("#opcionesDetalle").prop('href','/agenda/'+id);
          
          
        }else if(state == 3){
          $("#edit").hide();
          $("#opcionesDetalle").prop('href','/agenda/'+id);
          
        }else if(state == 1){
          $("#edit").hide();
          $("#select").hide();
          $("#cambio-btn").hide();
          $("#opcionesDetalle").prop('href','/agenda/'+id);
        
        }
          
      

      
        
        

      },
      editable:true,
      events:{
          url:" /agenda/listar/lista/agenda" ,
          method: 'GET',

          failure: function() {
            Swal.fire({
              position: 'top',
              icon: 'error',
              title: 'Tenemos un pequeño problema por favor intente ingresar más tarde.',
              showConfirmButton: false,
              timer: 5000
            })
          },

    
       
      },
     
      
     
     
      
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
  
  $("#estado").remove();
  $("#select").show();
  $("#cambio-btn").show();
  $("#edit").hide();
  
}

function CrearCita() {
  
  var form =  new FormData(document.getElementById("formulario-Crear"));
  let fecha = $("#fechaC").val();
  let hora = $("#horaC").val();
  let tiempo = $("#tiempo").val();
  let hora_final = moment( moment(fecha+" "+hora).add(tiempo,'m')).format('HH:mm:ss');

  
   
   
   
  form.append("hourF",hora_final); 
   $.ajax({
    url:"/agenda/",
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
          timer: 3000
        })
        limpiar();
        
      }else{
       
        Swal.fire({
          position: 'top',
          icon: 'error',
          title: 'La cita no se asignó, por favor rectifique los datos.',
          showConfirmButton: false,
          timer: 4000
        })
        limpiar();
        
      }
   })

}
     // --------------------------