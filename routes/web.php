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

Route::get('/', 'WelcomeController@showWelcomePage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('dashboard/{user}', 'DashboardController@show' )->name('dashboard.show');
Route::get('profiles', 'UserController@profiles' )->name('profiles');

require_once('webUsers.php');
require_once('webMe.php');
require_once('webAccounts.php');
require_once('webMovements.php');
require_once('webDocuments.php');
