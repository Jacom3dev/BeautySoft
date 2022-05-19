<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use App\Models\Productos;
use App\Models\DetalleCompra;
use App\Models\Compra;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompras;
use App\Http\Requests\StoreProductos;

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
    public function store(request $request)
    {
        $input = $request->all();
        
        
       try { 
            
        DB::beginTransaction();
       

                if (count($input) == 10) {
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
                            "price"=>$input["prices"][$key],
                            "amount" => $input["amounts"][$key] 
                        ]);
    
                        $producto = Productos::find($value);
                        $producto->update(["amount"=> $producto->amount +  $input["amounts"][$key]
                    ]);
                }
                    
                }elseif (count($input)==11) {
                   
                    $compra = Compra::create([
                        "id_supplier" => $input["id_supplier"],
                        "user_id"=>  auth()->user()->id, 
                        "price" => $input["price_total"], 
                        "state" => 1
                    ]); 
                    foreach ($input["idPN"] as $key => $value) {
                  
                        $productos = productos::create([
                            "name"=>$input["namePN"][$key],
                            "img"=>null,
                            "amount"=>$input["amountsPN"][$key],
                            "price"=>$input["pricesPN"][$key],
                            "state"=>1, 
                        ]);
                        
                        DetalleCompra::create([ 
                            "buys_id" => $compra->id,
                            "product_id" => $productos->id,
                            "price"=>$input["pricesPN"][$key],
                            "amount" => $input["amountsPN"][$key] 
                            
                        ]);
    
                    }
                    
                }
                    
                elseif(count($input)==14) {

                    $compra = Compra::create([
                        "id_supplier" => $input["id_supplier"],
                        "user_id"=>  auth()->user()->id, 
                        "price" => $input["price_total"], 
                        "state" => 1
                    ]); 
                   
                    foreach ($input["idPN"] as $key => $value) {
                        $productos = productos::create([
                            "name"=>$input["namePN"][$key],
                            "img"=>null,
                            "amount"=>$input["amountsPN"][$key],
                            "price"=>$input["pricesPN"][$key],
                            "state"=>1, 
                        ]);
                        
                        $detalle=DetalleCompra::create([ 
                            "buys_id" => $compra->id,
                            "product_id" => $productos->id,
                            "price"=>$input["pricesPN"][$key],
                            "amount" => $input["amountsPN"][$key] 
                          
                            
                        ]);
                                
                    }
                    foreach ($input["ids"] as $key => $value) {
                        $detalle->create([ 
                            "buys_id" => $compra->id,
                            "product_id" => $value,
                            "amount" => $input["amounts"][$key],
                            "price"=>$input["prices"][$key]
                        ]);
                       
                            $producto = Productos::find($value);
                            $producto->update(["amount"=> $producto->amount +  $input["amounts"][$key]
                        ]);
                     }
                }
                    
         
                
           
                DB::commit();
                 alert()->success('Compra','Compra realizada con exito.');

             
              return redirect("compras/");
               
        } catch (\Exception $e) {
        DB::rollBack(); 
            dd($e);
            alert()->error('Compra', 'No se pudo crear la compra');
            return redirect("compras/create");
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
        if ($Compra==null) {
            alert()->error('Compra','Compra no encontrada');
            return redirect("/compra/index");
        }
        $productos = Productos::select("productos.*", "detalle_compra.*")->join("detalle_compra", "productos.id", "=", "detalle_compra.product_id")
        ->join("detalle_compra", "productos.id", "=", "detalle_compra.product_id")
        ->where("detalle_compra.buys_id", $id)
        ->get();
         return view("pages.compras.Detail",compact("Compra","productos"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cambioestado($id,$state)
    {
            $Compra=Compra::find($id);
        if ($Compra==null) {
            
            alert()->error('Compra','Compra no encontrada');
            return redirect("/compra/index");
        }
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
    public function changeState($id,$state)
    {
        
        $Comp = Compra::find($id);
        
            $Comp->update([
                'state' => !$state
            ]);
    

            $products = DetalleCompra::where("buys_id", $id)->get();
            
                foreach ($products as $produc) {
                    $produ = Productos::find($produc->product_id);
                    $produ ->update([
                        "amount" => $produ ->amount - $produc->amount,
                    ]);
                }
           
        alert()->success('Compra','cambio de estado exitoso.');
        return Redirect()->route('compras.index');
    }
}
