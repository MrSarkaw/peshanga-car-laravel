<?php

use Illuminate\Support\Facades\Route;
use App\main_sections;
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
    $sections=main_sections::all();
    return view('index',compact('sections'));
});


Route::group(['middleware' => ['web']], function () {
        Route::resource('carsView', 'carsViewController');
            Route::get('search/{name}','carsViewController@indexSearchCars')->name('searchCar');
            Route::get('li/{id}','carsViewController@showLists')->name('li');
            Route::get('weeklyCars','carsViewController@weeklyCars')->name('weeklyCars');
            Route::get('officeCar','carsViewController@officeRentCars')->name('officeCar');
            Route::get('LC/{name}','carsViewController@listACompany')->name('LC');
              Route::get('viewCompany/{cities}','carsViewController@viewCompany')->name('viewCompany');
            //search            
            Route::get('getCompanies/{id}','carsViewController@getCompanies')->name('getCompanies');
            Route::get('getAutomobiles/{id}','carsViewController@getAutomobiles')->name('getAutomobiles');
            Route::get('getModel/{name}','carsViewController@getModel')->name('getModel');
            Route::get('getPrice/{min}/{max}','carsViewController@getPrice')->name('getModel');
                // main search
                Route::get('getMainSearch/{comany}/{nameAuto}','carsViewController@getMainSearch');
                Route::get('mainSearch/{name}','carsViewController@mainSearch');
            //a,er search
            Route::get('getAmer','carsViewController@getAmer');
            Route::get('resultAmer/{id}','carsViewController@showAmer');
            //endsearch
        Route::get('resultCars','carsViewController@ResultSearchCars');
        Route::resource('/ashya', 'ashyaController');
        Route::resource('CR','carReportController');
            Route::get('/froshraw','carReportController@indexFroshraw')->name('froshraw');
            Route::get('/dzraw','carReportController@indexForDzraw')->name('dzraw');
            Route::get('qist','qestShahnController@index')->name('qist');
            Route::get('shahn','qestShahnController@sindex')->name('shahn');

        Auth::routes(['verify' => false,'register'=>false]);
});


Route::group(['middleware' => ['web','auth','IsAdmin']], function () {
    Route::resource('admin', 'Admin\adminController');
        Route::match(['get','post'],'resultSearch','Admin\adminController@resultSearch');
    Route::resource('user', 'UserController');
    Route::resource('company', 'Admin\companyController');
    Route::resource('sections', 'Admin\sectionController');
    Route::resource('cities', 'Admin\citiesController');
    Route::resource('ashyaAdmin', 'Admin\ashyaAdminController');
    Route::resource('sponser', 'Admin\sponserController');
    Route::resource('office', 'Admin\officeController');
    Route::resource('qestShahn', 'Admin\qestShahnController');
});


Route::group(['middleware' => ['web','auth']], function () {
    Route::group(['middleware' => ['IsNormalUser']], function () {
         Route::resource('nAdmin', 'normalUser\normalUserController');
         Route::patch('/infoUpdate','normalUser\normalUserController@infoUpdate')->name('infoUpdate');
         Route::resource('amer','normalUser\amerController');
    });
   
    Route::resource('raport','normalUser\reportFroshtnController');
});



Route::get('/home', 'HomeController@index')->name('home');
