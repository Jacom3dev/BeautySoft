<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class VentasExport implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function __construct($date1,$date2)
    {
        $this->date1 = $date1;
        $this->date2 = $date2;
    }

   public function view(): View
    {
        $productos = DB::table('ventas')
        ->select('ventas.id','productos.name')
        ->join('detalle_ventas_productos','ventas.id','=','detalle_ventas_productos.sale_id')
        ->join('productos','detalle_ventas_productos.product_id','=','productos.id')
        ->where('ventas.state','1')
        ->whereBetween('ventas.created_at', [$this->date1, $this->date2])
        ->get();
        
        $servicios = DB::table('ventas')
        ->select('ventas.id','servicios.name')
        ->join('detalle_ventas_servicios','ventas.id','=','detalle_ventas_servicios.sale_id')
        ->join('servicios','detalle_ventas_servicios.servis_id','=','servicios.id')
        ->where('ventas.state','1')
        ->whereBetween('ventas.created_at', [$this->date1, $this->date2])
        ->get();
        $ventas = DB::table('ventas')
        ->select('ventas.id','users.name','clientes.name as clientName','clientes.cell','clientes.document','ventas.price','ventas.created_at')
        ->join('users','ventas.user_id','=','users.id')
        ->join('clientes','ventas.client_id','=','clientes.id')
        ->where('ventas.state','1')
        ->whereBetween('ventas.created_at', [$this->date1, $this->date2])
        ->get();

        return view('excel.ventasExport', [
            'productos' => $productos,
            'ventas' => $ventas,
            'servicios' => $servicios
        ]);
    }
}
