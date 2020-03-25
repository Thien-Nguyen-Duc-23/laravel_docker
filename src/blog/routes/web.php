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

Route::group(['prefix' => 'adminpanel', 'namespace' => 'Admin'], function () {
    Route::get('login', 'LoginController@index')->name('admin.login.index');
    Route::post('login', 'LoginController@submitLogin')->name('admin.login.submit');
    Route::get('logout', 'LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::resource('users', 'AccountController');
        Route::post('users/banActive', 'AjaxController@updateStatusUser')->name('updateStatus');
        Route::resource('contacts-admin', 'ContactController');
        Route::post('contacts/accept', 'AjaxController@acceptContact')->name('contacts.accept');
        Route::resource('categories', 'CategoryController');
        Route::resource('books', 'BookController');
        Route::group(['middleware' => 'super_admin'], function () {
            Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
            Route::get('maintenances', 'MaintenanceController@index')->name('maintenances.index');
            Route::post('maintenances', 'MaintenanceController@maintenance')->name('maintenances.change_mode');
            Route::get('dashboard/userFollowBook/{id}', 'AjaxController@getUserFollowOfBook')->name('admin.user_follow_book');
        });
        Route::resource('comments', 'CommentController');
        Route::post('comments/accept', 'AjaxController@acceptComment')->name('comments.accept');
        Route::get('profile', 'ProfileController@index')->name('admin.profile_index');
        Route::post('changePassword', 'ProfileController@changePassword')->name('admin.change_password');
        Route::get('notification/{id}', 'NotificationController@show')->name('mark_a_read');
        Route::get('notification/mark_all/{accountId}', 'NotificationController@markAll')->name('mark_all_read');
        Route::post('books/accept', 'AjaxController@acceptBook')->name('books.accept');
    });
});

Route::group(['prefix' => '/', 'namespace' => 'Client', 'middleware' => ['locale', 'checkSession']], function () {
    Route::get('change-language/{language}', 'LanguageController@changeLanguage')->name('user.change_language');
    Route::resource('/', 'ClientController');
    Route::resource('/register', 'RegisterController');
    Route::get('user/activation/{token}', 'RegisterController@activateUser')->name('account.activate');
    Route::resource('contacts', 'ContactController');
    Route::group(['prefix' => '/category'], function () {
        Route::get('/{slug}', 'CategoryController@index')->name('client.category.index');
        Route::get('/{slug}/{childSlug}', 'CategoryController@childCategory')->name('client.category.child_category');
    });
    Route::get('/redirect', 'SocialAuthController@redirect')->name('redirect');
    Route::get('/callback', 'SocialAuthController@callback');
    Route::get('login', 'LoginController@indexLogin')->name('login.index');
    Route::post('login', 'LoginController@loginClient')->name('client.login');
    Route::get('logout', 'LoginController@logoutClient')->name('client.logout');
    Route::group(['middleware' => 'filter'], function () {
        Route::resource('book', 'BookController');
    });
    Route::get('find', 'SearchController@find');
    Route::get('search', 'SearchController@index')->name('search.index');
    Route::group(['middleware' => 'client'], function () {
        Route::resource('bookmark', 'BookmartController');
        Route::post('rate', 'RatingCommentController@rate')->name('book.rate');
        Route::get('rate', 'RatingCommentController@rateIndex');
        Route::post('comment', 'RatingCommentController@comment')->name('book.comment');
        Route::get('comment', 'RatingCommentController@commentIndex');
        Route::get('profile', 'ClientProfileController@index')->name('profile.index');
        Route::post('profile', 'ClientProfileController@editAccount')->name('profile.edit');
        Route::post('change-password', 'ClientProfileController@changePassword')->name('profile.change_password');
    });
    Route::post('follow', 'AjaxFollowController@follow')->name('store.index');
    Route::delete('unfollow/{id}/{book_id}', 'AjaxFollowController@unfollow')->name('delete.index');
});
