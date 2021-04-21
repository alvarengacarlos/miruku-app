<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CowTest extends TestCase
{
    public function testPostCowRoute() 
    {
        $response = $this->call('POST', '/cow/post', [            
            'earring' => 1,
            'weight' => 500.00,
            'breed' => 'Nelore',
            'birthday' => '2020-01-01',        
        ]);

        $this->assertEquals(200, $response->status());
    }

    /**
     * @depends testPostCowRoute
     */
    public function testGetCowPerEarringRoute()
    {
        $response = $this->call('GET', '/cow/get/1');

        $this->assertEquals(200, $response->status());
    }

    /**
     * @depends testGetCowPerEarringRoute
     */
    public function testPutCowRoute()
    {
        $response = $this->call('PUT', '/cow/put/1', [            
            'earring' => 1,
            'weight' => 500.00,
            'breed' => 'Nelore',
            'birthday' => '2020-01-01',        
        ]);

        $this->assertEquals(200, $response->status());
    }

    /**
     * @depends testPutCowRoute
     */
    public function testDeleteRoute()
    {
        $response = $this->call('DELETE', '/cow/delete/1');

        $this->assertEquals(200, $response->status());
    }

    /**
     * Fails test
     */
    public function testGetCowNotFound()
    {
        $response = $this->call('GET', '/cow/get/1');

        $this->assertEquals(404, $response->status());
        
    }

    public function testPutCowNotFound()
    {
        $response = $this->call('PUT', '/cow/put/1', [            
            'earring' => 1,
            'weight' => 500.00,
            'breed' => 'Nelore',
            'birthday' => '2020-01-01',        
        ]);

        $this->assertEquals(404, $response->status());
    }

    public function testDeleteCowNotFound()
    {
        $response = $this->call('DELETE', '/cow/delete/1');

        $this->assertEquals(404, $response->status());
    }

}
