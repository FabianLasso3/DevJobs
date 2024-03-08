@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm text-gray-500 font-bold uppercase mb-3']) }}>
    {{ $value ?? $slot }}
</label>
