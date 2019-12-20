<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/currency-rates/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_CurrencyRate'
        )
    ),
    // ************************************************************* CurrencyRate
    array( // Create
        'regex' => '#^/currency-rates$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Exchange_CurrencyRate'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Read
        'regex' => '#^/currency-rates/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_CurrencyRate'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/currency-rates$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_CurrencyRate'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/currency-rates/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Exchange_CurrencyRate'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Delete (list)
        'regex' => '#^/currency-rates$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObjects',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Exchange_CurrencyRate'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Update
        'regex' => '#^/currency-rates/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Exchange_CurrencyRate'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    )
);
