<?php
return array(
    // ************************************************************* Offers of Trade
    array( // Create
        'regex' => '#^/trades/(?P<parentId>\d+)/posts$#',
        'model' => 'Exchange_Views_Post',
        'method' => 'create',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/trades/(?P<parentId>\d+)/posts$#',
        'model' => 'Exchange_Views_Post',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read
        'regex' => '#^/trades/(?P<parentId>\d+)/posts/(?P<modelId>\d+)$#',
        'model' => 'Exchange_Views_Post',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Update
        'regex' => '#^/trades/(?P<parentId>\d+)/posts/(?P<modelId>\d+)$#',
        'model' => 'Exchange_Views_Post',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        ),
    ),
    array( // Delete
        'regex' => '#^/trades/(?P<parentId>\d+)/posts/(?P<modelId>\d+)$#',
        'model' => 'Exchange_Views_Post',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    )
);

