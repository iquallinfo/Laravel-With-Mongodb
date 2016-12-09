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

Route::get('/', 'HomeController@index');
Route::get('/register', 'UserController@register');
Route::post('/register', 'UserController@getregister');
Route::post('/checkemail', 'UserController@checkemail');
Route::get('/aboutus', 'HomeController@aboutus');
Route::get('/contactus', 'HomeController@contactus');

Route::get('/login', 'UserController@login');
Route::post('/login', 'UserController@getlogin');
Route::get('/logout', 'UserController@logout');


Route::get('/products/allproducts', 'ProductController@allproducts');
Route::get('/products/{owner}/{slug}', 'ProductController@productdetail');
Route::get('/category/{category}', 'ProductController@categoryproduct');
Route::get('/products/owner/{owner}/{category}', 'ProductController@ownerproducts');
Route::get('/products/search', 'ProductController@search');

Route::get('/companies/', 'CompaniesController@companies');

Route::get('/blogs', 'BlogsController@index');
Route::get('/blog/{userid}/{slug}', 'BlogsController@blogdetail');


/* Dashboard Routes */

Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/editaccount', 'UserController@account');
Route::post('/dashboard/editaccount/{id}', 'UserController@editaccount');
Route::get('/dashboard/profileimage', 'UserController@profileimage');
Route::post('/dashboard/profileimage/', 'UserController@setprofileimage');
Route::get('/country', 'UserController@countries');
Route::get('/users', 'UserController@users');

/* Products related url */

Route::get('/dashboard/products', 'DashboardController@products');
Route::get('/dashboard/addproduct', 'DashboardController@addproduct');
Route::post('/dashboard/addproduct', 'DashboardController@insertproduct');
Route::get('/dashboard/editproduct/{id}', 'DashboardController@editproduct');
Route::post('/dashboard/editproduct/{id}', 'DashboardController@updateproduct');
Route::get('/dashboard/deleteproduct/{id}', 'DashboardController@deleteproduct');
Route::get('/dashboard/productimage/{id}', 'DashboardController@productimage');
Route::post('/dashboard/productimage/{id}', 'DashboardController@setproductimage');

/* Blog related url */

Route::get('/dashboard/blogs', 'DashboardController@blogs');
Route::get('/dashboard/addblog', 'DashboardController@addblog');
Route::post('/dashboard/addblog', 'DashboardController@insertblog');
Route::get('/dashboard/editblog/{id}', 'DashboardController@editblog');
Route::post('/dashboard/editblog/{id}', 'DashboardController@updateblog');
Route::get('/dashboard/deleteblog/{id}', 'DashboardController@deleteblog');
Route::get('/dashboard/blogimage/{id}', 'DashboardController@blogimage');
Route::post('/dashboard/blogimage/{id}', 'DashboardController@setblogimage');



