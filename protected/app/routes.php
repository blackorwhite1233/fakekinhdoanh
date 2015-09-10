<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* Code Improvment By  mailbeez */
if (defined('CNF_MULTILANG')) {
    $lang = (Session::get('lang') != "" ? Session::get('lang') : CNF_LANG);
    App::setLocale($lang);
}
/* End Improvment mailbeez */

Route::controller('user', 'UserController');
//Route::get('category/{alias}-{id}-{page}.html', 'HomeController@categorydetail')->where(array('alias' => '(.*)','id'=>'[0-9]+','page'=>'[0-9]+'));
//Route::get('category/{alias}-{id}.html', 'HomeController@categorydetail')->where(array('alias' => '(.*)','id'=>'[0-9]+'));
//Route::get('detail/{alias}-{id}.html', 'HomeController@productdetail')->where(array('alias' => '(.*)','id'=>'[0-9]+'));
//Route::get('search.html', 'HomeController@search');
//Route::get('checkout.html', 'HomeController@checkout');
Route::get('san-pham/{alias}-{id}.html', 'HomeController@detailpost')->where(array('alias' => '(.*)','id'=>'[0-9]+'));
Route::get('thong-bao.html', 'HomeController@thongbao');
Route::get('tin-moi-dang.html', 'HomeController@tinmoi');
Route::get('hanh-khach.html', 'HomeController@hanhkhach');
Route::get('tai-xe.html', 'HomeController@taixe');
Route::get('tinh-thanh.html', 'HomeController@tinhthanh');
Route::get('dang-ky.html', 'HomeController@dangky');
Route::get('dang-san-pham.html', 'HomeController@dangtin');
Route::get('thong-tin-thanh-vien.html', 'HomeController@thongtinthanhvien');
Route::get('san-pham-da-dang.html', 'HomeController@tindadang');
Route::get('contact-us.html', 'HomeController@contactus');
Route::get('forgotpass.html', 'HomeController@forgotpass');
Route::get('change-info.html', 'HomeController@changeinfo');
Route::get('change-pass.html', 'HomeController@changepass');
Route::get('/', 'HomeController@index');
Route::controller('home', 'HomeController');
Route::controller('ward', 'WardController');
Route::controller('blog', 'BlogController');
Route::controller('authen', 'AuthenController');
include('pageroutes.php');
Route::group(array('before' => 'auth'), function() 
{
	/* CORE APPLICATION DONT DELETE IT */
	Route::controller('customer', 'CustomerController');
	Route::controller('pages', 'PagesController');
	Route::controller('users', 'UsersController');
	Route::controller('groups', 'GroupsController');
	Route::controller('menu', 'MenuController');
	Route::controller('dashboard', 'DashboardController');
	if(Session::get('gid') == '1'  || Session::get('gid') == '2')
	{
		Route::controller('module', 'ModuleController');
		Route::controller('config', 'ConfigController');
	}
	if(Session::get('gid') == '1' || Session::get('gid') == '2'){
		Route::controller('permission', 'PermissionController');
	}
	Route::controller('logs', 'LogsController');
	Route::controller('blogadmin', 'BlogadminController');
	Route::controller('blogcategories', 'BlogcategoriesController');
	Route::controller('blogcomment', 'BlogcommentController');
	Route::controller('nproducts', 'NproductsController');
	Route::controller('Nproducts', 'NproductsController');
	Route::controller('Ncategories', 'NcategoriesController');
	/* END CORE APPLICATION  */
	
	/* Dynamic Routers */
	include('moduleroutes.php');
});	
