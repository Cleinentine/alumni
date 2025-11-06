<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $displayText;

    public $icon;

    public $id;

    public $loop;

    public $name;

    public $value;

    /**
     * Create a new component instance.
     */
    public function __construct($displayText, $icon, $id, $loop, $name, $value)
    {
        $this->displayText = $displayText;
        $this->icon = $icon;
        $this->id = $id;
        $this->loop = $loop;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
