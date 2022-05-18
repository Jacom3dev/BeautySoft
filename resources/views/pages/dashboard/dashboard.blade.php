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
           <a href="{{route('usuarios.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
           <a href="{{route('ventas.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
           <a href="{{route('compras.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
           <a href="{{route('agenda.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
        /* data: <?php echo json_encode($arrayVentas);?> */
        data: [14,20,7,12,5,10,30,8,9,20,20,12]
      } ,
      {
        type: 'column',
        name : 'Ventas',
        color: '#17A2B8',
        /* data: <?php echo json_encode($arrayVentas);?> */
        data: [10,5,7,12,5,2,7,8,9,10,11,5]
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