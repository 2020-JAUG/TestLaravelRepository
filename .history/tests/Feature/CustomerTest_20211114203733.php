<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function get_customer_test()
    {
        $this->withoutExceptionHandling();
        User::factory(1)->create();
        $user = User::first();
        Customer::factory(1)->create(['user_id' => $user->id]);

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
        ])->assertStatus(200);
    }

    /** @test */
    public function create_customer_test()
    {
        $data = $this->data();

        User::factory(1)->create();

        $this->postJson('/api/customer', $data)->assertStatus(201);

        $this->assertCount(1, Customer::all());

        $customer = Customer::first();

        $this->json('GET', "/api/customer/$customer->id", [
            'message' => 'Ok',
            'error' => false,
            'code' => 200,
            'result' => [
                'data' => $data
            ]
        ])->assertStatus(200);
    }

    /** @test */
    public function error_constrain_db_create_customer_without_user_test()
    {
        $data = $this->data();

        $this->postJson('/api/customer', $data)
            ->assertStatus(500);

        $this->assertCount(0, Customer::all());
    }

    /** @test */
    public function update_customer_test()
    {
        User::factory(1)->create();
        Customer::factory(1)->create(['user_id' => 1]);

        $this->assertCount(1, Customer::all());
        $this->assertCount(1, User::all());

        $customer = Customer::first();

        $this->putJson("/api/customer/$customer->id", [
            'first_name' => 'Papa',
            'last_name' => 'Pikillo'
        ])->assertStatus(200);

        $data = $this->data();
        $data['first_name'] = 'Papa';
        $data['last_name'] = 'Pikillo';

        $this->json('GET', "/api/customer/$customer->id", [
            'message' => 'Ok',
            'error' => false,
            'code' => 200,
            'result' => [
                'data' => $data
            ]
        ])
            ->assertStatus(200);
        User::destroy(1);
    }

    /** @test */
    public function delete_customer_test()
    {
        User::factory(1)->create();
        Customer::factory(1)->create(['user_id' => 1]);

        $this->assertCount(1, Customer::all());
        $this->assertCount(1, User::all());
    }

    private function data()
    {
        return [
            'first_name' => 'Firstname',
            'family_name' => 'Familyname',
            'last_name' => 'Lastname',
            'birth_date' => '1989-06-30',
            'genre' => 0,
            'phone' => '959410857',
            'status' => 1,
            'user_id' => 1
        ];
    }
}