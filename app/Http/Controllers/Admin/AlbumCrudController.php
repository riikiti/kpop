<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AlbumRequest;
use App\Models\Group;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AlbumCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AlbumCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Album::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/album');
        CRUD::setEntityNameStrings('Альбом', 'Альбомы');
    }

    protected function setupListOperation()
    {
        $this->crud->column('id');
        $this->crud->column('name')->label('Название');
        $this->crud->addColumn([
            'name' => 'photo',
            'label' => 'Превью',
            'type' => 'image',
            'prefix' => '/storage/',
        ]);
        $this->crud->column('price')->label('Стоимость');
        $this->crud->column('description')->label('Описание');
        $this->crud->addColumn([
            'label' => 'Автор',
            'name' => 'group',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->group()->pluck('name')[0];
            }
        ]);
        $this->crud->addColumn([
            'name' => 'new',
            'label' => 'Новинка',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->getNewStatusStatus();
            }
        ]);

    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(AlbumRequest::class);
        $this->crud->field('name')->label('Название');
        $this->crud->field('description')->label('Описание');
        $this->crud->addField([
            'name' => 'photo',
            'label' => 'Логотип',
            'type' => 'upload',
            'withFiles' => true
        ]);
        $this->crud->field('price')->label('Стоимость');
        $this->crud->addField([
            'label'     => "Автор",
            'type'      => 'select',
            'name'      => 'group_id',
            'entity'    => 'group',
            'model'     => Group::class,
            'attribute' => 'name',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        $this->crud->field('new')->label('Новинка');
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
