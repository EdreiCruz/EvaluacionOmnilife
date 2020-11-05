<?php

namespace App\Http\Controllers;

use App\Http\Requests\empleadosValidation;
use Illuminate\Http\Request;
use App\empleados;

class empleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = empleados::orderBy('id','DESC')->paginate(3);
        return view('index',compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(empleadosValidation $request)
    {
        //$this->validate($request,['codigo'=>'required|unique:empleados','nombre'=>'required','salarioPesos'=>'required','direccion'=>'required','estado'=>'required','ciudad'=>'required','telefono'=>'required','correo'=>'required']);
        empleados::create($request->all());
        return redirect()->route('home')->with('success','Registro creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleados=empleados::find($id);
        return view('show',compact('empleados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleados=empleados::find($id);
        return view('edit',compact('empleados'));
    }


    public function update(empleadosValidation $request, $id)
    {
        //$this->validate($request,['codigo'=>'required','nombre'=>'required','salarioDolares'=>'required','salarioPesos'=>'required','direccion'=>'required','estado'=>'required','ciudad'=>'required','telefono'=>'required','correo'=>'required','active'=>'required']);

        empleados::find($id)->update($request->all());
        return redirect()->route('home')->with('success','Registro actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        empleados::find($id)->delete();
        return redirect()->route('home')->with('success','Registro eliminado satisfactoriamente');
    }

    public function status($id)
    {
        $empleados=empleados::find($id);
        return view('masinfo',compact('empleados'));
    }

    public function cambiostat(Request $request , $id) {
        $data = empleados::find($id);
        if ($data->active == 0){
            $data->active = $request->active;
            $data->save();
        }else{
            $data->active = '0';
            $data->save();
        }
        return redirect()->route('home')->with('success','Registro eliminado satisfactoriamente');
    }

}
