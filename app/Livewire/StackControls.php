<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class StackControls extends Component
{
    protected $listeners = [
        'container:start' => 'startContainer',
        'container:stop' => 'stopContainer',
        'container:restart' => 'restartContainer',
    ];
    public function startContainer($container)
    {
        Http::post('http://dockerctl:3000/start', ['container' => $container]);
    }

    public function stopContainer($container)
    {
        Http::post('http://dockerctl:3000/stop', ['container' => $container]);
    }

    public function restartContainer($container)
    {
        Http::post('http://dockerctl:3000/restart', ['container' => $container]);
    }

    public function render()
    {
        return view('livewire.stack-controls');
    }
}
