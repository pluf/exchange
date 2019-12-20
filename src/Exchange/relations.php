<?php
return array(
    'Exchange_Advertisement' => array(
        // XXX: note: hadi, 1397-09: comment it if it cause to casecade deleting
        'relate_to' => array(
            'User_Account'
        )
    ),
    'Exchange_Offer' => array(
        // XXX: note: hadi, 1397-09: comment it if it cause to casecade deleting
        'relate_to' => array(
            'User_Account',
            'Exchange_Advertisement'
        )
    ),
    'Exchange_Comment' => array(
        // XXX: note: hadi, 1397-09: comment it if it cause to casecade deleting
        'relate_to' => array(
            'User_Account',
            'Exchange_Advertisement'
        )
    ),
    'Exchange_Admission' => array(
        'relate_to' => array(
            'Exchange_Day'
        )
    ),
    'Exchange_Draft' => array(
        'relate_to' => array(
            'Exchange_Day'
        )
    ),
);
