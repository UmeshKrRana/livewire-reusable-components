<?php
namespace App\Livewire\Common;

use Livewire\Component;
use Livewire\WithPagination;

class CustomTable extends Component
{

    use WithPagination;

    public array $columns = [];
    public $modelClass;
    public $perPage           = 10;
    public string $orderByKey = 'id';
    public string $sortOrder  = 'desc';
    public string $actionEvent;

    public function mount(array $columns, $modelClass, $perPage = 10, $orderByKey = 'id', $sortOrder = 'desc', $actionEvent)
    {
        $this->columns     = $columns;
        $this->modelClass  = $modelClass;
        $this->perPage     = $perPage;
        $this->orderByKey  = $orderByKey;
        $this->sortOrder   = $sortOrder;
        $this->actionEvent = $actionEvent;
    }

    public function getRowsProperty()
    {
        return $this->modelClass::orderBy($this->orderByKey, $this->sortOrder)->paginate($this->perPage);
    }

    /**
     * Table action click handler
     */
    public function actionClickHandler($props)
    {

        $this->dispatch($this->actionEvent, $props);
    }

    public function render()
    {
        return view('livewire.common.custom-table');
    }
}
