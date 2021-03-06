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

// (M01) Athentication and Individual Profile


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@authenticate');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('users', 'ProjectController@list'); //view user page
Route::delete('users/{id}', 'UserController@delete');
Route::get('users/{id}/profile', 'UserController@show'); //view user profile
Route::get('users/{id}/update', 'UserController@edit')->name('update'); //user edit profile form
Route::post('users/{id}/update', 'UserController@update'); //user update profile form
Route::get('recoverPassword', 'Auth\LoginController@forgotPassword')->name('recoverPassword'); //recover password form
Route::post('recoverPassword', 'Auth\LoginController@recoverPassword'); //recover password action
Route::get('resetPassword/{token}', 'Auth\LoginController@showResetPassword'); //reset password form
Route::post('resetPassword', 'Auth\LoginController@resetPassword')->name('resetPassword'); //reset password action
Route::post('api/users', 'UserController@search'); //search users API
Route::post('api/users/{id}/uploadImage', 'UserController@uploadImage'); //search users API



// (M02) Project
Route::post('api/projects', 'ProjectController@search');
Route::post('projects', 'ProjectController@create'); //create a project
Route::get('projects', 'ProjectController@showCreate'); //creation page

Route::get('projects/{id}', 'ProjectController@show'); //project page
Route::delete('projects/{id}', 'ProjectController@delete'); //delete project

Route::get('projects/{id}/details', 'ProjectController@details');

Route::get('projects/{id}/edit', 'ProjectController@editShow'); //show edit page
Route::post('projects/{id}/edit', 'ProjectController@edit'); //edit page

Route::post('/api/projects/{id}/favourite', 'ProjectController@favourite');
Route::post('/api/projects/{id}/archive', 'ProjectController@archive');
Route::delete('/api/projects/{id}/decreaseParticipation', 'ProjectController@decreaseParticipation');
Route::post('api/projects/addCoordinator', 'ProjectController@addCoordinator');

// (M03) Tasks, Comments and Labels
Route::post('api/tasks', 'TaskController@search'); //get tasks
Route::get('projects/{project_id}/tasks', 'TaskController@showCreate'); //task page
Route::post('tasks', 'TaskController@create'); //creation task page
Route::get('tasks/{id}', 'TaskController@show'); //task page
Route::get('tasks/{id}/edit', 'TaskController@editShow'); //task edit page
Route::post('tasks/{id}/edit', 'TaskController@edit'); //edit task
Route::post('tasks/{id}/complete', 'TaskController@complete'); //complete task
Route::post('tasks/{id}/clone', 'TaskController@clone'); //complete task
Route::post('comments', 'TaskCommentController@create'); //create task comment



// (M04) Forum and Labels
Route::post('labels', 'LabelController@create'); //create label
Route::post('labels/assign', 'LabelController@assignToTask'); //create label
Route::delete('labels/{id}', 'LabelController@delete'); //delete label
Route::delete('tasks/labels/{id}', 'LabelController@deleteFromTask'); //delete label
Route::post('messages', 'ForumMessageController@create'); //create a message


// (M05) Invites and Notifications
Route::post('api/invites/search', 'InviteController@search'); //search for invites
Route::post('api/invites', 'InviteController@create'); //create invite
Route::post('api/invites/{id}/accept', 'InviteController@accept'); //accept invite
Route::delete('api/invites/{id}','InviteController@delete'); // delete invite
Route::get('users/{id}/notifications', 'NotificationController@showNotifications');
Route::post('users/{id}/notifications', 'NotificationController@seen');

// (M06) Administration
Route::get('admin/projects', 'AdminController@showProjects'); //admin page
Route::get('admin', 'AdminController@showUsers'); //admin page
Route::post('/api/block/{user_id}', 'AdminController@block'); // block user

// // (M07) Static Pages
Route::get('/', 'NonAuthController@showHome'); //see home page
Route::get('about', 'NonAuthController@showAbout'); //see about page
Route::get('contact', 'NonAuthController@showContact'); //see contact page
Route::post('contact/sendEmail','NonAuthController@sendEmail');
Route::get('services', 'NonAuthController@showService'); //see services
Route::get('blocked', 'NonAuthController@showBlocked'); //see services

