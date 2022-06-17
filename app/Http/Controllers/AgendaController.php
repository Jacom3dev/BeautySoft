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
use Illuminate\Support\Carbon;
use App\Http\Requests\StoreAgenda;
use App\Http\Requests\UpdateAgenda;
use DateTime;
use DateTimeZone;


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
    public function index(){

        $cita=Cita::all();
        $servicios=Servicios::all(); 
        $clientes=Clientes::all();    
        $estado = Estado_cita::all(); 
        $fecha = "";
        $horaI = "";
        $horaF = "";
        foreach ($cita as $key => $value) {
            $fecha= $value->date;
            $horaI = \Carbon\Carbon::parse($value->hourI)->format('h:i A');
            $horaF = \Carbon\Carbon::parse($value->hourF)->format('h:i A');
            $fecha = strftime("  %d %b %Y", strtotime( date('Y-m-d') ));
        }

   
        
                
            return view('pages.agenda.indexAgenda',compact("cita","servicios","clientes","estado","horaF","horaI","fecha"));
               
    }
    public function list(){
        $citas = Cita::all();
        $cliente =Clientes::all();
        
        
        $citaN = [];
        
        foreach ($citas as  $value) {
           foreach ($cliente as $key ) {
               
                if ($value->client_id == $key->id) {
                  
                        
                    $citaN[]=[
                            "id"=>$value->id,
                            "start"=>$value->date." ".$value->hourI,
                            "hora"=>$value->hourI,
                            "end"=>$value->date." ".$value->hourF,
                            "title"=>$key->name,
                            "backgroundColor"=>"#01676D",
                            "textColor"=>"#ffffff",
                            "borderColor"=>"#01676D",
                            "extendedProps"=>[
                                "client_id"=>$value->client_id,
                                "estado"=>$value->state_id,
                                "descripcion"=>$value->description,
                                "date"=>$value->date,
                                "hourI"=>$value->hourI, 
                                "hourI"=>$value->hourF
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
            
            if ($cita->state_id == 1) {
                return true ;
            }else{
                return false;
            }
            
        }
     
     
    }

    public function store(StoreAgenda $request){

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
                dd($e);
               DB::rollBack();
               dd($e);
                    
               return response()->json(["ok"=>false]);
           }
      }else{
        dd($input);
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
    
    public function show($id){
        $cita=Cita::find($id);
        $servicios=Servicios::all(); 
        $clientes=Clientes::all();    
        $estados = Estado_cita::all();
        $detalle =detalle_cita_servicios::all();
        $nombre ="";
        $fecha = $cita->date;
        $horaI = $cita->hourI;
        $horaF = $cita->hourF;

        $horaI = \Carbon\Carbon::parse($cita->hourI)->format('h:i A');
        $horaF = \Carbon\Carbon::parse($cita->hourF)->format('h:i A');
        $fecha = strftime("  %d %b %Y", strtotime( date('Y-m-d') ));
        
       
        if ($cita==null) {
            
            alert()->error('Agenda','La cita no se  encontro');
            return  Redirect()->route('agenda.index');
        }
        foreach ($clientes as $value) {
            if ($value->id == $cita->client_id) {
                $nombre = $value->name;

            }

        }
        
        return view("pages.agenda.detalleAgenda",compact("cita","fecha","horaF","horaI","servicios","clientes","nombre","estados"));
       
    }

    public function edit($id){
        $cita=Cita::find($id);
        $servicios=Servicios::all(); 
        $clientes=Clientes::all();    
        $estados = Estado_cita::all();
        $detalle =detalle_cita_servicios::all();
        $nombre ="";
        $fecha = $cita->date;
        $horaI = $cita->hourI;
        $horaF = $cita->hourF;
       
      

        $horaI = \Carbon\Carbon::parse($cita->hourI)->format('h:i A');
        $horaF = \Carbon\Carbon::parse($cita->hourF)->format('h:i A');
        $fecha = strftime("  %d %b %Y", strtotime( date('Y-m-d') ));
        $hoy  =   strftime("%d %b %Y", strtotime(date('Y-m-d')));
       
        
        if ($cita==null) {
            alert()->error('Cita','La cita no existe');
            return redirect("/agenda/");
        }
        foreach ($clientes as $value) {
            if ($value->id == $cita->client_id) {
                $nombre = $value->name;

            }

        }
        
        $inicio = new DateTime($cita->hourI);
        $fin= new DateTime($cita->hourF);
        $minutos=$inicio->diff($fin);
        $i =$minutos->format('%i'); 
        if ($cita==null) {
            alert()->error('Agenda','El producto no existe');
            return redirect("/agenda/create");
        }
        return view("pages.agenda.editarAgenda",compact("cita","i","horaF","horaI","servicios","clientes","detalle","nombre","estados"));
    }



    public function updateAgenda(updateAgenda $request, $id){
       
        $input=$request->all();
        $cita= Cita::find($id);  
      
        
        try{
            DB::beginTransaction();
         
            
               
                $servicios_id = $input["servicios_id"];
                
                
                $precio = $this->precio($servicios_id);
                $prec=$this->eliminar($id,$cita->price);
               
                if ($cita==null) {
                    alert()->error('Agenda','La agenda no existe');
                    return redirect("agenda/create");
                }
              
                $cita->update([
                   "date"=>$input["date"],
                   "hourI"=>$input["hourI"],
                   "hourF"=>$input["hourF"],
                   
                   "description"=>$input["description"],
                   "price"=>$precio
                ]);
              
           
                foreach ($servicios_id as $key => $value) {
                    $servi= Servicios::find($value);
                    $prec=$servi->price;
                
                    $detalle=detalle_cita_servicios::create([
                    "schedule_id"=>$cita->id,
                    "servis_id"=>$value,
                    "price"=>$prec,

                ]);

                DB::commit();
                alert()->success('Agenda','La cita fue editada con exito');
                return redirect("/agenda");
                }
            
   
            
        }catch(\Exception $e){
            DB::rollBack();
            

            alert()->error('Agenda','La cita no se pudo editar');
            return redirect("/Agenda/".$id."/edit");
        }
    }

    public function eliminar($id,$precio){
        
        $pe = [];
        $r=0;
        $pre = $precio;
        $servicios =servicios::all();
        $detalle =detalle_cita_servicios::all();
       
      
        
        
           
            foreach ($detalle as $key ) {
                foreach ($servicios as $e) {
                    if ($id == $key->schedule_id) {
                        if ($e->id == $key->servis_id) {
                            
                            $pe=[$r => $key->id];
                            $pre = $pre-($key->price*$key->amount);
                            $deta= detalle_cita_servicios::find($pe[$r]);
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
       

    
        $citas =Cita::find($id);
        
        if ($citas==null) {
            
            alert()->error('Agenda','Cita no encontrada');
            return redirect("/agenda/index");
        }
        
         
            $citas->update(["state_id"=>$state]);
            alert()->success('Agenda','Cambio de estado hecho');
            return redirect("/agenda");
        
    }
}
