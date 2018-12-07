<?php
return array(
    // ************************************************************* Trades
    array( // Create
        'regex' => '#^/trades$#',
        'model' => 'Exchange_Views_Trade',
        'method' => 'create',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/trades$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Trade'
        )
    ),
    array( // Read
        'regex' => '#^/trades/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        ),
        'params' => array(
            'model' => 'Exchange_Trade'
        )
    ),
    array( // Update
        'regex' => '#^/trades/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Exchange_Trade'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/trades/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Exchange_Trade',
            'permanently' => false
        )
    )
    
    
);