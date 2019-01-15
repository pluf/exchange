<?php
return array(
    // ************************************************************* Comments of Offer
    array( // Create
        'regex' => '#^/offers/(?P<parentId>\d+)/comments$#',
        'model' => 'Exchange_Views_Comment',
        'method' => 'create',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/offers/(?P<parentId>\d+)/comments$#',
        'model' => 'Exchange_Views_Comment',
        'method' => 'find',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Read
        'regex' => '#^/offers/(?P<parentId>\d+)/comments/(?P<modelId>\d+)$#',
        'model' => 'Exchange_Views_Comment',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Update
        'regex' => '#^/offers/(?P<parentId>\d+)/comments/(?P<modelId>\d+)$#',
        'model' => 'Exchange_Views_Comment',
        'method' => 'update',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        ),
    ),
    array( // Delete
        'regex' => '#^/offers/(?P<parentId>\d+)/comments/(?P<modelId>\d+)$#',
        'model' => 'Exchange_Views_Comment',
        'method' => 'delete',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    )
);

