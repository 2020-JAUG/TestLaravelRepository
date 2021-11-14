<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
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
        $data['user_id'] = 10;

        $this->postJson('/api/customer', $data)
            ->assertStatus(500)
            ->assertJson([
                'message' => "SQLSTATE[23000]: Integrity constraint violation: 19 FOREIGN KEY constraint failed (SQL: insert into \"customers\" (\"first_name\", \"family_name\", \"last_name\", \"birth_date\", \"genre\", \"phone\", \"status\", \"user_id\", \"updated_at\", \"created_at\") values (Firstname, Familyname, Lastname, 1989-06-30 00:00:00, 0, 959410857, 1, 10, 2021-11-14 19:16:01, 2021-11-14 19:16:01))",
                'error' => true,
                'result' => []
            ]);

        $this->assertCount(0, Customer::all());
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