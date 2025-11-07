<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GuestHeader extends Component
{
    public $icon;

    public $text;

    /**
     * Create a new component instance.
     */
    public function __construct($icon, $text)
    {
        $this->icon = $icon;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.guest-header');
    }
}
