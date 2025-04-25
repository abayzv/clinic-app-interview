<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTable extends Component
{
    public $items;
    public $columns;
    public $paginated;
    public $class;
    public $emptyMessage;
    public $actions;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $items = [],
        $columns = [],
        $paginated = false,
        $class = 'min-w-full divide-y divide-gray-200',
        $emptyMessage = 'Tidak ada data ditemukan',
        $actions = null
    ) {
        $this->items = $items;
        $this->columns = $columns;
        $this->paginated = $paginated;
        $this->class = $class;
        $this->emptyMessage = $emptyMessage;
        $this->actions = $actions;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.data-table');
    }
}
