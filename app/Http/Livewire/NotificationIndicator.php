<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
class NotificationIndicator extends Component
{

    protected $listeners = [
        'NotificationMarkedAsRead' => '$refresh',
    ];
    public function render() :view
    {
        return view('livewire.notification-indicator');
    }
}
