@php
    $status = strtolower($stack->status);

    $isActive = $status === 'active';
    $isStarting = $status === 'starting';
    $isOffline = $status === 'offline';

    $buttonBase = 'w-full px-3 py-2 rounded-md text-sm font-semibold text-white border transition';
@endphp

<div class="space-y-2">
    <div class="flex gap-2">
        <button
            wire:click="restart"
            wire:loading.attr="disabled"
            class="{{ $buttonBase }} bg-yellow-500 hover:bg-yellow-600 border-yellow-600 {{ ($isStarting || $isOffline) ? 'opacity-40 cursor-not-allowed' : '' }}"
            @disabled($isStarting || $isOffline)>
            Reiniciar
        </button>

        <button
            wire:click="stop"
            wire:loading.attr="disabled"
            class="{{ $buttonBase }} bg-red-600 hover:bg-red-700 border-red-700 {{ ($isStarting || $isOffline) ? 'opacity-40 cursor-not-allowed' : '' }}"
            @disabled($isStarting || $isOffline)>
            Parar
        </button>
    </div>

    <button
        wire:click="start"
        wire:loading.attr="disabled"
        class="{{ $buttonBase }} bg-green-600 hover:bg-green-700 border-green-700 {{ ($isStarting || $isActive) ? 'opacity-40 cursor-not-allowed' : '' }}"
        @disabled($isStarting || $isActive)>
        Ligar
    </button>
</div>
