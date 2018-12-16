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
use PHPUnit\Framework\IncompleteTestError;
require_once 'Pluf.php';

/**
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class Trade_RestTest extends TestCase
{

    var $client;

    /**
     *
     * @beforeClass
     */
    public static function createDataBase()
    {
        Pluf::start(__DIR__ . '/../conf/config.php');
        $m = new Pluf_Migration(Pluf::f('installed_apps'));
        $m->install();
        $m->init();

        // Test user
        $user = new User_Account();
        $user->login = 'test';
        $user->is_active = true;
        if (true !== $user->create()) {
            throw new Exception();
        }
        // Credential of user
        $credit = new User_Credential();
        $credit->setFromFormData(array(
            'account_id' => $user->id
        ));
        $credit->setPassword('test');
        if (true !== $credit->create()) {
            throw new Exception();
        }

        $per = User_Role::getFromString('tenant.owner');
        $user->setAssoc($per);
    }

    /**
     *
     * @afterClass
     */
    public static function removeDatabses()
    {
        $m = new Pluf_Migration(Pluf::f('installed_apps'));
        $m->unInstall();
    }

    /**
     *
     * @before
     */
    public function init()
    {
        $this->client = new Test_Client(array(
            array(
                'app' => 'Exchange',
                'regex' => '#^/exchange#',
                'base' => '',
                'sub' => include 'Exchange/urls.php'
            ),
            array(
                'app' => 'User',
                'regex' => '#^/user#',
                'base' => '',
                'sub' => include 'User/urls.php'
            )
        ));
        // login
        $this->client->post('/user/login', array(
            'login' => 'test',
            'password' => 'test'
        ));
    }

    /**
     *
     * @test
     */
    public function createRestTest()
    {
        $form = array(
            'lower_limit' => rand(),
            'upper_limit' => rand(),
            'source_currency' => 'dollar',
            'dest_currency' => 'bitcoin',
            'unit_price' => rand(),
            'type' => rand()
        );
        $response = $this->client->post('/exchange/trades', $form);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function getRestTest()
    {
        $model = new Exchange_Trade();
        $model->lower_limit = rand();
        $model->upper_limit = rand();
        $model->source_currency = 'dollar';
        $model->dest_currency = 'bitcoin';
        $model->unit_price = rand();
        $model->type = rand();
        $model->create();
        Test_Assert::assertFalse($model->isAnonymous(), 'Could not create Exchange_Trade');
        // Get item
        $response = $this->client->get('/exchange/trades/' . $model->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function updateRestTest()
    {
        $model = new Exchange_Trade();
        $model->lower_limit = rand();
        $model->upper_limit = rand();
        $model->source_currency = 'dollar';
        $model->dest_currency = 'bitcoin';
        $model->unit_price = rand();
        $model->type = rand();
        $model->create();
        Test_Assert::assertFalse($model->isAnonymous(), 'Could not create Exchange_Trade');
        // Update item
        $form = array(
            'upper_limit' => rand(),
            'unit_price' => rand()
        );
        $response = $this->client->post('/exchange/trades/' . $model->id, $form);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function deleteRestTest()
    {
        $model = new Exchange_Trade();
        $model->lower_limit = rand();
        $model->upper_limit = rand();
        $model->source_currency = 'dollar';
        $model->dest_currency = 'bitcoin';
        $model->unit_price = rand();
        $model->type = rand();
        $model->create();
        Test_Assert::assertFalse($model->isAnonymous(), 'Could not create Exchange_Trade');

        // delete
        $response = $this->client->delete('/exchange/trades/' . $model->id);
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

    /**
     *
     * @test
     */
    public function findRestTest()
    {
        $response = $this->client->get('/exchange/trades');
        $this->assertNotNull($response);
        $this->assertEquals($response->status_code, 200);
    }

}



