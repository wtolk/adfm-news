<?php

Route::prefix('/admin')->middleware(['web', 'auth'])->namespace('App\AdfmNews\Controllers\Admin')->group(function () {


        Route::get('/news', 'NewsController@index')->name('adfm.news.index');
        Route::get('/news/create', 'NewsController@create')->name('adfm.news.create');
        Route::post('/news', 'NewsController@store')->name('adfm.news.store');
        Route::get('/news/{id}/edit', 'NewsController@edit')->name('adfm.news.edit');
        Route::match(['put', 'patch'],'/news/{id}', 'NewsController@update')->name('adfm.news.update');
        Route::delete('/news/{id}', 'NewsController@destroy')->name('adfm.news.destroy');
        Route::get('/news/{id}/restore', 'NewsController@restore')->name('adfm.news.restore');

});


