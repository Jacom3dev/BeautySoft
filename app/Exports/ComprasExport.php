<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ComprasExport implements FromCollection,ShouldAutoSize,WithStyles,WithHeadings
{
    use Exportable;

    public function __construct($date1,$date2)
    {
        $this->date1 = $date1;
        $this->date2 = $date2;
    }
    public function headings(): array
    {
        return [
            'ID Compra',
            'Usuario',
            'Proveedor',
            'Producto',
            'Precio',
            'fecha'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            "A1"   => ['font' => ['bold' => true]],
            "B1"   => ['font' => ['bold' => true]],
            "C1"   => ['font' => ['bold' => true]],
            "D1"   => ['font' => ['bold' => true]],
            "E1"   => ['font' => ['bold' => true]],
            "F1"   => ['font' => ['bold' => true]],
        ];
    }

    public function collection()
    {
        return DB::table('compras')
        ->select('compras.id','users.name as userName','proveedores.supplier','productos.name as productName','compras.price as compraPrice','compras.created_at')
        ->join('detalle_compra','compras.id','=','detalle_compra.buys_id')
        ->join('productos','detalle_compra.product_id','=','productos.id')
        ->join('users','compras.user_id','=','users.id')
        ->join('proveedores','compras.id_supplier','=','proveedores.NIT')
        ->where('compras.state','1')
        ->whereBetween('compras.created_at', [$this->date1, $this->date2])
        ->get();
    }
   
}
