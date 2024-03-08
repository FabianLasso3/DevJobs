<div>

    <livewire:filtrar-vacantes />

   <div class="py-12">
    <div class="max-w-7xl mx-auto">
        <h3 class="font-extrabold text-4xl text-gray-400 mb-10">Nuestras vacantes disponibles</h3>
        <div class="bg-gray-700 shadow-sm rounded-lg p-6 divide-y divide-gray-200">
            @forelse ($vacantes as $vacante)
                <div class="md:flex md:justify-between md:items-center py-5">
                    <div class="md:flex-1">
                        <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-2xl font-extrabold text-gray-200">{{ $vacante->titulo }}</a>
                        <p class="text-base text-gray-200 mb-1">{{ $vacante->empresa }}</p>
                        <p class="text-base text-gray-200 mb-1">{{ $vacante->categoria->categoria }}</p>
                        <p class="text-base text-gray-200 mb-1">{{ $vacante->salario->salario }}</p>
                        <p class="font-bold text-xs text-gray-200 mb-3">Ultimo dia para postularse: <span class="font-base" >{{$vacante->ultimo_dia->format('d/m/Y')}}</span></p>
                    </div>
                    <div class="mt-5 md:mt-0">

                        <a href="{{ route('vacantes.show', $vacante->id) }}" class="bg-green-500 p-3 text-sm uppercase font-bold rounded-lg block text-center text-white">Ver vacante</a>
                    </div>

                    </div>
                </div>
            @empty
                <p class="p-3 text-center text-sm text-gray-300">No hay vacantes aún</p>
            @endforelse
        </div>
    </div>
   </div>
</div>
