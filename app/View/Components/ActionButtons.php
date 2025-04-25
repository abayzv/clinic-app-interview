<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButtons extends Component
{
    public $editRoute;
    public $deleteRoute;
    public $showRoute;
    public $itemId;
    public $itemName;
    public $modalId;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $editRoute = null,
        $deleteRoute = null,
        $showRoute = null,
        $itemId = null,
        $itemName = null
    ) {
        $this->editRoute = $editRoute;
        $this->deleteRoute = $deleteRoute;
        $this->showRoute = $showRoute;
        $this->itemId = $itemId;
        $this->itemName = $itemName;
        $this->modalId = 'deleteModal-' . uniqid();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-buttons');
    }
}
