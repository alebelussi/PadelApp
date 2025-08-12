<?php

namespace App\View\Components;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Avatar extends Component
{

    public $user;

    /**
     * Create a new component instance.
     */
    public function __construct($user = null)
    {
        $this->user = $user ?? Auth::user();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.avatar');
    }
}
