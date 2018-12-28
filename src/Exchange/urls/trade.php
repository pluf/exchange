<?php
return array(
    // ************************************************************* Advertisements
    array( // Create
        'regex' => '#^/advertisements$#',
        'model' => 'Exchange_Views_Advertisement',
        'method' => 'create',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/advertisements$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Advertisement'
        )
    ),
    array( // Read
        'regex' => '#^/advertisements/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        ),
        'params' => array(
            'model' => 'Exchange_Advertisement'
        )
    ),
    array( // Update
        'regex' => '#^/advertisements/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Exchange_Advertisement'
        ),
        'precond' => array(
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/advertisements/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Exchange_Advertisement',
            'permanently' => false
        )
    )
    
);

