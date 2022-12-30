<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FormLogin extends Component
{
    public $form = [
        "email" => "",
        "password" => ""
    ];

    public function submit()
    {
        $this->validate([
            "form.email"=>"required|email",
            "form.password"=>"required",
        ]);
        Auth::attempt($this->form);
        return redirect(route("index"));
    }
    public function render()
    {
        return view('livewire.form-login');
    }
}
