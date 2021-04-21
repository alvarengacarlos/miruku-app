<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class VaccineTest extends TestCase
{
    /**
     * Fails test
     */
    public function testGetVaccineNotFound()
    {
        $response = $this->call('GET', '/vaccine/get/1');

        $this->assertEquals(404, $response->status());
        $this->assertEquals('"Vaccine not found"', $response->getContent());
    }

    public function testDeleteVaccineNotFound()
    {
        $response = $this->call('DELETE', '/vaccine/delete/1');

        $this->assertEquals(404, $response->status());
        $this->assertEquals('"Vaccine not found"', $response->getContent());
    }

    public function testPostVaccineCowNotExists()
    {
        $response = $this->call('POST', '/vaccine/post', [
            'earring' => '1',
            'name' => 'hellow',
            'date' => \date('Y-m-d'),
            'reason' => 'hellow'
        ]);

        $this->assertEquals(400, $response->status());
        $this->assertEquals('"Cow not exists"', $response->getContent());
    }
}
