<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'cow'], function() use ($router) {
    
    $router->get('get/{earring}', 'CowController@getCow');

    $router->post('post', 'CowController@postCow');

    $router->put('put/{earring}', 'CowController@putCow');

    $router->delete('delete/{earring}', 'CowController@deleteCow');
});


$router->group(['prefix' => 'vaccine'], function () use ($router) {
    
    $router->get('get/{id}', 'VaccineController@getVaccine');

    $router->post('post', 'VaccineController@postVaccine');

    $router->delete('delete/{id}', 'VaccineController@deleteVaccine');
});


$router->group(['prefix' => 'medication'], function () use ($router) {

    $router->get('get/{id}', 'MedicationController@getMedication');

    $router->post('post', 'MedicationController@postMedication');

    $router->delete('delete/{id}', 'MedicationController@deleteMedication');
});


$router->group(['prefix' => 'milk'], function () use ($router) {

    $router->get('get/{id}', 'MilkController@getMilk');

    $router->post('post', 'MilkController@postMilk');
    
    $router->delete('delete/{id}', 'MilkController@deleteMilk');

});