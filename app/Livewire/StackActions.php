<?php

namespace App\Livewire;

use App\Models\Stack;
use Livewire\Component;

class StackActions extends Component
{
    public Stack $stack;



    public function start()
    {
        if ($this->stack->status !== 'offline') return;

        $this->stack->update(['status' => 'starting']);

        sleep(2); // simula inicialização
        $this->stack->update(['status' => 'active']);
    }

    public function stop()
    {
        if ($this->stack->status !== 'active') return;

        $this->stack->update(['status' => 'offline']);
    }

    public function restart()
    {
        if ($this->stack->status !== 'active') return;

        $this->stack->update(['status' => 'starting']);

        sleep(2); // simula reinicialização
        $this->stack->update(['status' => 'active']);
    }

    public function render()
    {
        return view('livewire.stack-actions');
    }

}
