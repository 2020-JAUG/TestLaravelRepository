<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    /** @test */
    public function get_customer_test()
    {
        $this->withoutExceptionHandling();
        Customer::factory(1)->create();

        $this->assertCount(1, Customer::all());

        $customer = Customer::first();

        $this->json('GET', "/api/customer/$customer->id", [
            'message' => 'Ok',
            'error' => false,
            'code' => 200,
            'result' => [
                'data' => [
                    'id' => $customer->id,
                    'first_name' => $customer->first_name,
                    'family_name' => $customer->family_name,
                    'last_name' => $customer->last_name,
                    'birth_date' => $customer->birth_date,
                    'disability_degree' => $customer->disability_degree,
                    'genre' => $customer->genre,
                    'phone' => $customer->phone,
                    'mobile_phone' => $customer->mobile_phone,
                    'additional_contacts' => $customer->additional_contacts,
                    'status' => $customer->status,
                    'user_id' => $customer->user_id
                ]
            ]
        ]);
    }
}