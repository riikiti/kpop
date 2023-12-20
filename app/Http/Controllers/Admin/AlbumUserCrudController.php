<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AlbumUserRequest;
use App\Models\Album;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AlbumUserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AlbumUserCrudController extends CrudController
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
        CRUD::setModel(\App\Models\AlbumUser::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/album-user');
        CRUD::setEntityNameStrings('', 'Альбомы пользователей');
    }

    protected function setupListOperation()
    {
        $this->crud->column('id')->label('id');
        $this->crud->addColumn([
            'name' => 'user_id',
            'label' => 'Пользователи',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->user()->pluck('name')[0];
            }
        ]);

        $this->crud->addColumn([
            'name' => 'album_id',
            'label' => 'Альбом',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->album()->pluck('name')[0];
            }
        ]);
        $this->crud->addColumn([
            'name' => 'approved',
            'label' => 'Статус подтверждения',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->getpApprovedStatusStatus();
            }
        ]);
    }


    protected function setupCreateOperation()
    {
        CRUD::setValidation(AlbumUserRequest::class);
        $this->crud->addField([
            'label'     => "Пользователь",
            'type'      => 'select',
            'name'      => 'user_id',
            'entity'    => 'user',
            'model'     => User::class,
            'attribute' => 'name',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $this->crud->addField([
            'label'     => "Альбом",
            'type'      => 'select',
            'name'      => 'album_id',
            'entity'    => 'album',
            'model'     => Album::class,
            'attribute' => 'name',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        $this->crud->field('approved')->label('Подтверждено');
    }


    protected function setupShowOperation(){
        $this->setupListOperation();
    }
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
