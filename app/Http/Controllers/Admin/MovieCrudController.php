<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MovieRequest;
use App\Models\Genre;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MovieCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MovieCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Movie::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/movie');
        CRUD::setEntityNameStrings('movie', 'movies');
        $this->crud->setEditView('vendor.backpack.movies_edit');

        $this->crud->addButtonFromModelFunction('top', 'open_google', 'openGoogle', 'beginning');

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        $this->crud->addFilter([
            'name'  => 'category_id',
            'type'  => 'select2',
            'label' => 'Категория'
        ], function() {
            return [
                1 => 'Сериалы',
                2 => 'Аниме',
            ];
        });


        CRUD::addColumn([
            'name'     => 'picture',
            'label'    => 'Постер',
            'type'     => 'closure',
            'function' => function($entry) {

                    if($entry->picture) {
                        $img = asset('/storage/poster/serial') . '/' .  $entry->picture;
                    } else {
                        $img = asset('/storage/poster/') . '/no-image1.jpg';
                    }

                return '<img src="' .$img.'" height="100" />';
            }
        ]);

        CRUD::column('name')->label('Название');
        CRUD::column('name_original')->label('Оригинал');

        $this->crud->query->withCount('seasons');
        CRUD::addColumn([
            'name'      => 'seasons', // name of relationship method in the model
            'type'      => 'relationship_count',
            'label'     => 'Кол-во сезонов', // Table column heading
            'suffix'    => '', // to show "123 tags" instead of "123"
        ]);

        CRUD::addColumn([
            'label'     => 'Серий', // Table column heading
            'name'      => 'series_count', // name of relationship method in the model
            'type' => 'closure',
            'function' => function($entry) {
                return $entry->getCountSeries($entry);
            }
        ]);

        CRUD::addColumn([
            'label'     => 'Категория', // Table column heading
            'type'      => 'select',
            'name'      => 'category_id', // the method that defines the relationship in your Model
            'entity'    => 'category', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => 'App\Models\Category', // foreign key model
        ]);

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(MovieRequest::class);



        CRUD::field('name')->tab('Главное')->label('Название');
        CRUD::field('slug')->tab('Главное')->label('ссылка (название на англ)');
        CRUD::field('name_original')->tab('Главное')->label('Название оригинальное');
        CRUD::field('alt_name')->tab('Главное')->label('Название альтернативное');
        CRUD::field('category_id')->tab('Главное')->label('Категория');
        CRUD::addField([
            'label'=> 'Жанры',
            'type' => 'select2_multiple',
            'name' => 'genres',
            'entity' => 'genres',
            'attribute' => 'name',
            'model' => Genre::class,
            'pivot' => true,
            'tab' => 'Главное'
        ]);
        CRUD::field('year')->tab('Главное')->label('Год');
        CRUD::field('description')->tab('Главное')->label('Описание');
        CRUD::field('status_movie')->tab('Главное')->label('Статус съемки');
        CRUD::field('tagline')->tab('Главное')->label('Слоган');
        CRUD::field('language')->tab('Главное')->label('Оригинальный язык фильма');
        CRUD::field('duration')->tab('Главное')->label('Продолжительность');
        //CRUD::field('picture')->tab('Главное')->label('Постер');
        //CRUD::field('screen_url')->tab('Главное')->label('Задник картинка');
        CRUD::field('date_pub_rus')->tab('Главное')->label('Дата выхода Россия');
        CRUD::field('date_pub_world')->tab('Главное')->label('Дата выхода МИР');

        /*
        $this->crud->addField([
            'type' => 'image',
            'name' => 'screen_url',
            'label' => 'Изображение анонса',
            'upload' => true,
            'prefix' => 'storage/',
            'tab' => 'Главное'
        ]);
        */




        CRUD::field('author_id')->tab('Главное')->label('Автор');

        CRUD::addField([
            'name'     => 'status',
            'label'    => "Статус публикации на сайте",
            'type'     => 'select_from_array',
            'options' => ['MODERATION' => 'Модерация', 'PUBLISHED' => 'Опубликован', 'DISABLE' => 'Выключен'],
            'tab' => 'Главное',
            'allows_null' => false,
            'default' => 'MODERATION',
        ]);


        CRUD::field('published_at')->tab('Главное')->label('Дата публикации на сайте');


        $this->crud->addField([
                'name'     => 'tmdb_id', // JSON variable name
                'label'    => "themoviedb.org", // human-readable label for the input
                'fake'     => true, // show the field, but don't store it in the database column above
                'store_in' => 'source_url', // [optional] the database column name where you want the fake fields to ACTUALLY be stored as a JSON array
                'tab' => 'Парс'
        ]);

        $this->crud->addField([   // CustomHTML
            'name'  => 'separator',
            'type'  => 'custom_html',
            'value' => '<div class="header_button_creat"><div class="create_search_tmdb">Найти на themoviedb.org</div></div>'
        ]);

        $this->crud->addField([
            'name'     => 'seasons_view', // JSON variable name
            'label'    => "Сезоны", // human-readable label for the input
            'type'     => 'seasons_create_tab', // show the field, but don't store it in the database column above
            'tab' => 'Сезоны и серии'
        ]);


        $this->crud->addField([
            'name'     => 'actors_view', // JSON variable name
            'label'    => "Жанры", // human-readable label for the input
            'type'     => 'actors_create_tab', // show the field, but don't store it in the database column above
            'tab' => 'Актеры'
        ]);

/*
        $this->crud->addField([
            'name'     => 'trailers_view', // JSON variable name
            'label'    => "Трейлеры", // human-readable label for the input
            'type'     => 'seasons_create_tab', // show the field, but don't store it in the database column above
            'tab' => 'Трейлеры и фото'
        ]);*/

        $this->crud->addField([
            'label' => "Постер",
            'name' => "picture",
            'type' => 'image',
            'crop' => false, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // omit or set to 0 to allow any aspect ratio
            'tab' => 'Трейлеры и фото',
            // 'disk'      => 's3_bucket', // in case you need to show images from a different disk
            'prefix'    => asset('/storage/poster/serial') . '/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
        ]);


        $this->crud->addField([
            'label' => "Задник картинка",
            'hint' => 'Фоновое изображение страницы',
            'name' => "screen_url",
            'type' => 'image',
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 0, // omit or set to 0 to allow any aspect ratio
            'tab' => 'Трейлеры и фото',
            // 'disk'      => 's3_bucket', // in case you need to show images from a different disk
            'prefix'    => asset('/storage/backdrop/serial') . '/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
        ]);




        $this->crud->addField([
            'name'     => 'toramp_id', // JSON variable name
            'label'    => "Toramp.com", // human-readable label for the input
            'fake'     => true, // show the field, but don't store it in the database column above
            'store_in' => 'source_url', // [optional] the database column name where you want the fake fields to ACTUALLY be stored as a JSON array
            'tab' => 'Парс'
        ]);

        $this->crud->addField([
            'name'     => 'imdb_id', // JSON variable name
            'label'    => "ImDB.com", // human-readable label for the input
            'fake'     => true, // show the field, but don't store it in the database column above
            'store_in' => 'source_url', // [optional] the database column name where you want the fake fields to ACTUALLY be stored as a JSON array
            'tab' => 'Парс'
        ]);





        /*
        $this->crud->addField([
            'name' => 'name',
            'label' => 'Есть пандус',
            'type' => 'checkbox',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-7'
            ],
            'tab' => 'Информация',
        ]);
        */


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
}
