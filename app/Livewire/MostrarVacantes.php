<?php

namespace App\Livewire;

use App\Models\Vacante;
use Livewire\Component;

class MostrarVacantes extends Component
{
    
    //función que escucha y responde a eventos emitidos desde un componente 
    // protected $listeners = ['prueba'];
    // public function prueba($vacante_id){

    // }
    protected $listeners = ['eliminarVacante'];
    public function eliminarVacante(Vacante $vacante){
        $this->authorize('delete', $vacante);
        $vacante->delete();
    }
    public function render()
    {
        //Aqui se estan filtrando las publiciaciones que se van a mostrar
        $vacantes = Vacante::where('user_id', auth()->user()->id)->paginate(1);
        return view('livewire.mostrar-vacantes', [
            'vacantes' => $vacantes,
        ]);
    }
}
