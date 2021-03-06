<?php

namespace App\Http\Controllers;

use App\models\productos;
use App\models\existencias;
use DataTables;
use App\Http\Requests\StoreProductos;
use App\Http\Requests\UpdateProductos;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
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
        $productos = productos::where('amount', '>',0)->get();
        return view("pages.productos.indexProductos", compact("productos"));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.productos.crearProductos ');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductos $request)
    {
        $input=$request->all();
      
      
        try{
        
       
   
            
            if (count($input) != 5) {
                $img = $request->file('img')->store('public/img');
                $url = Storage::url($img);
            }else {
                $url=null;
            }
            
            productos::create([
                "name"=>$input["name"],
                "img"=>$url,
                "amount"=>$input["amount"],
                "price_buys"=>$input["price_buy"],
                "price_sale"=>$input["price_sale"],
                "state"=>1,  
            ]);
           
           

           
            alert()->success('Productos','Producto  creado exitosamente.');
            return redirect()->route('productos.index');
        }catch(\Exception $e){
            
            alert()->error('Productos','Producto no registrado.');
            
            return redirect("productos/create");
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
        $productos=productos::find($id);
        
        if ($productos==null) {
            alert()->error('Productos','Producto no encontrado.');
            return redirect("/productos/index");
        }
        return view("pages.productos.detalleProductos",compact("productos"));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productos=productos::find($id);
        
        if ($productos==null) {
            alert()->error('Productos','Producto no encontrado.');
            return redirect("/productos/index");
        }
        return view("pages.productos.editarProductos",compact("productos"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductos $request, $id)
    {
        $input=$request->all();
        

        
        
            try{
             
                $producto=productos::find($input["id"]);
                if (count($input) == 7){

                    $destroy = str_replace('storage','public',$producto->img);
                    
                    Storage::delete($destroy);
                    $img = $request->file('img')->store('public/img');
                    $url = Storage::url($img);
                }elseif (count($input) == 6) {
                     
                    $url= $producto->img;
                    
                }
               
                if ($producto==null) {
                    alert()->error('Productos','El producto no existe.');
                    return redirect("productos/create");
                }
                
                
                
                $producto->update([
                    "name"=>$input["name"],
                    "img"=>$url,
                    "price_buy"=>$input["price_buy"],
                    "price_sale"=>$input["price_sale"],
                    
                ]);
                
                alert()->success('Productos','Producto  editado exitosamente.');
                return redirect("/productos");
            }catch(\Exception$e){
                alert()->error('Productos','Producto no  editado. ');
                return redirect("/productos/Edit");
            }   
         
        
    }

    public function destroy($id)
    {
        $producto=productos::find($id);
        $destroy = str_replace('storage','public',$producto->img);
                    
        Storage::delete($destroy);
        $producto->update(["img"=>null]);
        alert()->success('Productos','La imagen se a eliminado exitosamente.');
        return redirect("/productos/".$id."/edit");
    }
    public function changeState($id,$state){
       
        $productos=Productos::find($id);    
        if ($productos==null) {
            alert()->error('Productos','Producto no encontrado.');
            return redirect("/productos/index");
        }
            $productos->update(["state"=>$state]);
            alert()->success('Productos','Cambio de estado con exito.');
            return redirect("/productos");
        
    }
}
