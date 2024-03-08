<div class="p-10">
    <div class="mb-5">
        <h3 class="font-bold text-3xl text-gray-300 my-3">
            {{ $vacante->titulo }}
        </h3>

        <div class="md:grid md:grid-cols-2 p-4 my-10">
            <p class="font-bold text-sm uppercase text-gray-300 my-3">Empresa: <span class="normal-case font-normal">{{ $vacante->empresa }}</span></p>

            <p class="font-bold text-sm uppercase text-gray-300 my-3">Ultimo dia para postularse: <span class="normal-case font-normal">{{ $vacante->ultimo_dia->toFormattedDateString() }}</span></p>
            {{-- se llama al metodo que esta en vacante con la relacion para poder ver los datos que estan relacionados --}}
            <p class="font-bold text-sm uppercase text-gray-300 my-3">Categoria: <span class="normal-case font-normal">{{ $vacante->categoria->categoria}}</span></p>
        
            <p class="font-bold text-sm uppercase text-gray-300 my-3">Salario: <span class="normal-case font-normal">{{ $vacante->salario->salario }}</span></p>

        </div>
    </div>
    {{-- que divida el contenido en 6 colomunas md:grid-cols-6 y md:col-span-1 para decirle que cantidad del columnas toma cada div o cada uno --}}
    {{-- asset apunta a la carpeta public --}}
    <div class="md:grid md:grid-cols-6 gap-6 text-gray-300 my-3">
        <div class="md:col-span-2">
            <img src="{{ asset('storage/vacantes/' . $vacante->imagen) }}" alt="{{ 'Imagen vacante: ' . $vacante->titulo }}" />
        </div>
        <div class="md:col-span-4">
            <h2 class="text-2xl font-bold mb-5">Descripcion de puesto</h2>
            <p>{{ $vacante->descripcion }}</p>
        </div>
    </div>
    @guest    
        <div class="mt-5 border-dashed text-gray-300 p-5 text-center">
            <p>¿Deseas aplicar a una vacante? <a class="font-bold text-indigo-300" href="{{ route('register') }}">Obten una cuenta y aplica a esta y otras vacantes</a></p>
        </div>
    @endguest

    {{-- @can @endcan si el usuario puede o tiene permiso para hacer una accion
    @cannot @endcannot  si el usuario no puede o tiene permiso para hacer una accion --}}

    {{-- create es la funcion desde el polici --}}
    @cannot('create', App\Models\Vacante::class)
        <livewire:postular-vacante :vacante="$vacante">
    @endcannot
</div>
