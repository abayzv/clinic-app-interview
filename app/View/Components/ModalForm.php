<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalForm extends Component
{
    public $modalId;
    public $title;
    public $action;
    public $method;
    public $submitText;
    public $item;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $modalId = 'modalForm',
        $title = 'Form',
        $action = '',
        $method = 'POST',
        $submitText = 'Save',
        $item = null
    ) {
        $this->modalId = $modalId;
        $this->title = $title;
        $this->action = $action;
        $this->method = $method;
        $this->submitText = $submitText;
        $this->item = $item;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-form');
    }
}
