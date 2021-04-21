<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class MedicationTest extends TestCase
{
    /**
     * Fails test
     */
    public function testGetMedicationNotFound()
    {
        $response = $this->call('GET', '/medication/get/1');

        $this->assertEquals(404, $response->status());
        $this->assertEquals('"Medication not found"', $response->getContent());
    }

    public function testDeleteMedicationNotFound()
    {
        $response = $this->call('DELETE', '/medication/delete/1');

        $this->assertEquals(404, $response->status());
        $this->assertEquals('"Medication not found"', $response->getContent());
    }

    public function testPostMedicationCowNotExists()
    {
        $response = $this->call('POST', '/medication/post', [
            'earring' => '1',
            'name' => 'hellow',
            'date' => \date('Y-m-d'),
            'reason' => 'hellow'
        ]);

        $this->assertEquals(400, $response->status());
        $this->assertEquals('"Cow not exists"', $response->getContent());
    }
}
