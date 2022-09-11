<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

class Full extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $modal;
    public function __construct($modal)
    {
        $this->modal=$modal;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals.full');
    }
}
