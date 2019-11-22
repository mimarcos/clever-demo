<?php

/**
 * Common routes, no auth required
 */
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->group([], function() use ($router) {
        // authentication
        $router->get('users', ['uses' => 'Common\\ApiController@users']);
    });

});

$router->get('/', [ 'uses' => 'Common\\PageController@home']);