@extends('layouts.app')

@section('title','Dasboard')

@section('content')
<div class="container">
   <div class="row mt-4">
      <div class="col-lg-3 col-6">
         <div class="small-box bg-danger">
           <div class="inner">
             <h3>{{$clientes}}</h3>
             <p>Clientes</p>
           </div>
           <div class="icon">
             <i class="ion ion-person-stalker"></i>
           </div>
           <a href="{{route('clientes.index')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
         </div>
      </div>
      <div class="col-lg-3 col-6">
         <div class="small-box bg-info">
           <div class="inner">
             <h3>{{$ventas}}</h3>

             <p>Ventas</p>
           </div>
           <div class="icon">
             <i class="ion ion-cash"></i>
           </div>
           <a href="{{route('ventas.index')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
         </div>
      </div>
      <div class="col-lg-3 col-6">
         <div class="small-box bg-secondary">
           <div class="inner">
             <h3>{{$compras}}</h3>

             <p>Compras</p>
           </div>
           <div class="icon">
             <i class="ion ion-bag"></i>
           </div>
           <a href="{{route('compras.index')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
         </div>
      </div>
      <div class="col-lg-3 col-6">
         <div class="small-box bg-warning">
           <div class="inner">
             <h3>{{$citas}}</h3>

             <p>Citas</p>
           </div>
           <div class="icon">
             <i class="ion ion-calendar"></i>
           </div>
           <a href="{{route('agenda.index')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
         </div>
      </div>
   </div>
   <div class="row justify-content-end">
     <div class="col-2">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary btn-block principal-color" data-toggle="modal" data-target="#exampleModal">
        Generar informe
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3> <strong style="color: rgba(2, 93, 113, 1);">Generar Informe.</strong></h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">  
              <div class="row pb-3">
                <div class="col-12">
                    <ul class="nav nav-pills d-flex justify-content-around">
                        <li class="nav-item">
                            <a class=" btn btn-outline-dark active" aria-current="page" data-toggle="tab" href="#Vent">Informe Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-dark" href="#Comp" data-toggle="tab">Informe Compras</a>
                        </li>
                        </li>
                    </ul>
                </div>
              </div>
              <div class="row">
                <div class="col tab-content">
                  <div class="chart tab-pane active" id="Vent" style="position: relative;">
                    <form action="{{route('ventas.export')}}" method="POST" >
                      @csrf
                      <div class="row py-4">
                        <div class="col-6">
                          <input class="form-control" type="datetime-local" placeholder="Fecha Inicio*"  name="date1" required>
                        </div>

                        <div class="col-6">
                          <input class="form-control" type="datetime-local"  placeholder="Fecha Fin*" name="date2" required>
                        </div>
                      </div>
                      <div class="modal-footer">
                            <button type="submit" class="btn principal-color text-white">Generar</button>
                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
                      </div>
                    </form>
                  </div>

                  <div class="chart tab-pane" id="Comp" style="position: relative;"> 
                    <form action="{{route('compras.export')}}" method="POST">
                      @csrf
                      <div class="row py-4">
                        <div class="col-6">
                          <input class="form-control" type="datetime-local" placeholder="Fecha Inicio*" name="date1" required>
                        </div>

                        <div class="col-6">
                          <input class="form-control" type="datetime-local" placeholder="Fecha Fin*" name="date2" required>
                        </div>
                      </div>
                      <div class="modal-footer">
                            <button type="submit" class="btn principal-color text-white">Generar</button>
                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
   </div>
   <div class="row">
      <div class="col-12  my-2">
        <div id="container"></div>
      </div>
   </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
{{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}

<script>


const chart3 = Highcharts.chart('container', {
    title: {
      text: ''
    },
    exporting: {
      buttons: {
        contextButton: null
      }
    },
    xAxis: {
      categories: ['Ene','Feb', 'Mar','Abr','May','Jun','Jul','Agt','Sep','Oct','Nov','Dic'],
    },
    yAxis: {
      title: {
        text: ''
      }
    },
    series:
    [
      
      {
        type: 'column',
        name: 'Compras',
        color: '#6c757d',
        data: <?php echo json_encode($arrayCompras);?>
      } ,
      {
        type: 'column',
        name : 'Ventas',
        color: '#17A2B8',
        data: <?php echo json_encode($arrayVentas);?>
      }
    ],
    legend: {
      layout: 'vertical',
      align: 'left',
      verticalAlign: 'top',
      x: 100,
      y: 0,
      floating: true,
      borderWidth: 1,
      backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
    },
});
</script>


@endsection