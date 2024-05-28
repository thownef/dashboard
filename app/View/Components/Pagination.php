<?php

namespace App\View\Components;

use Closure;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Pagination extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pagination');
    }
}
