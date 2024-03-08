<?php

namespace App\Livewire;

use App\Models\Vacante;
use Illuminate\Queue\Listener;
use Livewire\Component;

class HomeVacantes extends Component
{
    public $termino;
    public $categoria;
    public $salario;

    // cuando el evento terminoBusqueda suceda manda a llamar a buscar 
    protected $listeners = ['terminosBusqueda' => 'buscar'];
    public function buscar($termino, $categoria, $salario){
        $this->termino = $termino;
        $this->categoria = $categoria;
        $this->salario = $salario;
    }

    public function render()
    {
        // $vacantes = Vacante::all();
        //busquead avanzada where o when cuando hay datos sino no se ejecuta
        //orwhere para que busque por titulo o por emrpresa
        $vacantes = Vacante::when($this->termino, function($query){
            $query->where('titulo', 'like', '%' . $this->termino . '%');
        })->when($this->termino, function($query){
            $query->OrWhere('empresa', 'like', '%' . $this->termino . '%');
        })->when($this->categoria, function($query){
            $query->where('categoria_id', $this->categoria);
        })->when($this->salario, function($query){
            $query->where('salario_id', $this->salario);
        })
        ->paginate(20);


        return view('livewire.home-vacantes', [
            'vacantes' => $vacantes,
        ]);
    }
}
