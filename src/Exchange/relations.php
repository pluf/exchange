<?php
return array(
    'Exchange_Trade' => array(
        // XXX: note: hadi, 1397-09: comment it if it cause to casecade deleting
        'relate_to' => array(
            'User_Account'
        )
    ),
    'Exchange_Offer' => array(
        // XXX: note: hadi, 1397-09: comment it if it cause to casecade deleting
        'relate_to' => array(
            'User_Account',
            'Exchange_Trade'
        )
    ),
    'Exchange_Post' => array(
        // XXX: note: hadi, 1397-09: comment it if it cause to casecade deleting
        'relate_to' => array(
            'User_Account',
            'Exchange_Trade'
        )
    ),
);
