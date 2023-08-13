<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->group(['prefix' => 'users'], function () use ($router) {
    // Matches "/api/register
    $router->post('/', 'AuthController@register');

 });
