<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/drafts/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Draft'
        )
    ),
    // ************************************************************* Draft
//     array( // Create
//         'regex' => '#^/drafts$#',
//         'model' => 'Pluf_Views',
//         'method' => 'createObject',
//         'http-method' => 'POST',
//         'params' => array(
//             'model' => 'Exchange_Draft'
//         ),
//         'precond' => array(
//             'Exchange_Precondition::cambistRequired'
//         )
//     ),
    array( // Read
        'regex' => '#^/drafts/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Draft'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/drafts$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Draft'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/drafts/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Exchange_Draft'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Delete (list)
        'regex' => '#^/drafts$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObjects',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Exchange_Draft'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Update
        'regex' => '#^/drafts/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Exchange_Draft'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    )
);
