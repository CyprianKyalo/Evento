<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Product;
use DB;


/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('product_id');
        CRUD::column('name');
        CRUD::column('description');
        CRUD::column('category');
        CRUD::column('status');

        $this->crud->enableExportButtons();
        $this->crud->addButtonFromView('line', 'enable', 'enable', 'end');
        $this->crud->addButtonFromView('line', 'disable', 'disable', 'end');
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
        CRUD::setValidation(ProductRequest::class);

        CRUD::field('name');
        CRUD::field('description');
        CRUD::field('category');
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
        $this->setupCreateOperation();
    }

    public function disable($id) {
        $product = Product::find($id);
        // dd($user);


         if($product->save()) {
            DB::table('products')
                        ->where('product_id', $id)
                        ->update([
                            'status' => 0]);


            return redirect('/admin/product')->with('success', 'Product updated successfully!');
        } else {
             return redirect('/admin/product')->with('error', 'Please Try Again!');
        }
        //dd($id);

    }

     public function enable($id) {
        $product = Product::find($id);
        // dd($user);


         if($product->save()) {
            DB::table('products')
                        ->where('product_id', $id)
                        ->update([
                            'status' => 1]);


            return redirect('/admin/product')->with('success', 'User updated successfully!');
        } else {
             return redirect('/admin/product')->with('error', 'Please Try Again!');
        }
        //dd($id);

    }
}
