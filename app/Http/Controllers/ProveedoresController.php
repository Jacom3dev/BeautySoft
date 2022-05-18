<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProveedores;
use App\Http\Requests\UpdateProveedores;

class ProveedoresController extends Controller
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
        //
         $proveedor = Proveedor::all();
        return view("pages.proveedores.index",compact("proveedor"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("pages.proveedores.create");
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProveedores $request)
    {
        $input =$request->all(); 
        
         try {
            
            $proveedor = Proveedor::create([ 
                "supplier" => $input["supplier"],
                "enterprise" => $input["enterprise"],
                "cell" => $input["cell"],
                "email" => $input["email"],
                "direction" => $input["direction"],
                "state" =>1,

            ]);

            alert()->success('Proveedor','Proveedor registrado exitosamente.');
            return redirect('proveedores/');
        } catch (\Exception $e) { 
            alert()->error('Proveedor', 'No se pudo registrar el proveedor, por favor diligencie los campos correctamente');
            return redirect('proveedores/create');
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
        $proveedor = Proveedor::find($id);
      
         return view("pages.proveedores.Detail",compact("proveedor"));

        // $proveedor = Proveedor::find($NIT);
        // return view('pages.proveedores.detalle',compact("proveedor"));
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
        $proveedor = Proveedor::find($id);
        // dd($proveedor);
        if ($proveedor == null) {
           
           return redirect("proveedores");
        }
        
        return view("pages.proveedores.edit",compact("proveedor"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProveedores $request)
    {
        //
        $proveedor = $request->all();

        try {
            $supplier = Proveedor::find($proveedor["NIT"]);
            if ($supplier == null) {
                return redirect("proveedores");
            }

            $supplier->update([
                "enterprise"=> $proveedor["enterprise"],
                "supplier" => $proveedor["supplier"],
                "cell" => $proveedor["cell"],
                "email" => $proveedor["email"],
                "direction" => $proveedor["direction"],
                "state" => 1
             ]);
             alert()->success('','Proveedor  editado con exito');
             return redirect("proveedores/");
        } catch (\Exception $e) {
            return redirect("proveedores/");
            
        }
    }



    public function changeState($NIT,$state){
        $proveedor = Proveedor::find($NIT);
        $proveedor->update([
            'state' => !$state
        ]);
        alert()->success('Proveedor','Cambio de estado con exito');
        return  Redirect('proveedores/');
    }
}
