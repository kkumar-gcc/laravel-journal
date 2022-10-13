<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BaseLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $page;
    public function __construct($page=null)
    {
        $this->page=$page;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.base');
    }
}
