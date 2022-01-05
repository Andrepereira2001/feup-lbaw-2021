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
// Route::post('recoverPassword', 'Auth\UserController@'); //recover password action
// Route::get('resetPassword', 'Auth\UserController@'); //reset password form
// Route::post('resetPassword', 'Auth\UserController@'); //reset password action
Route::post('api/users', 'UserController@search'); //search users API


// (M02) Project
//Route::get('api/projects', 'ProjectController@search');
Route::post('projects', 'ProjectController@create'); //create a project
Route::get('projects', 'ProjectController@showCreate'); //creation page

Route::get('projects/{id}', 'ProjectController@show'); //project page
Route::delete('projects/{id}', 'ProjectController@delete'); //delete project

Route::get('projects/{id}/details', 'ProjectController@details');

// Route::get('projects/{id}', 'ProjectController@list'); //user's projects
Route::get('projects/{id}/edit', 'ProjectController@editShow'); //show edit page
Route::post('projects/{id}/edit', 'ProjectController@edit'); //edit page

Route::post('/api/projects/{id}/favourite', 'ProjectController@favourite');
Route::delete('/api/projects/{id}/leave', 'ProjectController@leave');
Route::delete('/api/projects/{id}/removeParticipation', 'ProjectController@removeParticipation');

Route::post('api/projects/addCoordinator', 'ProjectController@addCoordinator');

// (M03) Tasks, Comments and Labels
Route::post('api/tasks', 'TaskController@search'); //get tasks
// Route::get('tasks', 'TaskController@'); //creation task page
Route::get('projects/{project_id}/tasks', 'TaskController@showCreate'); //task page
Route::post('tasks', 'TaskController@create'); //creation task page
Route::get('tasks/{id}', 'TaskController@show'); //task page
Route::get('tasks/{id}/edit', 'TaskController@editShow'); //task edit page
Route::post('tasks/{id}/edit', 'TaskController@edit'); //edit task
Route::post('tasks/{id}/complete', 'TaskController@complete'); //complete task
Route::post('tasks/{id}/clone', 'TaskController@clone'); //complete task
// Route::get('api/comments', 'CommentController@'); //get comments
// Route::get('comments', 'CommentController@'); //create task comment page
// Route::post('comments', 'CommentController@create'); //create task comment
// Route::post('comments/{id}', 'CommentController@'); //edit task comment
// Route::delete('comments/{id}', 'CommentController@delete'); //delete task comment
// Route::get('api/labels', 'LabelController@'); //get labels
// Route::get('labels', 'LabelController@'); //create label page
// Route::post('labels', 'LabelController@create'); //create label
// Route::post('labels/{id}', 'LabelController@'); //edit label
// Route::delete('labels/{id}', 'LabelController@delete'); //delete label
// Route::post('tasks/labels', 'LabelController@'); //edit label view if controller is right
// Route::delete('tasks/labels', 'LabelController@delete'); //delete label



// (M04) Forum
// Route::get('api/messages', 'ForumController@search'); //get message
// Route::post('messages', 'ForumController@create'); //create a message
// Route::get('messages', 'ForumController@show'); //creation page
// Route::post('messages/{id}', 'ForumController@edit'); //edit message
// Route::delete('messages/{id}', 'ForumController@delete'); // delete meeage


// (M05) Invites and Notifications
// Route::get('api/invites', 'InviteController@search'); //search for invites
Route::post('api/invites', 'InviteController@create'); //create invite
// Route::post('api/invites/accept/{id}', 'InviteController@accept'); //accept invite
// Route::post('api/invites/reject/{id}', 'InviteController@reject'); //reject invite
// Route::get('api/notifications', 'NotificationController@search'); //search notifications
// Route::post('api/notifications/{user_id}/{notification_id}', 'NotificationController@show'); //see notification



// (M06) Administration
Route::get('admin/projects', 'AdminController@showProjects'); //admin page
Route::get('admin', 'AdminController@showUsers'); //admin page
// Route::delete('/users/{id}', 'AdminController@deleteUser'); //admin page
// Route::post('/api/block/{user_id}', 'AdminController@block'); // block user
// Route::post('/api/unblock/{user_id}', 'AdminController@unblock'); // unblock user

// // (M07) Static Pages
Route::get('/', 'NonAuthController@showHome'); //see home page
Route::get('about', 'NonAuthController@showAbout'); //see about page
Route::get('contact', 'NonAuthController@showContact'); //see contact page
Route::post('contact','NonAuthController@sendEmail');
Route::get('services', 'NonAuthController@showService'); //see services
// Route::get('404', 'NonAuthController@'); //see error page
