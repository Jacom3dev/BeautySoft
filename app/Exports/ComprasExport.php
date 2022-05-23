<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ComprasExport implements FromView,ShouldAutoSize
{
    use Exportable;

    public function __construct($date1,$date2)
    {
        $this->date1 = $date1;
        $this->date2 = $date2;
    }
  
   

    public function view(): View
    {
        $productos = DB::table('compras')
        ->select('compras.id','productos.name')
        ->join('detalle_compra','compras.id','=','detalle_compra.buys_id')
        ->join('productos','detalle_compra.product_id','=','productos.id')
        ->where('compras.state','1')
        ->whereBetween('compras.created_at', [$this->date1, $this->date2])
        ->get();

        $compras = DB::table('compras')
        ->select('compras.id','users.name','proveedores.supplier','compras.price','proveedores.enterprise','proveedores.cell','compras.created_at')
        ->join('users','compras.user_id','=','users.id')
        ->join('proveedores','compras.id_supplier','=','proveedores.NIT')
        ->where('compras.state','1')
        ->whereBetween('compras.created_at', [$this->date1, $this->date2])
        ->get();
        return view('excel.comprasExport', [
            'productos' => $productos,
            'compras' => $compras
        ]);
    }
   
}
