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

/**
 * Defines preconditions to work with Exchange entities
 */
class Exchange_Precondition
{

    /**
     * Check if the user sending request is a cambist.
     * If it is not, this function will throw
     * the Pluf_Exception_PermissionDenied exception.
     *
     * @param Pluf_HTTP_Request $request
     * @throws Pluf_Exception_PermissionDenied
     */
    static public function cambistRequired($request)
    {
        $res = User_Precondition::loginRequired($request);
        if (true !== $res) {
            return $res;
        }
        if ($request->user->hasPerm('tenant.owner') ||
            $request->user->hasPerm('exchange.cambist')) {
            return true;
        }
        throw new Pluf_Exception_PermissionDenied();
    }

    /**
     * Checks if the use sending request is a shroff.
     * If it is not this function will throw
     * the Pluf_Exception_PermissionDenied exception.
     *
     * @param Pluf_HTTP_Request $request
     * @throws Pluf_Exception_PermissionDenied
     */
    static public function shroffRequired($request)
    {
        $res = User_Precondition::loginRequired($request);
        if (true !== $res) {
            return $res;
        }
        if ($request->user->hasPerm('tenant.owner') || 
            $request->user->hasPerm('exchange.cambist') || 
            $request->user->hasPerm('exchange.shroff')) {
            return true;
        }
        throw new Pluf_Exception_PermissionDenied();
    }
    
    
    /**
     * Checks if the user sending request is a project manager or not.
     * Retunrs true if the user is a project manager else false.
     * @return true if the user sending request is project manager else false.
     */
    static public function isProjectManager($request)
    {
        if (! isset($request->user) or $request->user->isAnonymous()) {
            return false;
        }
        if ($request->user->hasPerm('tenant.owner') || $request->user->hasPerm('tms.project_manager')) {
            return true;
        }
        return false;
    }

    /**
     * Checks if the user sending request is a cambist or not.
     * Retunrs true if the user is a test manager else false.
     * @return true if the user sending request is test manager else false.
     */
    static public function isCambist($request)
    {
        if (! isset($request->user) or $request->user->isAnonymous()) {
            return false;
        }
        if ($request->user->hasPerm('tenant.owner') ||
            $request->user->hasPerm('exchange.cambist')) {
            return true;
        }
        return false;
    }

    /**
     * Checks if the user sending request is a shroff or not.
     * Retunrs true if the user is a tester else false.
     * @return true if the user sending request is tester else false.
     */
    static public function isShroff($request)
    {
        if (! isset($request->user) or $request->user->isAnonymous()) {
            return false;
        }
        if ($request->user->hasPerm('tenant.owner') ||
            $request->user->hasPerm('exchange.cambist') ||
            $request->user->hasPerm('exchange.shroff')) {
            return true;
        }
        return false;
    }
    
}