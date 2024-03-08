<div class="p-5 mt-10 flex flex-col justify-center items-center text-gray-300 bg-gray-700">
    <h3 class="text-center text-2xl font-bold my-4">Postularme a esta vacante</h3>
    
    @if(session()->has('mensaje'))
        <p class="uppercase border border-green-600 bg-gray-100 text-green-600 font-bold p-2 my-5 text-sm rounded-lg">
            {{ session('mensaje') }}
        </p>
    @else
    <form class="w-96 mt-5" wire:submit.prevent="postularme">
        <div class="">
            <x-input-label for="cv" :value="__('Curriculum o Hoja de vida (PDF)')" />
            <x-text-input id="cv" wire:model="cv" type="file" accept=".pdf" class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get("cv")" class="mt-2" />
        </div>
        <x-primary-button 
            class="my-5" 
            wire:loading.attr="disabled"
        >
        {{ __('Presentarme') }}
            <div 
                wire:loading wire:target="postularme"
                class="inline-block h-4 w-4 mr-1 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] text-white motion-reduce:animate-[spin_1.5s_linear_infinite]" 
                role="status"
            ></div>
        </x-primary-button>

    </form>

    @endif

    
</div>
