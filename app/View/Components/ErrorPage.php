<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ErrorPage extends Component
{
    public $code;

    public $text;

    public $message;

    /**
     * Create a new component instance.
     */
    public function __construct($code, $text, $message)
    {
        $this->code = $code;
        $this->text = $text;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.error-page');
    }
}
