<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {

	Route::match(['get', 'post'], '/', ['uses' =>'IndexController@index', 'as' => 'home']);


	Route::auth();
});

// Admin routes
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

	// admin/
	Route::get('/', function () {

		if (view()->exists('admin.index')) {
			$data = ['title' => 'Панель администратора'];

			return view('admin.index', $data);
		}


	});


	// Pages' manipulation
	Route::group(['prefix' => 'pages'], function (){
		// admin/pages/
		Route::get('/', ['uses' => 'PagesController@index', 'as' => 'pages']);
		// admin/pages/add
		Route::match(['get', 'post'], '/add', ['uses' => 'PagesAddController@index', 'as' => 'pagesAdd']);
		// admin/pages/edit/{id}
		Route::match(['get', 'post', 'delete'], '/edit/{id}', ['uses' => 'PagesEditController@index', 'as' => 'pagesEdit']);
	});


	// Portfolios' manipulation
		Route::group(['prefix' => 'portfolio'], function (){
			// admin/portfolio/
			Route::get('/', ['uses' => 'PortfolioController@index', 'as' => 'portfolio']);
			// admin/portfolio/add
			Route::match(['get', 'post'], '/add', ['uses' => 'PortfolioAddController@index', 'as' => 'portfolioAdd']);
			// admin/portfolio/edit/{id}
			Route::match(['get', 'post', 'delete'], '/edit/{page}', ['uses' => 'PortfolioEditController@index', 'as' => 'portfolioEdit']);
		});

	// Services' manipulation
			Route::group(['prefix' => 'service'], function (){
				// admin/service/
				Route::get('/', ['uses' => 'ServiceController@index', 'as' => 'service']);
				// admin/service/add
				Route::match(['get', 'post'], '/add', ['uses' => 'ServiceAddController@index', 'as' => 'serviceAdd']);
				// admin/service/edit/{id}
				Route::match(['get', 'post', 'delete'], '/edit/{id}', ['uses' => 'ServiceEditController@index', 'as' => 'serviceEdit']);
			});



});


Auth::routes();

Route::get('/home', 'HomeController@index');
