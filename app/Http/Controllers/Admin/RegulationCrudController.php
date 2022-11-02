<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RegulationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RegulationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RegulationCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Regulation::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/regulation');
        CRUD::setEntityNameStrings('Правило', 'Правила');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
//        CRUD::column('id');
        CRUD::column('name')->label('Наименование');
        //CRUD::column('description');
        CRUD::column('short')->label('Краткий текст');
        CRUD::column('private')->label('Членство');
        //CRUD::column('created_at');
        //CRUD::column('updated_at');

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
        CRUD::setValidation(RegulationRequest::class);


        $a = '';
        if($this->crud->getCurrentEntryId()) {

            $a = '<a target="_blank" href="/helps/'.$this->crud->getEntry($this->crud->getCurrentEntryId())["id"].'" style="margin-right: 20px; color: #fff; padding: 5px 10px; background: #42ba96">Посмотреть на сайте</a>';

        }


        $this->crud->addField([   // CustomHTML
            'name'  => 'separator',
            'type'  => 'custom_html',
            'value' => "<div class='header_button_creat'>
                {$a}
                </div>"
        ]);

        CRUD::field('name')->label('Наименование статьи');
        CRUD::addField([
            'label' => 'Описание',
            'name' => 'description',
            'type' => 'summernote',
            'options' => $this->textEditorOptions()
        ]);
        CRUD::field('short')->label('Краткое описание');
        CRUD::field('sort')->label('Сортировка')->hint('По умолчанию у всех 100, если надо отправить в конец пишем больше цифру (500...)');
        CRUD::field('private')->label('Только для членства');
        CRUD::field('active')->label('Включить статью');

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

    protected function textEditorOptions()
    {
        return [
            'toolbar' => [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']],
            ],
            'imageAttributes' => [
                'icon' => '<i class="note-icon-pencil"/>',
            ],
            'popover' => [
                'image' => [
                    ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']],
                    ['custom', ['imageAttributes']],
                ],
            ],
        ];
    }
}
