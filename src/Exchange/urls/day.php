<?php
return array(
    // ************************************************************* Schema
    array(
        'regex' => '#^/days/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Day'
        )
    ),
    // ************************************************************* Day
    array( // Create
        'regex' => '#^/days$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Exchange_Day'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Read
        'regex' => '#^/days/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Day'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/days$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Day'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/days/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Exchange_Day'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Delete (list)
        'regex' => '#^/days$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObjects',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Exchange_Day'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Update
        'regex' => '#^/days/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Exchange_Day'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    // ************************************************************* Admissions of a Day
    array( // Schema
        'regex' => '#^/days/(?P<parentId>\d+)/admissions/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Admission'
        )
    ),
    array( // Create
        'regex' => '#^/days/(?P<parentId>\d+)/admissions$#',
        'model' => 'Pluf_Views',
        'method' => 'createManyToOne',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Exchange_Admission',
            'parentModel' => 'Exchange_Day',
            'parentKey' => 'day_id'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/days/(?P<parentId>\d+)/admissions$#',
        'model' => 'Pluf_Views',
        'method' => 'findManyToOne',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Admission',
            'parentModel' => 'Exchange_Day',
            'parentKey' => 'day_id'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Read
        'regex' => '#^/days/(?P<parentId>\d+)/admissions/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getManyToOne',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Admission',
            'parentModel' => 'Exchange_Day',
            'parentKey' => 'day_id'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Update
        'regex' => '#^/days/(?P<parentId>\d+)/admissions/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateManyToOne',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Exchange_Admission',
            'parentModel' => 'Exchange_Day',
            'parentKey' => 'day_id'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Delete (list)
        'regex' => '#^/days/(?P<parentId>\d+)/admissions$#',
        'model' => 'Pluf_Views',
        'method' => 'clearManyToOne',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Exchange_Admission',
            'parentModel' => 'Exchange_Day',
            'parentKey' => 'day_id'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/days/(?P<parentId>\d+)/admissions/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteManyToOne',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Exchange_Admission',
            'parentModel' => 'Exchange_Day',
            'parentKey' => 'day_id'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    // ************************************************************* Drafts of a Day
    array( // Schema
        'regex' => '#^/days/(?P<parentId>\d+)/drafts/schema$#',
        'model' => 'Pluf_Views',
        'method' => 'getSchema',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Draft'
        )
    ),
    array( // Create
        'regex' => '#^/days/(?P<parentId>\d+)/drafts$#',
        'model' => 'Pluf_Views',
        'method' => 'createManyToOne',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Exchange_Draft',
            'parentModel' => 'Exchange_Day',
            'parentKey' => 'day_id'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Read (list)
        'regex' => '#^/days/(?P<parentId>\d+)/drafts$#',
        'model' => 'Pluf_Views',
        'method' => 'findManyToOne',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Draft',
            'parentModel' => 'Exchange_Day',
            'parentKey' => 'day_id'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Read
        'regex' => '#^/days/(?P<parentId>\d+)/drafts/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'getManyToOne',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Exchange_Draft',
            'parentModel' => 'Exchange_Day',
            'parentKey' => 'day_id'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Update
        'regex' => '#^/days/(?P<parentId>\d+)/drafts/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateManyToOne',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Exchange_Draft',
            'parentModel' => 'Exchange_Day',
            'parentKey' => 'day_id'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Delete (list)
        'regex' => '#^/days/(?P<parentId>\d+)/drafts$#',
        'model' => 'Pluf_Views',
        'method' => 'clearManyToOne',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Exchange_Draft',
            'parentModel' => 'Exchange_Day',
            'parentKey' => 'day_id'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/days/(?P<parentId>\d+)/drafts/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteManyToOne',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Exchange_Draft',
            'parentModel' => 'Exchange_Day',
            'parentKey' => 'day_id'
        ),
        'precond' => array(
            'Exchange_Precondition::cambistRequired'
        )
    ),
);
