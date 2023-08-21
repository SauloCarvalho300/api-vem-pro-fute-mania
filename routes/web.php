<?php

/** @var \Laravel\Lumen\Routing\Router $router */



$router->group(['prefix' => 'api'], function () use ($router) {
    
    $router->post('auth/register', 'AuthController@register');
    $router->post('auth/login', 'AuthController@login');
    $router->post('workspaces', 'WorkspaceController@store');

    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('/', 'UserController@allUsers');
        $router->get('/{id}', 'UserController@singleUser');
        $router->put('/{id}', 'UserController@update');
        $router->delete('/{id}', 'UserController@destroy');
    });
    
    $router->group(['prefix' => 'players'], function () use ($router) {
        $router->post('/', 'PlayerController@register');
    });
    
    $router->group(['prefix' => 'cards'], function () use ($router) {
        $router->get('/', 'CardController@index');
        $router->post('/', 'CardController@store');
        $router->get('/{id}', 'CardController@show');
        $router->put('/{id}', 'CardController@update');
        $router->delete('/{id}', 'CardController@destroy');
    });
    

    $router->group(['prefix' => 'cards', 'middleware' => 'auth'], function () use ($router) {
        $router->get('/workspaces', 'WorkspaceController@index');
        $router->get('/workspaces/{id}', 'WorkspaceController@show');
        $router->put('/workspaces/{id}', 'WorkspaceController@update');
        $router->delete('/workspaces/{id}', 'WorkspaceController@destroy');
    });

    $router->group(['prefix' => 'championships'], function () use ($router) {
        $router->get('/', 'ChampionshipController@index');
        $router->get('/{id}', 'ChampionshipController@show');
        $router->post('/', 'ChampionshipController@store');
        $router->put('/{id}', 'ChampionshipController@update');
        $router->delete('/{id}', 'ChampionshipController@destroy');
    });

});
