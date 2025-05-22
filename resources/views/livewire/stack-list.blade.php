<script>
    function startContainer(name) {
        fetch('http://localhost:3000/start', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ container: name })
        })
        .then(r => r.json())
        .then(console.log)
        .catch(console.error);
    }
    function stopContainer(name) {
        fetch('http://localhost:3000/stop', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ container: name })
        })
        .then(r => r.json())
        .then(console.log)
        .catch(console.error);
    }
    function restartContainer(name) {
        fetch('http://localhost:3000/restart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ container: name })
        })
        .then(r => r.json())
        .then(console.log)
        .catch(console.error);
    }
</script>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach ($containers as $container)
        @php
            $isUp = str_contains($container['status'], 'Up');
            $statusText = $isUp ? 'Online' : 'Offline';
            $statusColor = $isUp ? 'text-green-400' : 'text-red-400';
            $dotColor = $isUp ? 'bg-green-400' : 'bg-red-400';
            $statusBg = $isUp ? 'bg-green-500/10' : 'bg-red-500/10';
            $icon = match($container['name']) {
                'n8n' => 'code',
                'PostgreSQL' => 'database',
                'Redis' => 'cpu',
                'MinIO' => 'cloud',
                default => 'server'
            };
        @endphp

        <div class="p-6 rounded-2xl bg-zinc-900 border border-zinc-800 shadow-sm flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-white/70">{{ $container['name'] }}</div>
                    <div class="flex items-center gap-2 text-2xl font-bold {{ $statusColor }}">
                        <span class="w-2 h-2 rounded-full {{ $dotColor }}"></span>
                        {{ $statusText }}
                    </div>
                </div>
                <div class="p-2 rounded-full {{ $statusBg }}">
                    <x-heroicon-o-{{ $icon }} class="w-5 h-5 text-white" />
                </div>
            </div>
            <div class="text-xs text-white/50">
                {{ $container['status'] }}
            </div>
            <div class="flex gap-2 pt-2">
                <button
                    onclick="restartContainer('{{ $container['raw'] }}')"
                    class="text-xs px-3 py-1 rounded-md border border-yellow-500 text-yellow-500 hover:bg-yellow-600 hover:text-white transition"
                    {{ $isUp ? '' : 'disabled' }}>
                    Reiniciar
                </button>
                <button
                    onclick="stopContainer('{{ $container['raw'] }}')"
                    class="text-xs px-3 py-1 rounded-md border border-red-500 text-red-500 hover:bg-red-600 hover:text-white transition"
                    {{ $isUp ? '' : 'disabled' }}>
                    Parar
                </button>
                <button
                    onclick="startContainer('{{ $container['raw'] }}')"
                    class="text-xs px-3 py-1 rounded-md border border-green-500 text-green-500 hover:bg-green-600 hover:text-white transition"
                    {{ $isUp ? 'disabled' : '' }}>
                    Ligar
                </button>
            </div>
        </div>
    @endforeach
</div>
