<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use App\Models\Productos;
use App\Models\DetalleCompra;
use App\Models\Compra;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompras;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ComprasController extends Controller
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

    public function index(Request $request)
    {
        $compra = Compra::all();
        
        $proveedores=Proveedor::all();

        $productos = Productos::select("productos.*", "detalle_compra.*")->join("detalle_compra", "productos.id", "=", "detalle_compra.product_id")
        ->get();
         

        return view("pages.compras.index",compact("compra","proveedores", "productos"));
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $productos = Productos::all();
        $proveedor = Proveedor::all();

        return view("pages.compras.create",compact("proveedor","productos"));


        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $input = $request->all();

           try { 

            DB::beginTransaction();

           
           
            // if(count($input)==7){
                $compra = Compra::create([
                    "id_supplier" => $input["id_supplier"],
                    "user_id"=>  auth()->user()->id,
                    "price" => $input["price_total"], 
                    "state" => 1
                ]); 

                foreach ($input["ids"] as $key => $value) {
                    DetalleCompra::create([ 
                        "buys_id" => $compra->id,
                        "product_id" => $value,
                        "amount" => $input["amount"] 
                    ]);

                    $producto = Productos::find($value);
                    $producto->update(["amount"=> $producto->amount +  $input["amounts"][$key]
                ]);
                }
                    DB::commit();
                    alert()->success('Compra','Compra realizada con exito.');

                  return redirect("compras");
                // } else{
                    alert()->error('Compra','debe agregar un producto como minimo.');

                  return redirect("compras/create");
                // }   
            } catch (\Exception $e) {
            DB::rollBack(); 
            alert()->error('Compra', 'No se pudo crear la compra');
           } 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Compra = Compra::find($id);
        $productos = Productos::select("productos.*", "detalle_compra.*")->join("detalle_compra", "productos.id", "=", "detalle_compra.product_id")
        ->get();
         return view("pages.compras.Detail",compact("Compra","productos"));
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
