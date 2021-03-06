<?php

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function (){
    return view('welcome');
});

Route::post('settings/{minAge}/{maxAge}', 'SettingsController@filterAge');

Auth::routes();

Route::post('match/{user}/{type}', 'MatchController@affection');

Route::post('/pictures', 'PicturesController@store');
Route::delete('/picture/delete/{id}', 'PicturesController@delete');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/update', 'ProfilesController@update')->name('profile.update');

Route::get('/profiles/show', 'MatchController@show')->name('profiles.show');
