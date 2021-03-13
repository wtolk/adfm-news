<?php

namespace App\AdfmNews\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adfm\News;
use Illuminate\Support\Facades\Mail;

class NewsController extends Controller
{

    public function showNewsList()
    {
        $news = News::all();
        return view('adfm::public.news.list', compact('news'));
    }

    public function showNewsPage($year, $month, $day, $slug)
    {
        $news = News::whereYear('published_at', '=', $year)->whereMonth('published_at', '=', $month)
            ->whereDay('published_at', '=', $day)->where('slug', $slug)->firstOrFail();
        return view('adfm::public.news.page', compact('news'));
    }

}
