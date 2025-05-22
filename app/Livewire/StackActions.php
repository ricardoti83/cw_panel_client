<?php

namespace App\Livewire;

use App\Models\Stack;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class StackActions extends Component
{
    public Stack $stack;



    public function start()
    {
        if ($this->stack->status !== 'offline') return;

        // 🔗 chama a API dockerctl
        Http::post('http://dockerctl:3000/start', [
            'container' => $this->stack->container_name,
        ]);

        $this->stack->update(['status' => 'starting']);
        sleep(2);
        $this->stack->update(['status' => 'active']);
    }

    public function stop()
    {
        if ($this->stack->status !== 'active') return;

        Http::post('http://dockerctl:3000/stop', [
            'container' => $this->stack->container_name,
        ]);

        $this->stack->update(['status' => 'offline']);
    }

    public function restart()
    {
        if ($this->stack->status !== 'active') return;

        Http::post('http://dockerctl:3000/restart', [
            'container' => $this->stack->container_name,
        ]);

        $this->stack->update(['status' => 'starting']);
        sleep(2);
        $this->stack->update(['status' => 'active']);
    }

    public function render()
    {
        return view('livewire.stack-actions');
    }

}
