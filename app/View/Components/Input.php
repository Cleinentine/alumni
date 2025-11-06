<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $hasValue;

    public $icon;

    public $id;

    public $name;

    public $placeholder;

    public $type;

    public $value;

    /**
     * Create a new component instance.
     */
    public function __construct($hasValue, $icon, $id, $name, $placeholder, $type, $value)
    {
        $this->hasValue = $hasValue;
        $this->icon = $icon;
        $this->id = $id;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
