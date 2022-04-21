<?php

namespace App\Http\Livewire;

use App\Models\Ideas;
use App\Models\ideas_users;
use App\Models\User;
use Livewire\Component;

class CrearParticipante extends Component
{
    public $user_id,$documento_identificacion, $consulta, $mensaje="", $idea , $usuario, $idU;

    public function mount(){
       $this->consulta = 0;
    }

    public function render()
    {

        $ideas_user = ideas_users::join('ideas', 'ideas.id', '=', 'ideas_user.ideas_id')
            ->join('users', 'users.id', '=', 'ideas_user.user_id')
            ->where('ideas_id', $this->idea)
            ->orderBy('ideas_user.id', 'DESC')
            ->get();

        $nombre_idea = Ideas::where('id', '=',  $this->idea)->first();

        return view('livewire.crear-participante',  compact('ideas_user', 'nombre_idea'));
    }

    public function buscar() {


        $usuario = User::where('documento_identificacion',$this->user_id)->get();


        if (!empty($usuario)) {
            foreach ($usuario as $key => $value) {
                $this->idU=$value->id;
            }
            
                $participante = ideas_users::where('user_id', $this->idU)
                ->where('ideas_id', $this->idea)
                ->get();

                $nombre = User::select('name', 'apellidos')
                 ->where('documento_identificacion', $this->user_id)
                 ->first();
        
                
                if(!empty($participante && empty($nombre))){
                    session()->flash('message', 'Ya existe este participante');
                } else {
                    $this->consulta = 1;
                    session()->flash('message', "Participante: ". $nombre->name . " " . $nombre->apellidos);
                }
        }else {
            session()->flash('message', 'No existe este participante');
            // $this->mensaje = "no existe este participante";
        }
       
    }

    public function crear(){

        ideas_users::create([
           
           'ideas_id' => $this->idea,
           'user_id' => $this->idU
        ]);

        $nombre = User::select('name', 'apellidos')
        ->where('documento_identificacion', $this->user_id)
        ->first();

        session()->flash('message', 'Se agrego a '. $nombre->name . " " . $nombre->apellidos . " con exito");        
        $this->reset('user_id');
        $this->consulta = 0;
    }

}
