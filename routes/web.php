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

$router->get('/api', 'rentalController@index');
$router->get('/inputTransaction', 'rentalController@inputTransaction');

$router->post('/api/tambahCollection', 'rentalController@insert');

$router->post('api/{id}/updateCollection', 'rentalController@update');

$router->post('api/{id}/delete', 'rentalController@delete');