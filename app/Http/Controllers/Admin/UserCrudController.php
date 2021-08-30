<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use DB;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
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
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
                // simple filter
        $this->crud->addFilter([
          'type'  => 'simple',
          'name'  => 'active',
          'label' => 'Disabled'
        ], 
        false, 
        function() { // if the filter is active
          $this->crud->addClause('where', 'status', 'Disabled'); // apply the "active" eloquent scope 
        } );


        // $this->crud->addFilter([
        //   'name'  => 'status',
        //   'type'  => 'dropdown',
        //   'label' => 'Status'
        // ], [
        //   1 => 'Enabled',
        //   2 => 'Disabled',
        // ], function($value) { // if the filter is active
        //   $this->crud->addClause('where', 'status', $value);
        //     // return User::all()->where('status', $value);
        // });

        $this->crud->addFilter([
          'type'  => 'text',
          'name'  => 'description',
          'label' => 'Description'
        ], 
        false, 
        function($value) { // if the filter is active
          $this->crud->addClause('where', 'username', 'LIKE', "%$value%");
        });

        $this->crud->addFilter([
          'type'  => 'date',
          'name'  => 'date',
          'label' => 'Date'
        ],
          false,
        function ($value) { // if the filter is active, apply these constraints
          $this->crud->addClause('where', 'created_at', 'LIKE', "$value%");
        });

        $this->crud->addFilter([
          'type'  => 'date_range',
          'name'  => 'from_to',
          'label' => 'Date range'
        ],
        false,
        function ($value) { // if the filter is active, apply these constraints
          $dates = json_decode($value);
          $this->crud->addClause('where', 'created_at', '>=', $dates->from);
          $this->crud->addClause('where', 'created_at', '<=', $dates->to . ' 23:59:59');
        });

        
        CRUD::column('id');
        CRUD::column('first_name');
        CRUD::column('last_name');
        // CRUD::column('username');
        $this->crud->column('username');
        CRUD::column('email');
        $this->crud->column('status');
        CRUD::column('password');
        $this->crud->column('created_at');


        $this->crud->enableExportButtons();
        $this->crud->addButtonFromView('line', 'disable', 'disable', 'end');
        // $this->crud->addButton('line', 'Suspend', 'suspend', 'beginning');
      
        $this->crud->denyAccess('delete');



        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UserRequest::class);

        CRUD::field('first_name');
        CRUD::field('last_name');
        CRUD::field('username');
        CRUD::field('email');
        CRUD::field('password');
        CRUD::field('status');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        // $this->crud->modifyField('status', 'Enabled');
        $this->setupCreateOperation();
    }

    public function disable($id) {
        $user = User::find($id);
        // dd($user);


         if($user->save()) {
            DB::table('users')
                        ->where('id', $id)
                        ->update([
                            'status' => 'Enabled']);


            return redirect('/admin/user')->with('success', 'User updated successfully!');
        } else {
             return redirect('/admin/user')->with('error', 'Please Try Again!');
        }
        //dd($id);

    }
}
