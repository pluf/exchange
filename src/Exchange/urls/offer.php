<?php
return array(
    // ************************************************************* Offers of Trade
    array( // Create
        'regex' => '#^/trades/(?P<parentId>\d+)/offers$#',
        'model' => 'Exchange_Views_Offer',
        'method' => 'addOffer',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Exchange_Offer',
            'parent' => 'Exchange_Trade',
            'parentKey' => 'trade_id'
        )
    ),
    array( // Read (list)
        'regex' => '#^/trades/(?P<parentId>\d+)/offers$#',
        'model' => 'Pluf_Views',
        'method' => 'findManyToOne',
        'http-method' => 'GET',
        'precond' => array(),
        'params' => array(
            'model' => 'Exchange_Offer',
            'parent' => 'Exchange_Trade',
            'parentKey' => 'trade_id',
            'listFilters' => array(
                'amount',
                'unit_price',
                'offerer'
            ),
            'listDisplay' => array(),
            'searchFields' => array(
                'description'
            ),
            'sortFields' => array(
                'id',
                'amount',
                'unit_price',
                'offerer_id',
                'modif_dtime',
                'creation_dtime'
            ),
            'sortOrder' => array(
                'id',
                'DESC'
            )
        )
    ),
    array( // Read
        'regex' => '#^/trades/(?P<parentId>\d+)/offers/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getManyToOne',
        'http-method' => 'GET',
        'precond' => array(),
        'params' => array(
            'model' => 'Exchange_Offer',
            'parent' => 'Exchange_Trade',
            'parentKey' => 'trade_id'
        )
    ),
//     array( // Update
//         'regex' => '#^/trade/(?P<parentId>\d+)/offers/(?P<modelId>\d+)$#',
//         'model' => 'Pluf_Views',
//         'method' => 'updateManyToOne',
//         'http-method' => 'POST',
//         'precond' => array(
//             'User_Precondition::ownerRequired'
//         ),
//         'params' => array(
//             'model' => 'Exchange_Offer',
//             'parent' => 'Exchange_Trade',
//             'parentKey' => 'trade_id'
//         )
//     ),
    array( // Delete
        'regex' => '#^/trades/(?P<parentId>\d+)/offers/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteManyToOne',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Exchange_Offer',
            'parent' => 'Exchange_Trade',
            'parentKey' => 'trade_id'
        )
    ),
    
);

