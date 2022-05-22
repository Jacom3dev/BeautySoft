<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Clientes;
use App\Models\Ventas;
use App\Models\Compra;
use App\Models\Cita;
use App\Exports\ComprasExport;


class DashBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth'); 
    }
    public function export(Request $request) 
    {
        $input = $request->all();
       return (new ComprasExport($input['date1'],$input['date2']))->download('compras.xlsx');
       /* $compras = DB::table('compras')
        ->select('compras.id','users.name as userName','proveedores.supplier','productos.name as productName','compras.price as compraPrice','compras.created_at')
        ->join('users','compras.user_id','=','users.id')
        ->join('proveedores','compras.id_supplier','=','proveedores.NIT')
        ->join('detalle_compra','compras.id','=','detalle_compra.buys_id')
        ->join('productos','detalle_compra.product_id','=','productos.id')
        ->where('compras.state','1')
        ->whereBetween('compras.created_at', ['2022-05-18 23:42:43','2022-05-19 23:42:43'])
        ->get();

        dd($compras); */
    }
    
    private function filter($table){
        $Chart = DB::table("$table")->select(DB::raw('COUNT(*) as count'))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        ->pluck('count');

        $Months = DB::table("$table")->select(DB::raw('Month(created_at) as month'))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        ->pluck('month');

        $Data = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($Months as $index => $month) {
            $Data[$month - 1] = $Chart[$index];
        }
        return  $Data;
    }



    public function index()
    {
        $arrayClientes = $this->filter("clientes");
        $arrayVentas = $this->filter("ventas");
        $arrayCitas = $this->filter("citas");

        $clientes = Clientes::all()->count();
        $ventas = Ventas::all()->count();
        $compras = Compra::all()->count();
        $citas = Cita::all()->count();
        return view('pages.dashboard.dashboard',compact('clientes','ventas','compras','citas','arrayClientes','arrayVentas','arrayCitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
