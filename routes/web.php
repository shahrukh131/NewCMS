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

use App\Http\Controllers\Blog\PostsController;

Route::get('/', 'WelcomeController@index');
Route::get('blog/posts/{post}', [PostsController::class, 'show'])->name('blog.show');

Auth::routes();

Route::resource('catagories', 'CatagoriesController');
Route::resource('posts', 'PostsController')->middleware('auth');
Route::resource('tags', 'TagsController');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');
Route::put('restore-post/{post}', 'PostsController@restore')->name('restore-posts');
Route::get('users', 'UsersController@index')->name('users.index');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');
    Route::put('users/profile', 'UsersController@update')->name('users.update-profile');
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
});
