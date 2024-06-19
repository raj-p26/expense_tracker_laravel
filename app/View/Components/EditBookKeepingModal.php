<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditBookKeepingModal extends Component
{
    public $id;
    public $type;
    /**
     * Create a new component instance.
     */
    public function __construct($type, $id)
    {
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-book-keeping-modal');
    }
}
