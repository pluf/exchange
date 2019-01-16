<?php
return array(
    // ************************************************************* Offer
    array( // Read
        'regex' => '#^/offers/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'precond' => array(
            // TODO: Add precondition to access offer by offerer and advertiser only.
        ),
        'params' => array(
            'model' => 'Exchange_Offer'
        )
    ),
//     array( // Delete
//         'regex' => '#^/offers/(?P<modelId>\d+)$#',
//         'model' => 'Pluf_Views',
//         'method' => 'deleteObject',
//         'http-method' => 'DELETE',
//         'precond' => array(
//             'User_Precondition::ownerRequired'
//         ),
//         'params' => array(
//             'model' => 'Exchange_Offer'
//         )
//     ),
    // ************************************************************* Offers of Advertisement
    array( // Create
        'regex' => '#^/advertisements/(?P<parentId>\d+)/offers$#',
        'model' => 'Exchange_Views_Offer',
        'method' => 'addOffer',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Exchange_Offer',
            'parent' => 'Exchange_Advertisement',
            'parentKey' => 'advertisement_id'
        )
    ),
    array( // Read (list)
        'regex' => '#^/advertisements/(?P<parentId>\d+)/offers$#',
        'model' => 'Pluf_Views',
        'method' => 'findManyToOne',
        'http-method' => 'GET',
        'precond' => array(),
        'params' => array(
            'model' => 'Exchange_Offer',
            'parent' => 'Exchange_Advertisement',
            'parentKey' => 'advertisement_id',
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
        'regex' => '#^/advertisements/(?P<parentId>\d+)/offers/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getManyToOne',
        'http-method' => 'GET',
        'precond' => array(),
        'params' => array(
            'model' => 'Exchange_Offer',
            'parent' => 'Exchange_Advertisement',
            'parentKey' => 'advertisement_id'
        )
    ),
//     array( // Update
//         'regex' => '#^/advertisement/(?P<parentId>\d+)/offers/(?P<modelId>\d+)$#',
//         'model' => 'Pluf_Views',
//         'method' => 'updateManyToOne',
//         'http-method' => 'POST',
//         'precond' => array(
//             'User_Precondition::ownerRequired'
//         ),
//         'params' => array(
//             'model' => 'Exchange_Offer',
//             'parent' => 'Exchange_Advertisement',
//             'parentKey' => 'advertisement_id'
//         )
//     ),
    array( // Delete
        'regex' => '#^/advertisements/(?P<parentId>\d+)/offers/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteManyToOne',
        'http-method' => 'DELETE',
        'precond' => array(
            'User_Precondition::ownerRequired'
        ),
        'params' => array(
            'model' => 'Exchange_Offer',
            'parent' => 'Exchange_Advertisement',
            'parentKey' => 'advertisement_id'
        )
    ),
    
);

