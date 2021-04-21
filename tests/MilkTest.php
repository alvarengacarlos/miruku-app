<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class MilkTest extends TestCase
{
    /**
     * Fails test
     */
    public function testGetMilkNotFound()
    {
        $response = $this->call('GET', '/milk/get/1');

        $this->assertEquals(404, $response->status());
        $this->assertEquals('"Milk not found"', $response->getContent());
    }

    public function testDeleteMilkNotFound()
    {
        $response = $this->call('DELETE', '/milk/delete/1');

        $this->assertEquals(404, $response->status());
        $this->assertEquals('"Milk not found"', $response->getContent());
    }

    public function testPostMilkCowNotExists()
    {
        $response = $this->call('POST', '/milk/post', [
            'earring' => '1',
            'date' => \date('Y-m-d'),
            'time' => '05:00:00',
            'liters' => 50.0
        ]);

        $this->assertEquals(400, $response->status());
        $this->assertEquals('"Cow not exists"', $response->getContent());
    }
}
