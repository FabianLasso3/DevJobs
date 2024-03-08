{{-- para comunicar datos del form al componente se usa wire:submit.prevent='funcion' --}}
<form class="md:w-1/2 space-y-5" wire:submit.prevent='crearVacante'> 
    <div>
        {{-- :messages es una propiedad dinamica --}}
        {{-- en livewire en lugar de usar name se usa wire:model de esa forma se comunica con el backedn--}}
        <x-input-label for="titulo" :value="__('Titulo vacante')" />
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" :value="old('titulo')" placeholder="Titulo de la vacante"/>
        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="salario" :value="__('Salario mensual')" />
        <select
                id="salario"
                wire:model="salario"
                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"
            >
                <option>-- Seleciona un salario --</option>
                @foreach ($salarios as $salario)
                <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('salario')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select
                id="categoria"
                wire:model="categoria"
                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"
            >
                <option value="">-- Seleciona una categoria --</option>
                @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')" placeholder="Nombre de la empresa"/>
        <x-input-error :messages="$errors->get('empresa')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="ultimo_dia" :value="__('Ultimo dia para postularse')" />
        <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia" :value="old('ultimo_dia')"/>
        <x-input-error :messages="$errors->get('ultimo_dia')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="descripcion" :value="__('Descripcion')" />
        <textarea wire:model="descripcion" placeholder="Descripcion general del puesto, experiencia" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full h-72">
        </textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
    </div>

    <div>
        {{-- accept="image/*" hace que todo tipo de imagenes se puedan subir  --}}
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input id="imagen" class="block mt-1 w-full" type="file" wire:model="imagen" accept="image/*"/>
        {{-- tener una vista previa de la imagen la preview de la imagen se va almacenar como un arhico temporal--}}
        <div class="my-5 w-100">
            @if($imagen)
                Imagen:
                <img src="{{ $imagen->temporaryUrl() }}" >
            @endif
        </div>
        <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
    </div>

    <x-primary-button class="w-full justify-center">
        Crear vacante
    </x-primary-button>
   
</form>
