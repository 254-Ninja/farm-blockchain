<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->post('/login', '\App\Http\Controllers\API\AuthController@login');
    $api->get('/categories', '\App\Http\Controllers\API\ProductController@categories');
    $api->post('/register', '\App\Http\Controllers\API\AuthController@register');
    $api->group(['middleware' => ['auth:api','jwt.auth']], function ($api) {

        $api->get('test', function () {
            return 'It is ok';
        });
        $api->get('/logout', '\App\Http\Controllers\API\AuthController@logout');
        $api->get('/user', '\App\Http\Controllers\API\AuthController@user');

        $api->post('/create_product', '\App\Http\Controllers\API\ProductController@product');
        $api->post('/create_order', '\App\Http\Controllers\API\ProductController@createOrder');
        $api->get('/get_products', '\App\Http\Controllers\API\ProductController@getProducts');
        $api->get('/get_product/{productId}', '\App\Http\Controllers\API\ProductController@oneProduct');
        $api->get('/get_product_barcode/{barcode}', '\App\Http\Controllers\API\ProductController@oneProductBarcode');
        $api->post('/upload_image', '\App\Http\Controllers\API\ProductController@imageUpload');
        $api->post('/rate_product', '\App\Http\Controllers\API\ProductController@rateProduct');
        $api->post('/flag_product', '\App\Http\Controllers\API\ProductController@flagProduct');

        $api->get('/get_farmers', '\App\Http\Controllers\API\AppUsersController@getFarmers');
        $api->get('/get_user/{userId}', '\App\Http\Controllers\API\AppUsersController@oneUser');
        $api->get('/get_pcs', '\App\Http\Controllers\API\AppUsersController@getCompanies');
    });

});
