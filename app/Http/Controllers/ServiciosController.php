<?php

namespace App\Http\Controllers;
use App\models\Productos;
use App\models\Servicios;
use App\models\Cita;
use App\models\detalle_cita_servicios;
use App\models\detalle_productos_servicios;
use App\models\existencias;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreServicios;
use App\Http\Requests\UpdateServicios;
use Illuminate\Http\Request;

class ServiciosController extends Controller
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
        $servicios = Servicios::all();
        return view("pages.servicios.indexServicios",compact("servicios"));
    }

    public function listar(Request $request){
        $servicio = Servicios::all();
        
        return DataTables::of($servicio)
        ->editColumn('estado',function ($servicio){
            return $servicio->estado == 1 ? "Activo":"Desactivo";
        })
        ->addColumn('editar',function ($servicio){
            return '<a class="btn  btn-warning btn-ms" href="/Servicios/Editar/'.$servicio->id.'" ><i class="glyphicon glyphicon-edit"></i> Editar</a>';
        })
        ->addColumn('detalle',function ($servicio){
            return '<a class="btn  btn-success btn-ms" href="/Servicios/Detalle/'.$servicio->id.'" >Detalle</a>';
        })
        ->addColumn('cambiar',function ($servicio){
            if($servicio->estado == 1){
            return '<a class="btn  btn-primary btn-ms" href="/Servicios/CambioEstado/'.$servicio->id.'/0" >Activado</a>';
            }else{
            return '<a class="btn  btn-danger btn-ms" href="/Servicios/CambioEstado/'.$servicio->id.'/1" >Desactivado</a>';
            }
        })
        ->rawColumns(['editar','cambiar','detalle'])
        ->make(true);

    }
    public function create()
    {
        $producto=Productos::all();
        return view('pages.servicios.crearServicios', compact('producto'));
    }

   
    public function store(StoreServicios $request)
    {
        $input=$request->all();
        
       
        try{
            DB::beginTransaction();
            
            
            if (count($input) == 8) {
               
                $producto_id= $input["productos_id"];
                
                $cantidad=$input["Cantidad_id"];
                $precioSe=$this->precio($input["productos_id"],$input["Cantidad_id"],$input["price"]);
                
                $servicio= Servicios::create([
                    "name"=>$input["name"],
                    "description"=>$input["description"],
                    "price"=>$precioSe,
                    "state"=>1,
                ]);
                foreach ($producto_id as $key => $value) {
                
                    $productos=Productos::find($value);
                   
                    
                    if ($productos->amount>=$cantidad[$key]) {
                        $precioP=$productos->price;
                        
                        $detalle=detalle_productos_servicios::create([
                            "servis_id"=>$servicio->id,
                            "product_id"=>$value,
                            "price"=>$precioP,
                            "amount"=>$cantidad[$key],
    
                            
                        ]);
                         
                        
                        // $productos->update(["amount"=>$productos->amount - $cantidad[$key]]);
                
                    }else {
                        DB::rollBack();
                        alert()->error('Servicios','Servicio no  creado');
                        return redirect("/servicios/create/");
                    }
                }
                DB::commit();
                alert()->success('Servicios','Servicio   creado con exito');
                return redirect("/servicios");
            }else {
               

                $servicio= Servicios::create([
                    "name"=>$input["name"],
                    "description"=>$input["description"],
                    "price"=>$input["price"],
                    "state"=>1,
                ]);
                DB::commit();
                alert()->success('Servicios','Servicio   creado con exito');
                return redirect("/servicios");
            }
            
                    
            
        }catch(\Exception $e){
            DB::rollBack();
           
            alert()->error('Servicios','Servicio no  creado');
            return redirect("/servicios/create/");
        }


    }
    public function precio($productos,$cantidad,$precioS){
        
        $precio=0;
        foreach ($productos as $key=> $item) {
            $producto=Productos::find($item);

            $precio += $producto->price*intval($cantidad[$key]);
            
        }
        
        $precio= $precio+$precioS;
        
        return $precio;
    }

    public function show($id)
    {
        $servicios=Servicios::find($id);
        $detalle= detalle_productos_servicios::all() ;
        $producto=productos::all();
        
        if ($servicios==null) {
            session()->flash('errorE','servicio no encontrado');
            return redirect("/Servicios");
        }
        return view("pages.servicios.detalleServicios",compact("servicios","detalle","producto"));
    }

   
    public function edit($id)
    {
        $servicios=servicios::find($id);
        $detalle=detalle_productos_servicios::all(); 
        $producto=productos::all();
        $precio = 0;
        $e=0;
        $prec=$servicios->price;
        
        foreach ($detalle as  $value) {
            foreach ($producto as $key ) {
                if($servicios->id == $value->servis_id){
                    if ($value->product_id == $key->id) {
                        
                        $precio = ($value->amount * $key->price)+$precio;
                        
                       
                        
                    } 
                }
            }
        }
        $prec = $prec-$precio;
        
        if ($servicios==null) {
            alert()->error('servicios','El producto no existe');
            return redirect("/servicios/create");
        }
        return view("pages.servicios.editarServicios",compact("servicios","producto","detalle","precio","prec"));
    }

  
    public function update(UpdateServicios $request, $id)
    {
        $input=$request->all();
            
        $servicios= Servicios::find($id);   
     
        try{
            DB::beginTransaction();
         
            if (count($input) >= 8) {
               
                $producto_id= $input["productos_id"];
                
                $cantidad=$input["Cantidad_id"];
                $precioSe=$this->precio($input["productos_id"],$input["Cantidad_id"],$input["price"]);
                $prec=$this->eliminar($id,$servicios->price);
                // $precioSe = $precioSe-$prec;
                // dd($prec);
                if ($servicios==null) {
                    alert()->error('Servicios','El servicio no existe');
                    return redirect("servicios/create");
                }
              
                $servicios->update([
                    "name"=>$input["name"],
                    "description"=>$input["description"],
                    "price"=>$precioSe,
                ]);
               $pe = [];
               $r=0;
            //    dd($producto_id);
                foreach ($producto_id as $key => $value) {
                
                    $productos=Productos::find($value);
                    $producto =Productos::all();
                    $detalle=detalle_productos_servicios::all();
                    
                    if ($productos->amount>=$cantidad[$key]) {
                        $precioP=$productos->price;
                      
                        
                        $detall=detalle_productos_servicios::create([
                            "servis_id"=>$id,
                            "product_id"=>$value,
                            "price"=>$precioP,
                            "amount"=>$cantidad[$key],
                        ]);
                         
                        
                    
                
                    }else {

                        DB::rollBack();
                        
                        alert()->error('Servicios','Servicio no  creado');
                        return redirect("/servicios/ceate");
                   
                    }
                }

                DB::commit();
                alert()->success('Servicios','Servicio   editado con exito');
                return redirect("/servicios");

            }else {

                
               $prec=$this->eliminar($id,$servicios->price);
                $servicios->update([
                    "name"=>$input["name"],
                    "description"=>$input["description"],
                    "price"=>$prec,
                ]);
                DB::commit();
                alert()->success('Servicios','Servicio   editado con exito');
                return redirect("/servicios");

            }
   
            
        }catch(\Exception $e){
            DB::rollBack();
            dd($e);

            alert()->error('Servicios','Servicio no editado con exito');
            return redirect("/servicios/".$id."/edit");
        }
    }

    public function eliminar($id,$precio){
        
        $pe = [];
        $r=0;
        $pre = $precio;
        $producto =Productos::all();
        $detalle=detalle_productos_servicios::all();
        
        
           
            foreach ($detalle as $key ) {
                foreach ($producto as $e) {
                    if ($id == $key->servis_id) {
                        if ($e->id == $key->product_id) {
                            
                            $pe=[$r => $key->id];
                            $pre = $pre-($key->price*$key->amount);
                            $deta= detalle_productos_servicios::find($pe[$r]);
                            $deta->delete();
                            
                            $r++;
                        }
                    }
        
                } 
            }

            return $pre;


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeState($id,$state){
       
        $servicios=Servicios::find($id); 
        $cita=Cita::all();
        $citaD=detalle_cita_servicios::all(); 
        
        foreach ($cita as $key ) {
            
            foreach ($citaD as  $value) {
                if ($value->servis_id == $servicios->id) {
                    if ($key->state == 0) {
                        $servicios->update(["state"=>$state]);
                        alert()->success('Servicios','Cambio de estado hecho');
                        return redirect("/servicios");
                    }else {
                        alert()->error('Servicios','no se puede cambiar el estado');
                        return redirect("/servicios");
                    }
                }else {
                    
                }
            }
        }
        $servicios->update(["state"=>$state]);
                    alert()->success('Servicios','Cambio de estado hecho');
                    return redirect("/servicios");

    }
}
