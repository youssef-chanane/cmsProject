<?php

namespace App\View\Components;

use Illuminate\View\Component;

class form extends Component
{
    public $action;
    public $btnValue;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action,$btnValue)
    {
        $this->action=$action;
        $this->btnValue=$btnValue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form');
    }
}