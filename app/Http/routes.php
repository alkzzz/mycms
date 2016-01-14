<?php
#BackEnd
Route::group(['as' => 'dashboard::', 'middleware' => ['role:administrator']], function () {
		Route::get('dashboard',['as'=>'home', 'uses'=>'DashboardController@index']);
		Route::get('dashboard/menu',['as'=>'menu', 'uses'=>'PageController@daftarmenu']);
		Route::post('dashboard/menu',['as'=>'urutMenu', 'uses'=>'PageController@urutMenu']);
		Route::get('dashboard/menu/tambah',['as'=>'addPage', 'uses'=>'PageController@addPage']);
		Route::post('dashboard/menu/simpan',['as'=>'storePage', 'uses'=>'PageController@storePage']);
		Route::get('dashboard/menu/{slug}/edit',['as'=>'editPage', 'uses'=>'PageController@editPage']);
		Route::get('dashboard/menu/tambah/{slug}/submenu',['as'=>'addSubmenu', 'uses'=>'PageController@addSubmenu']);
		Route::post('dashboard/menu/simpan/{slug}/submenu',['as'=>'storeSubmenu', 'uses'=>'PageController@storeSubmenu']);
		Route::patch('dashboard/menu/{slug}/update',['as'=>'updatePage', 'uses'=>'PageController@updatePage']);
		Route::get('dashboard/menu/{slug}/delete',['as'=>'showDeletePage', 'uses'=>'PageController@showDeletePage']);
		Route::delete('dashboard/menu/{slug}/delete',['as'=>'deletePage', 'uses'=>'PageController@deletePage']);
});

Route::get('get/chart', ['as'=>'getChartData', 'uses'=>'HomeController@getChartData']);
Route::get('chart', 'HomeController@chart');
#Auth
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', ['as'=>'login','uses'=>'Auth\AuthController@postLogin']);
Route::get('logout', 'Auth\AuthController@getLogout');

Route::get('dashboard/data.user', ['as'=>'datatables.user', 'uses'=>'DashboardController@postDataUser']);
Route::get('dashboard/user', ['as'=>'daftar.user' ,'uses'=>'DashboardController@daftarUser']);

#FrontEnd
Route::group(['prefix' => Localization::setLocale(), 'middleware' => ['localize'] ], function()
{
    Route::get('/', ['as'=>'homepage', 'uses'=>'HomeController@index']);
    Route::get('{menu}', ['as'=>'show.page', 'uses'=>'PageController@showPage']);
		Route::get('{kategori}/{post}', ['as'=>'show.post', 'uses'=>'PostController@showPost']);
});
