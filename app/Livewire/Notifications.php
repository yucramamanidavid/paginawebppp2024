<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Notifications extends Component
{
    public function render()
    {
        $notifications = Auth::user()->notifications;
        return view('livewire.notifications', compact('notifications'));
    }
}
