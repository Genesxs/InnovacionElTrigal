<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Ideas;
use App\Models\ideas_user;
use App\Models\ideas_users;
use App\Models\ProcesosImpacto;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class IdeasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $idUsuario = auth()->user()->id;

        $roles = auth()->user()->roles()->get();
        $cRoles = count($roles); //Devuelve cantidad de registros (cuantos roles tiene un usuario)

        if ($cRoles == 1) {
            if ($roles[0]->id == 1) {
                $ideas = Ideas::all();
            } else {

                $ideas = Ideas::join("ideas_user", "ideas_user.ideas_id", '=', "ideas.id")
                    ->join("categorias", "ideas.categoria_id", '=', "categorias.id")
                    ->join("procesos_impactos", "ideas.proceso_impacto_id", '=', 'procesos_impactos.id')
                    ->select("ideas.id", "ideas.nombre", "ideas.descripcion", "ideas.categoria_id", "ideas.proceso_impacto_id", "estado", "observacion", "procesos_impactos.descripcion as dpi", "categorias.descripcion as dc", "ideas.created_at", "ideas.updated_at")
                    ->where("ideas_user.user_id", "=", $idUsuario)
                    ->get();

                $participantes = User::join("ideas_user", "ideas_user.ideas_id", '=', "users.id")
                    ->select("users.documento_identificacion", "users.name", "users.apellidos")
                    ->where("ideas_user.ideas_id", "=", "1")
                    ->get();
            }
        }

        return view('admin.ideas.index', compact('ideas', 'idUsuario', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::pluck('descripcion', 'id');
        $procesosImpacto = ProcesosImpacto::pluck('descripcion', 'id');

        return view('admin.ideas.create')->with(compact('categorias', 'procesosImpacto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $idea = new Ideas();

        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'categoria_id' => 'required',
            'proceso_impacto_id' => 'required'
        ]);

        if (!$request) {
            $message = "Error: La idea no se guardo";
            Log::error($message);
        } else {
            try {
                $idea->nombre = $request->nombre;
                $idea->descripcion = $request->descripcion;
                $idea->categoria_id = $request->categoria_id;
                $idea->proceso_impacto_id = $request->proceso_impacto_id;
                $idea->save();

                $idea->users()->attach(auth()->user()->id);

                $message = "Los datos de la idea se guardaron satisfactoriamente";
                Log::debug($message . print_r($idea, true));
            } catch (\Exception $e) {
                $message = "Error al ingresar los datos de la idea. Intentelo de nuevo. ";
                Log::error($message, $e);
            }

            return redirect()->route('admin.ideas.index', $idea)->with('info', $message);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $idea)
    {
        $id = $request->id;

        $ideas_user = ideas_users::join('ideas', 'ideas.id', '=', 'ideas_user.ideas_id')
            ->join('users', 'users.id', '=', 'ideas_user.user_id')
            ->where('ideas_id', $id)
            ->orderBy('ideas_user.id', 'DESC')
            ->get();

        $nombre_idea = Ideas::where('id', '=', $id)->first();


        return view('admin.ideas.participantes', compact('ideas_user', 'nombre_idea', 'idea'));
    }

    public function showIdea($id)
    {

        $idea = Ideas::find($id);

        if (empty($idea)) {
            Flash::error('La idea no se encuentra');

            return redirect(route('admin.ideas.index'));
        }

        return view('admin.ideas.show')->with('idea', $idea);
    }

    //funcion para consultar e ingresar usuario participante a la idea
    public function createParticipante(Request $request, Ideas $idea)
    {
        $request->validate([
            'documento_identificacion' => 'required',
        ]);

        $participantes = null;

        try {
            $participantes = User::where('documento_identificacion', $request->documento_identificacion)->first();
        } catch (\Throwable $th) {
            //throw $th;
        }



        if ($participantes == null) {
            $message = "Error: El participante no existe";
            Log::error($message);
        } else {
            try {

                $ideaExists = null;

                try {
                    $ideaExists = ideas_users::where('ideas_id', '=', $idea->id)
                    ->where('user_id', '=', $participantes->id)
                    ->get();
                } catch (\Throwable $th) {
                    //throw $th;
                }

                if($ideaExists != null) {
                   if(count($ideaExists)>0){
                     $message = 'El participante ya existe en esta idea';
                     return redirect()->route('admin.ideas.index', $idea)->with('info', $message);
                   } else {
                    $idea->users()->attach($participantes);
                    $message = 'El participante se ha agregado correctamente';
                   }
                } else {
                    $idea->users()->attach($participantes);
                    $message = 'El participante se ha agregado correctamente';
                }

                Log::debug($message . print_r($idea, true));
            } catch (\Exception $e) {
                $message = "Error: El participante no existe";

                // Log::error($message, $e);
            }
        }

        return redirect()->route('admin.ideas.index', $idea)->with('info', $message);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ideas $idea)
    {
        $categorias = Categoria::pluck('descripcion', 'id');
        $procesoImpactos = ProcesosImpacto::pluck('descripcion', 'id');

        return view('admin.ideas.edit', compact('idea', 'categorias', 'procesoImpactos'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ideas $idea)
    {

            try {
                $idea->update($request->all());

                $message = "La idea se actualizó con exito";

                Log::debug($message . print_r($idea, true));
            } catch (\Exception $e) {
                $message = "Error: Al ingresar los datos de la idea. Intentelo de nuevo. ";

                Log::error($message, $e);
            }
        
        return redirect()->route('admin.ideas.index', $idea)->with('info', $message);
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
