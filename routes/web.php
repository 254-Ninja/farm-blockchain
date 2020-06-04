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
Auth::routes();

Route::get('home', function (){
    return redirect()->route('dashboard');
})->name('home');

// Route::get('/', function () {return view('welcome');});
Route::group(['middleware'=>'auth'], function (){
    /* Dashboard */
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    /* products */
    Route::resource('product_category','ProductcategoriesController');
    Route::resource('product','ProductController');
    Route::get('product/verify/{product}',['as'=>'product/verify','uses'=>'ProductController@verify']);

    /* certificates */
    Route::resource('certificate','CertificateController');
    Route::get('certificate/verify/{certificate}',['as'=>'certificate/verify','uses'=>'CertificateController@verify']);

    /* users */
    Route::resource('users','UsersController');
    Route::get('farmers','UsersController@farmers')->name('farmers');
    Route::get('farmer/{id}',['as'=>'farmer.show','uses'=>'UsersController@farmerShow']);

    Route::get('processingcompanies','UsersController@processingCompanies')->name('processingcompanies');
    Route::get('processingcompany/{id}',['as'=>'processingcompany.show','uses'=>'UsersController@processingcompanyShow']);


    Route::get('user/verify/{user}',['as'=>'user/verify','uses'=>'UsersController@verify']);
    Route::get('profile/view','UsersController@profile')->name('profile/view');
    Route::get('profile/edit','UsersController@editProfile')->name('profile/edit');
    Route::post('profile/update','UsersController@updateProfile')->name('profile/update');

    /* Blacklist */
    Route::get('blacklist/users','UsersController@userBlacklist')->name('blacklist/users');
    Route::get('blacklist/user/{id}',['as'=>'blacklist/user','uses'=>'UsersController@blacklistUser']);

    Route::get('blacklist/products','ProductController@productBlacklist')->name('blacklist/products');
    Route::get('blacklist/{id}/documents',['as'=>'blacklist.documents','uses'=>'DocumentController@blacklistDocuments']);
    Route::get('blacklist/documents','DocumentController@blacklists')->name('blacklist.index');
    Route::post('blacklist/documents/upload','DocumentController@uploadFile')->name('blacklist/documents/upload');

    Route::get('blacklist/product/{id}',['as'=>'blacklist/product','uses'=>'ProductController@blacklistProduct']);


    Route::get('/logout', 'DashboardController@logout')->name('logout');
});

Route::get('/', function () { return redirect('dashboard'); });
