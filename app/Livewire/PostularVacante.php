<?php

namespace App\Livewire;

use App\Models\Candidato;
use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    //permite la carga de archivos
    use WithFileUploads;
    public $cv;
    public $vacante;
    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante){

        //El candidato se pueda postular una sola ves en una vacante
        $exist = Candidato::where('user_id',auth()->user()->id)
            ->where('vacante_id', $this->vacante->id)->exists();

         //   
        $this->vacante = $vacante;
    }

    public function postularme() {
        $datos = $this->validate();

        //Almacenar cv en el disco duro

        //guardar imagen
        //store lo va almacenar en una ruta
        $cv = $this->cv->store('public/cv');
        // str_replace('public/vacantes/', '', $imagen)  va a remplacer el 'public/vacantes/' por vacio y va tomar la informacion de $imagen
        // esto para que se almacene solo el nombre de la imagen
        $datos['cv'] = str_replace('public/cv/', '', $cv);

        
        //Crear candidato para la vacante
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv'],
        ]);

        //Crear notificacion y enviar email
        //notify metodo que va a notificar al usuario
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id ));


        //Mostrar el usuario un mensaje de oky
        session()->flash('mensaje', 'Se envio correctamente tu informacion, mucha suerte');
        redirect()->back();
    }
    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
