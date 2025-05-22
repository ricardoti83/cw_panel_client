<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class StackList extends Component
{
    public array $containers = [];

    public function loadContainers(): void
{
    $response = Http::get('http://dockerctl:3000/containers', [
        'label' => 'cliente=client1'
    ]);

    if ($response->ok()) {
        $this->containers = collect($response->json())
            ->map(function ($line) {
                [$name, $status] = explode(':', $line, 2);

                // remove prefixo
                $short = str_replace('stack_n8n-', '', $name);

                // nome amigável baseado no tipo
                $friendly = match (true) {
                    str_starts_with($short, 'n8n') => 'n8n',
                    str_starts_with($short, 'redis') => 'Redis',
                    str_starts_with($short, 'postgres') => 'PostgreSQL',
                    str_starts_with($short, 'minio') => 'MinIO',
                    default => ucfirst($short),
                };

                return [
                    'name' => $friendly,
                    'raw' => $name,
                    'status' => trim($status),
                ];
            })
            ->toArray();
    }
}


    public function render()
    {
        $this->loadContainers();

        return view('livewire.stack-list');
    }
}
