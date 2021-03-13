<?php


namespace App\Http\Controllers\Admin\Screens;


use Whoops\Exception\ErrorException;
use Wtolk\Crud\Form\Checkbox;
use Wtolk\Crud\Form\Column;
use Wtolk\Crud\Form\Cropper;
use Wtolk\Crud\Form\DateTime;
use Wtolk\Crud\Form\File;
use Wtolk\Crud\Form\Link;
use Wtolk\Crud\Form\MultiFile;
use Wtolk\Crud\Form\Summernote;
use Wtolk\Crud\Form\TableField;
use Wtolk\Crud\FormPresenter;
use App\Models\Adfm\News;
use Wtolk\Crud\Form\Input;
use Wtolk\Crud\Form\Button;

class NewsScreen
{
    public $form;
    public $request;

    public function __construct()
    {
        $this->form = new FormPresenter();
        $this->request = request();

    }

    public static function index()
    {
        $screen = new self();
        $screen->form->template('table-list')->source([
            'news' => News::withTrashed()->paginate(50)
        ]);
        $screen->form->title = 'Новости';
        $screen->form->addField(
            TableField::make('title', 'Название страницы')
                ->link(function ($model) {
                    echo Link::make($model->title)->route('adfm.news.edit', ['id' => $model->id])
                        ->render();
                })
        );
        $screen->form->addField(TableField::make('created_at', 'Дата создания'));
        $screen->form->addField(
            TableField::make('', '')
                ->link(function ($model) {
                    echo Link::make('Удалить')->route('adfm.news.destroy', ['id' => $model->id])->render();
                    echo Link::make('Восстановить')->route('adfm.news.restore', ['id' => $model->id])->canSee($model->trashed())->render();
                })
        );

        $screen->form->buttons([
            Link::make('Добавить')->class('button')->icon('note')->route('adfm.news.create')
        ]);
        $screen->form->build();
        $screen->form->render();
    }

    public static function create()
    {
        $screen = new self();
        $screen->form->isModelExists = false;
        $screen->form->template('form-edit')->source([
            'news' => new News()
        ]);
        $screen->form->title = 'Создание Новости';
        $screen->form->route = route('adfm.news.store');
        $screen->form->columns = self::getFields();
        $screen->form->buttons([
            Button::make('Сохранить')->icon('save')->route('adfm.news.update')->submit(),
        ]);
        $screen->form->build();
        $screen->form->render();
    }

    public static function edit()
    {
        $screen = new self();
        $screen->form->isModelExists = true;
        $screen->form->template('form-edit')->source([
                'news' => News::findOrFail($screen->request->route('id'))
        ]);
        $screen->form->title = 'Редактирование Новости';
        $screen->form->route = route('adfm.news.update', $screen->form->source['news']->id);
        $screen->form->columns = self::getFields();
        $screen->form->buttons([
            Button::make('Сохранить')->icon('save')->route('adfm.news.update')->submit(),
            Button::make('Удалить')->icon('trash')->route('adfm.news.destroy')->canSee($screen->form->isModelExists),
        ]);
        $screen->form->build();
        $screen->form->render();
    }

    public static function getFields() {
        return [
            Column::make([
                Input::make('news.title')
                    ->title('Заголовок новости')
                    ->required()
                    ->placeholder('Например , объявление о нерабочих днях'),

                Summernote::make('news.content')->title('Содержимое'),

                Cropper::make('news.image')->title('Изображение') ,
            ]),
            Column::make([
                Input::make('news.slug')
                    ->title('Вид в адресной строке')
                    ->required()
                    ->placeholder('Введите пару ключевых слов (2-3)'),

                DateTime::make('news.published_at')->title('Дата публикации')
            ])->class('col col-md-4')
        ];
    }


}
