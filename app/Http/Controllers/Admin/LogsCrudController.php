<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LogsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LogsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LogsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    public function setup()
    {
        CRUD::setModel(\App\Models\Logs::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/logs');
        CRUD::setEntityNameStrings('Лог', 'Логи');
    }


    protected function setupListOperation()
    {
        $this->crud->column('id')->label('id');
        $this->crud->addColumn([
            'name' => 'content',
            'label' => 'Описание',
            'limit' => 10000
        ]);
        $this->crud->addColumn([
            'name' => 'user_id',
            'label' => 'Пользователь',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->user()->pluck('name')[0];
            }
        ]);
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }
}
