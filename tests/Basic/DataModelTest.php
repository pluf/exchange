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
use PHPUnit\Framework\TestCase;

require_once 'Pluf.php';

/**
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class Basic_DataModelTest extends TestCase
{

    /**
     * @before
     */
    public function setUp ()
    {
        Pluf::start(__DIR__. '/../conf/config.php');
    }

    /**
     * @test
     */
    public function testClassInstance ()
    {
        $object = new Exchange_Trade();
        $this->assertTrue(isset($object), 'Exchange_Trade could not be created!');
        $object = new Exchange_Offer();
        $this->assertTrue(isset($object), 'Exchange_Offer could not be created!');
        $object = new Exchange_Post();
        $this->assertTrue(isset($object), 'Exchange_Post could not be created!');
    }
}

