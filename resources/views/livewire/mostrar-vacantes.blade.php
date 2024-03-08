{{-- para usar livewire debe retornar solo un div --}}
<div class="">
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    @forelse($vacantes as $vacante)
    <div class="p-6 text-gray-900 dark:text-gray-200 md:flex md:justify-between md:items-center">
        <div class="space-y-3">
            <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-xl font-bold">{{ $vacante->titulo }}</a>
            <p class="text-sm text-gray-300 font-bold"> {{ $vacante->empresa }} </p>
            {{-- format() sirve para formatear la fecha d/m/y --}}
            <p class="text-sm text-gray-400">Ultimo dia: {{ $vacante->ultimo_dia->format('d/m/Y') }} </p>
        </div>

        <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
            <a href="{{ route('candidatos.index', $vacante->id) }}" class="bg-green-500 py-2 px-4 rounded-lg text-xs font-bold text-white uppercase text-center">
                {{ $vacante->candidatos->count() }} - Candidatos
            </a>

            <a href="{{ route('vacantes.edit', $vacante ) }}" class="bg-blue-500 py-2 px-4 rounded-lg text-xs font-bold text-white uppercase text-center">
                Editar
            </a>
            {{-- wire:click="$dispatch('prueba')" evento de livewire en este caso para ejejcutar la alert --}}
            {{-- $emit('prueba', {{$vacante->id}}) asi se pasan parametros desde la vista al componente --}}
            <button wire:click="$dispatch('mostrarAlerta', {{$vacante->id}})" class="bg-red-500 py-2 px-4 rounded-lg text-xs font-bold text-white uppercase text-center">
                Eliminar
            </button>
        </div>
    </div>
    @empty
        <p class="p-3 text-center text-sm text-gray-600">No hay vacantes que mostrar</p>
    @endforelse
 
</div>

    <div class="mt-10">
        {{ $vacantes->links() }}
    </div>
</div>

@push('scripts')
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

    <script>
        // otra forma de escuchar los eventos
        Livewire.on('mostrarAlerta', vacanteId => {  
            Swal.fire({
            title: '¿Deseas eliminar esta Vacante?',
            text: "Una ves eliminado ya no podras recuperar la vacante...",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Eliminar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                //eliminar vacante
                @this.call('eliminarVacante', vacanteId);
                Swal.fire(
                'Se eliminó la Vacante',
                'Eliminado Correctamente.',
                'success'
                )
            }
            })
        })

        
    </script>
@endpush
