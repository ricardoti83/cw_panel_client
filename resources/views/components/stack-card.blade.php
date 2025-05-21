@props(['name', 'status', 'url', 'activeTime' => null, 'stack'])

@php
    $status = strtolower($status);

    $statusMap = [
        'active' => ['label' => 'Online', 'color' => 'text-green-600', 'dot' => 'bg-green-500'],
        'starting' => ['label' => 'Starting', 'color' => 'text-yellow-600', 'dot' => 'bg-yellow-500'],
        'offline' => ['label' => 'Offline', 'color' => 'text-red-600', 'dot' => 'bg-red-500'],
    ];

    $statusInfo = $statusMap[$status] ?? ['label' => ucfirst($status), 'color' => 'text-gray-600', 'dot' => 'bg-gray-400'];
@endphp

<div class="rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 p-4 h-[300px] flex flex-col justify-between">
    <div class="space-y-2">
        <!-- status com bolinha -->
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full {{ $statusInfo['dot'] }}"></span>
            <span class="text-sm font-semibold {{ $statusInfo['color'] }}">
                {{ $statusInfo['label'] }}
            </span>
        </div>

        <!-- nome da stack -->
        <h2 class="text-lg font-bold text-gray-900 dark:text-white">
            {{ $name }}
        </h2>

        <!-- tempo de atividade -->
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Tempo de atividade: {{ $activeTime ?? '—' }}
        </p>

        <!-- botões de controle -->
        <livewire:stack-actions :stack="$stack" />
    </div>

    <!-- link para acessar a stack -->
    @if($status === 'active')
        <a href="{{ $url }}" target="_blank"
           class="mt-4 text-sm text-primary-600 hover:underline text-center block">
            Acessar Stack →
        </a>
    @else
        <p class="mt-4 text-sm text-gray-400 text-center">
            Aguardando ativação
        </p>
    @endif
</div>
