<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

//
//Route::auth();
//
//Route::get('/home', 'HomeController@index');
//
//
//
Route::group(['middleware'=>'admin'], function(){

    Route::get('/admin', 'AdminController@index');

    Route::resource('admin/users', 'AdminUsersController', ['names'=>[
        'index'=>'admin.users.index',
        'create'=>'admin.users.create',
        'store'=>'admin.users.store',
        'edit'=>'admin.users.edit',
        'show'=>'admin.users.show',
        'update'=>'admin.users.update',
        'destroy'=>'admin.users.destroy',

    ]]);
Route::get('/post/{id}', ['as'=>'home.post','uses'=>'HomeController@post']);

    Route::resource('admin/posts', 'AdminPostsController', ['names'=>[
        'index'=>'admin.posts.index',
        'create'=>'admin.posts.create',
        'store'=>'admin.posts.store',
        'edit'=>'admin.posts.edit',
        'update'=>'admin.posts.update',
        'destroy'=>'admin.posts.destroy',

    ]]);

    Route::resource('admin/categories', 'AdminCategoriesController', ['names'=>[
        'index'=>'admin.categories.index',
        'store'=>'admin.categories.store',
        'edit'=>'admin.categories.edit',
        'update'=>'admin.categories.update',
        'destroy'=>'admin.categories.destroy',

    ]]);

    Route::resource('admin/media', 'AdminMediasController', ['names'=>[
        'index'=>'admin.media.index',
        'create'=>'admin.media.create',
        'store'=>'admin.media.store',
        'edit'=>'admin.media.edit',
        'destroy'=>'admin.media.destroy',

    ]]);
Route::delete('admin/delete/media', 'AdminMediasController@deleteMedia');

    Route::resource('admin/comments', 'PostCommentsController', ['names'=>[
        'index'=>'admin.comments.index',
        'store'=>'admin.comments.store',
        'show'=>'admin.comments.show',
        'update'=>'admin.comments.update',
        'destroy'=>'admin.comments.destroy',

    ]]);

    Route::resource('admin/comment/replies', 'CommentRepliesController', ['names'=>[
        'show'=>'admin.comment.replies.show',
        'createReply'=>'admin.comment.replies.createReply',
        'update'=>'admin.replies.update',
        'destroy'=>'admin.replies.destroy',

    ]]);
});
Route::group(['middleware'=>'auth'], function(){

    Route::post('comment/reply', 'CommentRepliesController@createReply');

});


