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
                    'label'   => 'View',
                    'icon'    => 'eye',
                    'color'   => 'sky',
                    'variant' => 'primary',
                ],
                [
                    'label'   => 'Edit',
                    'icon'    => 'pencil',
                    'color'   => 'blue',
                    'variant' => 'primary',
                ],
                [
                    'label'   => 'Delete',
                    'icon'    => 'trash',
                    'color'   => 'red',
                    'variant' => 'primary',
                ],
            ],
        ],
    ];

    public $modelClass = User::class;
    public int $perPage = 5;
    public string $orderByKey = 'name';
    public string $sortOrder = 'desc';

    public function render()
    {
        return view('livewire.users.listing');
    }
}
