<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Courter extends Component
{
    public $count = 10;
    public function render()
    {
        return view('livewire.courter',["counter"=>$this->count]);
    }

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        if ($this->count > 0) $this->count--;
    }
}
