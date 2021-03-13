<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Screens\NewsScreen;
use Illuminate\Http\Request;
use App\Models\Adfm\News;

class NewsController extends Controller
{

    public function index()
    {
        NewsScreen::index();
    }

    public function create()
    {
        NewsScreen::create();
    }

    /**
     * Создание
     */
    public function store(Request $request)
    {
        $item = new News();
        $item->fill($request->news)->save();
        return redirect()->route('adfm.news.index');
    }

    /**
     * Форма редактирования
     */
    public function edit($id)
    {
        NewsScreen::edit();
    }

    /**
     * Обновление
     */
    public function update(Request $request, $id)
    {
        $item = News::findOrFail($id);
        $item->fill($request->news)->save();
        return redirect()->route('adfm.news.index');
    }

    /**
     * Удаляем в корзину
     */
    public function destroy($id)
    {
       $news = News::withTrashed()->find($id);
       if ($news->trashed()) {
           $news->forceDelete();
       } else {
           $news->delete();
       }
       return redirect()->route('adfm.news.index');
    }

    /**
     * Создание
     */
    public function restore($id)
    {
        News::withTrashed()->find($id)->restore();
        return redirect()->route('adfm.news.index');
    }

}
