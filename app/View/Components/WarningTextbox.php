<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WarningTextbox extends Component
{
    public $subtext;

    public $text;

    /**
     * Create a new component instance.
     */
    public function __construct($subtext, $text)
    {
        $this->subtext = $subtext;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.warning-textbox');
    }
}
