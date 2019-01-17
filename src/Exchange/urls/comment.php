<?php
/*
 * This file is part of Pluf Framework, a simple PHP Application Framework.
 * Copyright (C) 2010-2020 Phoinex Scholars Co. (http://dpq.co.ir)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
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
    ),
    // ************************************************************* Binary content of Comment
    array( // Read
        'regex' => '#^/offers/(?P<offerId>\d+)/comments/(?P<modelId>\d+)/content$#',
        'model' => 'Exchange_Views_Comment',
        'method' => 'download',
        'http-method' => 'GET',
        // Cache param
        'cacheable' => true,
        'revalidate' => true,
        'intermediate_cache' => true,
        'max_age' => 25000
    ),
    array( // Update
        'regex' => '#^/offers/(?P<offerId>\d+)/comments/(?P<modelId>\d+)/content$#',
        'model' => 'Exchange_Views_Comment',
        'method' => 'updateFile',
        'http-method' => 'POST',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
);

