<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditarVacante extends Component
{
    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    //La imagen es opcional si la cambia o no por eso creamos el atributo imagen_nueva
    public $imagen;
    public $imagen_nueva;

    use WithFileUploads;

    protected $rules = [
        //el nombre debe ser igual a como lo tienes en el wire:model
        'titulo' => 'required|string',
        'salario' => 'required',  
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen_nueva' => 'nullable|image|max:1024',
    ];

    //Cuando vayas a usar un hook nombre del hook se usa para mostrar un registro al editar
    //laravel tiene una dependencia llamada carbon para formatear fechas
    public function mount(Vacante $vacante){
        $this->vacante_id = $vacante->id;
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
    }

    public function editarVacante(){
        $datos = $this->validate();

        //Revisar si hay una nueva imagen
        //store almacena la imagen
        if($this->imagen_nueva){
            $imagen = $this->imagen_nueva->store('public/vacantes');
            $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);
        }

        //Encontrar la vacante a editar - livewire usa el campo id por eso el nombre del atributo es vacante_id
        $vacante =Vacante::find($this->vacante_id);
       
        //Asignar los valores
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];
        $vacante->imagen = $datos['imagen'] ?? $vacante->imagen;

        //guardar vacante
        $vacante->save();

        //redireccionar
        session()->flash('mensaje', 'La vacante ha sido actualizada');
        return redirect()->route('vacantes.index');
    }
    public function render()
    {
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.editar-vacante', [
             // asi le pasamos esta informacion a la crear-vacante.blade 
           'salarios' => $salarios,
           'categorias' => $categorias 
        ]);
    }
}
