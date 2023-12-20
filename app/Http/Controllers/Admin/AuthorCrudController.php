<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AuthorRequest;
use App\Models\Group;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AuthorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AuthorCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Author::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/author');
        CRUD::setEntityNameStrings('Автора', 'Авторы');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->column('id');
        $this->crud->column('name')->label('Имя');
        $this->crud->addColumn([
            'name' => 'avatar',
            'label' => 'Аватар',
            'type' => 'image',
            'prefix' => '/storage/',
        ]);
        $this->crud->column('group')->label('Группа');
        $this->crud->column('status')->label('Тип группы');
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(AuthorRequest::class);
        $this->crud->field('name')->label('Имя');
        $this->crud->addField([
            'label' => "Группа",
            'type' => 'select',
            'name' => 'group_id',
            'entity' => 'group',
            'model' => Group::class,
            'attribute' => 'name',
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        $this->crud->addField([
            'name' => 'avatar',
            'label' => 'Аватар',
            'type' => 'upload',
            'withFiles' => true
        ]);
        $this->crud->field([
            'name' => 'status',
            'label' => 'Направление',
            'type' => 'enum',
            'options' => [
                'Женская группа' => 'Женская группа',
                'Мужская группа' => 'Мужская группа',
                'Соло исполнитель' => 'Соло исполнитель',
            ]
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
