<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/admissions/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Admission'
        )
    ),
    // ************************************************************* Admission
//     array( // Create
//         'regex' => '#^/admissions$#',
//         'model' => 'Pluf_Views',
//         'method' => 'createObject',
//         'http-method' => 'POST',
//         'params' => array(
//             'model' => 'Exchange_Admission'
//         ),
//         'precond' => array(
//             'Exchange_Precondition::cambistRequired'
//         )
//     ),
    array( // Read
        'regex' => '#^/admissions/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Admission'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/admissions$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Admission'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/admissions/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Exchange_Admission'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Delete (list)
        'regex' => '#^/admissions$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObjects',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Exchange_Admission'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Update
        'regex' => '#^/admissions/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Exchange_Admission'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    )
);
