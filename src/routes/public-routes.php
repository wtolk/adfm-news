<?php

Route::group(['namespace' => 'App\AdfmNews\Controllers\Site'], function () {
    Route::get('/news/list', 'NewsController@showNewsList')->name('adfm.show.news-list');
    Route::get('/news/{year}/{month}/{day}/{slug}', 'NewsController@showNewsPage')->name('adfm.show.news-page');
});

