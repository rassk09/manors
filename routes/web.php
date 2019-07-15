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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'namespace'  => 'Admin', 'middleware' => ['admin']], function () {
    /******************************************
     * CUSTOM ADMIN PAGES
     ******************************************/

    Route::get('/', 'DashboardController@index')->name('admin_dashboard');
    Route::get('tests_pages', 'CustomController@testPages')->name('admin_tests_pages');
    Route::get('positions', 'CustomController@homePositions')->name('admin_positions');
    Route::get('translations/model/TestQuestion/{code}/{id}/edit', 'TranslationsController@editTestQuestions')->name('admin_translations_test_questions_edit_page');
    Route::get('settings', 'CustomController@settings')->name('admin_settings');
    Route::post('settings', 'CustomController@settingsStore')->name('admin_settings_store');

    /******************************************
     * LOCALISATION + TRANSLATIONS
     ******************************************/

    Route::get('translations', 'TranslationsController@index')->name('admin_translations_index');
    Route::get('translations/createCode', 'TranslationsController@createCode')->name('admin_translations_create_page');
    Route::post('translations/createCode', 'TranslationsController@storeCode')->name('admin_translations_store');
    Route::get('translations/{id}/editCode', 'TranslationsController@editCode')->name('admin_translations_edit_page');
    Route::put('translations/{id}/editCode', 'TranslationsController@updateCode')->name('admin_translations_update');
    Route::get('translations/{id}/deleteCode', 'TranslationsController@destroyCode')->name('admin_translations_destroy');
    Route::get('translations/model/{module}/{code}/{id}/edit', 'TranslationsController@editModule')->name('admin_translations_module_edit_page');
    Route::post('translations/model/{module}/{code}/{id}/edit', 'TranslationsController@updateModule')->name('admin_translations_module_update');

    /******************************************
     * MODULE PAGES AND ACTIONS
     ******************************************/

    Route::group(['prefix' => '{module}'], function () {
        Route::get('/', 'AdminController@index')->name('admin_module_index');
        Route::get('create', 'AdminController@create')->name('admin_module_create_page');
        Route::post('/', 'AdminController@store')->name('admin_module_store');
//        Route::get('{id}', 'AdminController@show')->name('admin_module_show_page');
        Route::get('{id}/edit', 'AdminController@edit')->name('admin_module_edit_page');
        Route::put('{id}', 'AdminController@update')->name('admin_module_update');
        Route::get('{id}/delete', 'AdminController@destroy')->name('admin_module_destroy');
        Route::get('{id}/active', 'AdminController@active')->name('admin_module_active');
        Route::post('massive/delete', 'AdminController@massive_destroy')->name('admin_module_massive_destroy');

        Route::get('{id}/custom/{action}', 'AdminController@custom_form')->name('admin_module_custom_form');
        Route::post('{id}/custom/{action}', 'AdminController@custom_form_handler')->name('admin_module_custom_form_handler');
        Route::put('{id}/custom/{action}', 'AdminController@custom_form_handler')->name('admin_module_custom_form_handler');
//        Route::get('custom/{action}', 'AdminController@custom_page')->name('admin_module_custom_page');
        Route::get('export/{type}', 'AdminController@export')->name('admin_module_export');
    });

    /******************************************
     * ADMIN API
     ******************************************/

    Route::group(['prefix' => 'api'], function () {
        Route::post('manor/upload/image', 'ApiController@uploadManorImage');
        Route::get('users/all', 'ApiController@getAllUsers');

//        Route::post('events/upload/image', 'ApiController@uploadEventImage');
//        Route::get('events/{id}/members', 'ApiController@getEventMembers');
//        Route::post('events/{id}/status', 'ApiController@changeEventStatus');
//        Route::get('events/covers', 'ApiController@getAllEventCovers');
//
//        Route::get('event/{id}/photos', 'ApiController@getEventPhotos');
//        Route::get('event/{id}/photos/{image}/delete', 'ApiController@deleteEventPhotos');
//
//        Route::get('event_formats', 'ApiController@getEventFormat')->name('admin_get_event_format');
//        Route::get('event_formats/{id}/images', 'ApiController@getEventFormatImages');
//        Route::get('event_formats/{id}/images/{image}/delete', 'ApiController@deleteEventFormatImages');
//
//        Route::get('event_types/{id}/images', 'ApiController@getEventTypeImages');
//        Route::get('event_types/{id}/images/{image}/delete', 'ApiController@deleteEventTypeImages');
//
//
//        Route::post('tests/question/upload/image', 'ApiController@uploadTestQuestionImage');
//        Route::post('tests/question', 'ApiController@createOrEditTestQuestion');
//        Route::get('tests/question/delete', 'ApiController@deleteTestQuestion');
//        Route::post('tests/question/positions', 'ApiController@positionTestQuestion');
//        Route::get('tests/question/answers', 'ApiController@getTestAnswers');
//        Route::post('tests/question/answers', 'ApiController@editTestAnswers');
//
//        Route::get('tests/results', 'ApiController@getTestResults');
//        Route::get('tests/results/get', 'ApiController@getTestResult');
//        Route::post('tests/results', 'ApiController@createOrUpdateTestResult');
//        Route::get('tests/results/delete', 'ApiController@deleteTestResult');
//
//        Route::post('tests/pages/store', 'ApiController@storeTestsPages');
//        Route::post('tests/pages/update', 'ApiController@updateTestsPages');
//        Route::post('tests/pages/add', 'ApiController@addTestsPages');
//        Route::post('tests/pages/reset', 'ApiController@resetTestsPages');
//        Route::post('tests/pages/delete', 'ApiController@deleteTestsPages');
//
//        Route::post('documents/upload/file', 'ApiController@uploadDocumentsFile');
//
//        Route::post('beauty_books/upload/image', 'ApiController@uploadBeautyBooksImage');
//        Route::post('materials/upload/image', 'ApiController@uploadMaterialsImage');
//
//        Route::get('positions', 'ApiController@getPositions');
//        Route::post('positions', 'ApiController@addPositions');
//        Route::post('positions/delete', 'ApiController@deletePosition');
//        Route::post('positions/position', 'ApiController@positionPositions');
//        Route::post('positions/additional', 'ApiController@additionalPositions');
//        Route::post('positions/crop', 'ApiController@cropPositions');
//        Route::post('positions/publish', 'ApiController@publishPosition');
//        Route::post('positions/reset', 'ApiController@resetPosition');
//
//        Route::get('materials', 'ApiController@getAllMaterials');
//
//        Route::post('settings/upload/image', 'ApiController@uploadSettingImage');
    });
});

/******************************************
 * LOGIN/LOGOUT
 ******************************************/

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
