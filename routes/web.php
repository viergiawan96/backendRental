<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

//collection
$router->get('/api/collection', 'rentalController@index');
$router->post('/api/addCollection', 'rentalController@insert');
$router->post('api/updateCollection', 'rentalController@update');
$router->get('api/{id}/delete', 'rentalController@delete');


//transaksi
$router->get('api/transaction','transactionController@index');
$router->post('api/addTransaction','transactionController@insertTransaction');
$router->post('api/checkAmount','transactionController@checkAmount');
$router->post('api/payTransaction','transactionController@payTransaction');