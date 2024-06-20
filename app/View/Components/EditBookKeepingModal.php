<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditBookKeepingModal extends Component
{
    public $id;
    public $type;
    public $bookKeepingType;
    public $bookKeepingAmount;
    public $bookKeepingDescription;
    public $bookKeepingDate;
    public $editMode;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $type,
        $id,
        $bookKeepingAmount = "",
        $bookKeepingDate = "",
        $bookKeepingDescription = "",
        $bookKeepingType = "",
        $editMode = false,
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->bookKeepingAmount = $bookKeepingAmount;
        $this->bookKeepingDate = $bookKeepingDate;
        $this->bookKeepingDescription = $bookKeepingDescription;
        $this->bookKeepingType = $bookKeepingType;
        $this->editMode = $editMode;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-book-keeping-modal');
    }
}
