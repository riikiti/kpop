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
class CommentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Comment::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/comments');
        CRUD::setEntityNameStrings('', 'Комментарии');
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
            'name' => 'body',
            'label' => 'Комментарий',
        ]);
    }


    protected function setupShowOperation(){
        $this->setupListOperation();
    }

}
