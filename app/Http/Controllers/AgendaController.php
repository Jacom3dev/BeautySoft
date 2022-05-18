<?php

namespace App\Http\Controllers;
use App\models\Cita;
use App\models\Servicios;
use App\models\Clientes;
use App\models\detalle_cita_servicios;
use App\models\Productos;
use App\models\Estado_cita;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AgendaController extends Controller
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
        $cita=Cita::all();
        $servicios=Servicios::all(); 
        $clientes=Clientes::all();     
        
        

        return view('pages.agenda.indexAgenda',compact("cita","servicios","clientes"));
        
    }
    public function list(){
        $citas = Cita::all();
        $cliente =Clientes::all();
        
        $citaN = [];
        $color= "";
        foreach ($citas as  $value) {
           foreach ($cliente as $key ) {
            if ($value->client_id == $key->id) {
                
                if($value->state == 2){
                        $color ="#008000"; 
                }elseif ($value->state ==1) {
                        $color ="#FF0000";
                }elseif($value->state == 3){
                        $color = "#FFA600";
                }
                
                $citaN[]=[
                    "id"=>$value->id,
                    "start"=>$value->date." ".$value->hourI,
                    "hora"=>$value->hourI,
                    "end"=>$value->date." ".$value->hourF,
                    "title"=>$key->name,
                    "backgroundColor"=>$color,
                    "textColor"=>"#ffffff",
                    "borderColor"=>$color,
                    "extendedProps"=>[
                        "idC"=>$value->id,
                        "estado"=>$value->state
                    ]
                ];
            } 
           }         
            
        }
    
        if ($citaN == null) {
            return response()->json(null);
        }else{
        return response()->json($citaN);
        }
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validFecha($fecha,$horaI,$horaF){
        $cita= DB::table("citas")
        ->select("*")
        ->whereDate('date', $fecha)
        ->whereBetween('hourI', [$horaI,$horaF])
        ->whereBetween('hourF', [$horaI,$horaF])
        
        ->first();

        if ($cita == null) {
            return true ;
        }else{
            
            if ($cita->estado == 1) {
                return true ;
            }else{
                return false;
            }
            
        }
        
     
    }

    public function store(Request $request)
    {

        $input=$request->all();
        
        
      if ($this->validFecha($input["date"],$input["hourI"],$input["hourF"])) {
        try{
            DB::beginTransaction();
                $precio = $this->precio($input["servicios_id"]);
               
               $cita=Cita::create([
                   "user_id"=>auth()->user()->id,
                   "client_id"=>$input["cliente_id"],
                   "date"=>$input["date"],
                   "hourI"=>$input["hourI"],
                   "hourF"=>$input["hourF"],
                   "direction"=>$input["direction"],
                   "description"=>$input["description"],
                   "price"=>$precio,
                   "state_id"=>2,
                   
               ]);
               
               
               $servicios_id=$input["servicios_id"];
               foreach ($servicios_id as $key => $value) {
                   $servi= Servicios::find($value);
                   $prec=$servi->price;
                
                   $detalle=detalle_cita_servicios::create([
                    "schedule_id"=>$cita->id,
                    "servis_id"=>$value,
                    "price"=>$prec,

                ]);
                
               
               }
               
                DB::commit();
                  
            return response()->json(["ok"=>true]);
           }catch(\Exception $e){
           
               DB::rollBack();
                    dd($e);
               return response()->json(["ok"=>false]);
           }
      }else{
        dd($this->validFecha($input["date"],$input["hourI"],$input["hourF"]));
        return response()->json(["ok"=>false]);
      }
    }
    public function precio($id){
        $precio=0;
        foreach ($id as  $value) {
            $servis=Servicios::find($value);
            $precio += $servis->price;
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
        $citas=Cita::find($id);
        $cita=Cita::all();
        $ids=$id;
        $servicios=Servicios::all();
     
        $detalleS=detalle_cita_servicios::all();
        
        $horaI =null;
        $horaF = null;
        if ($citas==null) {
            
            return redirect("/agenda");
        }
        foreach ($cita as $key => $value) {
            $horaI = \Carbon\Carbon::parse($value->hourI)->format('h:i A');
            $horaF = \Carbon\Carbon::parse($value->hourF)->format('h:i A');
        }
        return view("pages.agenda.detalleAgenda",compact("citas","servicios","detalleS","ids","horaF","horaI"));
       
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
    public function changeState($id,$state){
       

        $cita=Cita::find($id);
        // estados 
        //  1 = cancelado
        //  2 = pendiente
        //  3 = en ejecucion
         
            $cita->update(["state"=>$state]);
            alert()->success('Agenda','Cambio de estado hecho');
            return redirect("/agenda");
        
    }
}
