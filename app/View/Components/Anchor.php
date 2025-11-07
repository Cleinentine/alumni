<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Anchor extends Component
{
    public $href;

    public $text;

    /**
     * Create a new component instance.
     */
    public function __construct($href, $text)
    {
        $this->href = $href;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.anchor');
    }
}
