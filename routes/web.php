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


Route::group(
    ['prefix' => 'admin'],
    function () {
        //Route name must be login or it doesn't work!
        Route::get(
            'admin_users/session/login',
            ['as' => 'login', 'uses' => 'AdminUsersController@getLogin']
        );
        Route::post(
            'admin_users/session/login',
            ['as' => 'session.postLogin', 'uses' => 'AdminUsersController@postLogin']
        );
    }
);


Route::group(
    ['prefix' => 'admin', 'middleware'=>'auth'],
    function () {
        Route::get('dashboard', 'DashboardController@showDashboard')->name('showDashboard');
        Route::resource('users', 'UsersController');
        Route::resource('contact', 'ContactController');
        Route::resource('news_feeds', 'NewsFeedsController');
        Route::resource('admin_users', 'AdminUsersController');

        Route::get('users/{id}/activate',['as'=>'users.activate', 'uses'=>'UsersController@activateUser']);

        Route::post(
            'admin_users/create',
            ['as' => 'admin_users.register', 'uses' => 'AdminUsersController@store']
        );

        Route::get(
            'admin_users/session/logout',
            ['as' => 'session.getLogout', 'uses' => 'AdminUsersController@getLogout']
        );

        Route::post(
            'news_feeds/create',
            ['as' => 'news_feeds.create', 'uses' => 'NewsFeedsController@store']
        );

        Route::get(
            'news_feeds/delete/{news_feed}',
            ['as' => 'news_feeds.delete', 'uses' => 'NewsFeedsController@destroy']
        );

        Route::get('/chat', 'SupportChatController@index')->name('showChat');
        Route::get('/chat/messages', 'SupportChatController@fetchMessagesForConversationId')
            ->name('fetchMessagesForConversationId')
        ;
        Route::get('/test', 'SupportChatController@test');
    }
);

