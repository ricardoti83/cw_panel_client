<x-filament::page>
    <div class="space-y-4">
        <h2 class="text-xl font-bold">Containers em execução</h2>

        <ul class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900 rounded-lg shadow">
            @forelse ($this->containers as $container)
                <li class="px-4 py-3">
                    {{ $container }}
                </li>
            @empty
                <li class="px-4 py-3 text-gray-500">
                    Nenhum container em execução no momento.
                </li>
            @endforelse
        </ul>
    </div>
</x-filament::page>

