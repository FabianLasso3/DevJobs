<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    // Habilitar subida de imagenes con livewire 
    use WithFileUploads;


    //$rules reglas de validacion toca usar la palabra rules
    protected $rules = [
        //el nombre debe ser igual a como lo tienes en el wire:model
        'titulo' => 'required|string',
        'salario' => 'required',  
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024',
    ];

    //Va a validar el formulario ($rules)
    public function crearVacante(){
        $datos = $this->validate();

        //guardar imagen
        //store lo va almacenar en una ruta
        $imagen = $this->imagen->store('public/vacantes');
        // str_replace('public/vacantes/', '', $imagen)  va a remplacer el 'public/vacantes/' por vacio y va tomar la informacion de $imagen
        // esto para que se almacene solo el nombre de la imagen
        $datos['imagen'] = str_replace('public/vacantes/', '', $imagen);

        //crear vacante 
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $datos['imagen'],
            'user_id' => auth()->user()->id,
        ]);

        //crear mensaje se envia a index.blade.php session()->has('mensaje')
        session()->flash('mensaje', 'La vacante se publico correctamente');

        //redireccionar al usuario
        return redirect()->route('vacantes.index');
    }

    public function render()
    {
        //consultar bd para pasar informacion
        //all para traer todos los registros


        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante', [
            // asi le pasamos esta informacion a la crear-vacante.blade 
           'salarios' => $salarios,
           'categorias' => $categorias 
        ]);
    }
}
