<?php
namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Listing extends Component
{

    # Table Columns
    public $tableColumns = [
        [
            'label' => '#',
            'type'  => 'index',
            'field' => 'id',
        ],
        [
            'label' => 'Name',
            'type'  => 'field',
            'field' => 'name',
        ],
        [
            'label' => 'Email',
            'type'  => 'field',
            'field' => 'email',
        ],
        [
            'label'  => 'Created At',
            'type'   => 'date',
            'field'  => 'created_at',
            'format' => 'diffForHumans',
            'class'  => 'whitespace-nowrap',
        ],
        [
            'label'   => 'Actions',
            'type'    => 'actions',
            'class'   => 'text-center w-40',
            'actions' => [
                [
                    'label'     => 'View',
                    'icon'      => 'eye',
                    'color'     => 'sky',
                    'variant'   => 'primary',
                    'type'      => 'view',
                    'eventType' => 'modal',
                    'modalName' => 'user-form-modal',
                ],
                [
                    'label'     => 'Edit',
                    'icon'      => 'pencil',
                    'color'     => 'blue',
                    'variant'   => 'primary',
                    'type'      => 'edit',
                    'eventType' => 'modal',
                    'modalName' => 'user-form-modal',
                ],
                [
                    'label'   => 'Delete',
                    'icon'    => 'trash',
                    'color'   => 'red',
                    'variant' => 'primary',
                    'type'    => 'delete',
                ],
            ],
        ],
    ];

    public $modelClass        = User::class;
    public int $perPage       = 5;
    public string $orderByKey = 'id';
    public string $sortOrder  = 'desc';

    public function render()
    {
        return view('livewire.users.listing');
    }
}
