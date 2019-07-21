<?php

Route::apiResource('/question', 'QuestionController');
Route::apiResource('/category', 'CategoryController');
Route::apiResource('/question/{question}/reply', 'ReplyController');

Route::post('/like/{reply}', 'LikeController@likeIt');
Route::delete('/like/{reply}', 'LikeController@unLikeIt');

// Route::post('/notifications', function(){
//   // readNotifications adalah defaul bawaan dari model user dengan nama   use Notifiable lalu use HasDatabaseNotifications nah didalam sana ada functions read and unread notifications
//   return [
//     'read' => auth()->user()->readNotifications()->get(),
//     'unread' => auth()->user()->unreadNotifications()->get(),
//   ];
// });

Route::post('/notifications', 'NotificationController@index');
Route::post('/markAsRead', 'NotificationController@markAsRead');



Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
