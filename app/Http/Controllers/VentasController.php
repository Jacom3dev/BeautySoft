<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreVentas;
use App\Models\Ventas;
use App\Models\Clientes;
use App\Models\Productos;
use App\Models\Servicios;
use App\Models\detalle_productos_servicios;
use App\Models\Detalle_ventas_productos;
use App\Models\Detalle_ventas_servicios;
use DB;
use Illuminate\Support\Carbon;


class VentasController extends Controller
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
    public function index()
    {
        
        $Ventas = Ventas::all();
        
        $productos = Productos::select("productos.*", "detalle_ventas_productos.*")->join("detalle_ventas_productos", "productos.id", "=", "detalle_ventas_productos.product_id")
        ->get();

        $servicios = Servicios::select("servicios.*", "detalle_ventas_servicios.*")->join("detalle_ventas_servicios", "servicios.id", "=", "detalle_ventas_servicios.servis_id")
        ->get();

        $productos_servicio = Servicios::select("servicios.*", "detalle_productos_servicios.*")->join("detalle_productos_servicios", "servicios.id", "=", "detalle_productos_servicios.servis_id")
        ->get();

        return view("pages.ventas.ventas", compact("Ventas", "productos", "servicios", "productos_servicio"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $productos = Productos::where('state',1)->get();
        $clientes = Clientes::where('state',1)->get();
        $servicios = Servicios::where('state',1)->get();
        $productos_servicio = Servicios::all();

        return view("pages.ventas.formVentas", compact('productos', 'clientes', 'servicios', 'productos_servicio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVentas $request)
    {
        //
        
        $input = $request->all();
        // try {
            DB::beginTransaction();
            $venta = Ventas::create([
                'client_id' => $input["cliente"],
                'user_id'=>  auth()->user()->id,
                'price' => $input["precio_total"],
                'state' => 1, 
            ]);
            if (isset($input["producto_id"]) && !isset($input["servicio_id"])) {
                foreach($input["producto_id"] as $key => $value){
                    Detalle_ventas_productos::create([
                        "sale_id" => $venta->id,
                        "product_id" => $value,
                        "amount"=>$input["cantidades"][$key]
                    ]);
    
                    $prod = Productos::find($value);
                    $prod ->update([
                        "amount" => $prod ->amount - $input["cantidades"][$key],
                    ]);
                }
            }elseif (isset($input["servicio_id"]) && !isset($input["producto_id"])) {

                foreach($input['servicio_id'] as $value){
                    Detalle_ventas_servicios::create([
                        "sale_id" =>  $venta->id,
                        "servis_id" => $value,
                    ]);
                    $products = detalle_productos_servicios::where("servis_id", $value)->get();
                    
                    foreach ($products as $produc) {
                        $produ = Productos::find($produc->product_id);
                        $produ ->update([
                            "amount" => $produ ->amount - $produc->amount,
                        ]);
                    }
    
                }
            }else{
                foreach($input["producto_id"] as $key => $value){
                    Detalle_ventas_productos::create([
                        "sale_id" => $venta->id,
                        "product_id" => $value,
                        "amount"=>$input["cantidades"][$key]
                    ]);
    
                    $prod = Productos::find($value);
                    $prod ->update([
                        "amount" => $prod ->amount - $input["cantidades"][$key],
                    ]);
                }
                
                foreach($input['servicio_id'] as $value){
                    Detalle_ventas_servicios::create([
                        "sale_id" =>  $venta->id,
                        "servis_id" => $value,
                    ]);
                    $products = detalle_productos_servicios::where("servis_id", $value)->get();
                    
                    foreach ($products as $produc) {
                        $produ = Productos::find($produc->product_id);
                        $produ ->update([
                            "amount" => $produ ->amount - $produc->amount,
                        ]);
                    }
    
                }
            }
            
            DB::commit();
            alert()->success('Venta','Venta realizada con exito.');
            return redirect()->route('ventas.index');
        // } catch (\Exception $e) {
        //    DB::rollback();
        //    alert()->error('Venta', 'No se pudo crear la venta');
        //    return redirect()->route('ventas.index');

        // }
    }
    public function preciop($id, $cant){
        $precio = 0;
        foreach($id as $key => $value){
            $product = Productos::find($value);
            $precio += ($product->price * $cant[$key]);
        }
        return $precio;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Ventas = Ventas::find($id);
        
        $productos = Productos::select("productos.*", "detalle_ventas_productos.*")->join("detalle_ventas_productos", "productos.id", "=", "detalle_ventas_productos.product_id")
        ->where("detalle_ventas_productos.sale_id", $id)
        ->get();

        $servicios = Servicios::select("servicios.*", "detalle_ventas_servicios.*")->join("detalle_ventas_servicios", "servicios.id", "=", "detalle_ventas_servicios.servis_id")
        ->where("detalle_ventas_servicios.sale_id", $id)
        ->get();

        $productos_servicio = Servicios::select("servicios.*", "detalle_productos_servicios.*")->join("detalle_productos_servicios", "servicios.id", "=", "detalle_productos_servicios.servis_id")
        ->get();

    

        return view("pages.ventas.Detail", compact("Ventas", "productos", "servicios", "productos_servicio"));
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
    public function changeState($id,$state)
    {
        
        $vent = Ventas::find($id);
        
        if ($state == 1) {
            $vent->update([
                'state' => !$state
            ]);
    

            $products = detalle_ventas_productos::where("sale_id", $id)->get();
            
            // if ($products != null) {
                foreach ($products as $produc) {
                    $produ = Productos::find($produc->product_id);
                    $produ ->update([
                        "amount" => $produ ->amount + $produc->amount,
                    ]);
                }
            // }else { 
                $servicios_Venta = detalle_ventas_servicios::where('sale_id', $id)->get();


                foreach ($servicios_Venta as $value) {
                    
                    $products_serv = detalle_productos_servicios::where("servis_id", $value->servis_id)->get();
                    
                        
                    foreach ($products_serv as $produc_s) {
                        $produ = Productos::find($produc_s->product_id);
                        $produ ->update([
                            "amount" => $produ ->amount + $produc_s->amount,
                        ]);
                    }
                }
            // }
           
        }else {




           /*  $vent->update([
                'state' => !$state
            ]);
            $products = detalle_ventas_productos::where("sale_id", $id)->get();
            if ($products != null) {
                foreach ($products as $produc) {
                    $produ = Productos::find($produc->product_id);
                    $produ ->update([
                        "amount" => $produ ->amount - $produc->amount,
                    ]);
                }
            }else { 
                $servicios_Venta = detalle_ventas_servicios::where('sale_id', $id)->get();


                foreach ($servicios_Venta as $value) {
                    
                    $products_serv = detalle_productos_servicios::where("servis_id", $value->servis_id)->get();
                    
                        
                    foreach ($products_serv as $produc_s) {
                        $produ = Productos::find($produc_s->product_id);
                        $produ ->update([
                            "amount" => $produ ->amount - $produc_s->amount,
                        ]);
                    }
                }
            } */
           
        }

           
        return Redirect()->route('ventas.index');
    }
}
