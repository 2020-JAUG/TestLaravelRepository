<?php

namespace Tests\Feature;

use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function get_address_test()
    {
        Address::factory(1)->create();

        $this->assertCount(1, Address::all());
    }
}