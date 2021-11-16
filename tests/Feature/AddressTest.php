<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function get_index_address_test()
    {
        User::factory(1)->create();
        Customer::factory(1)->create(['user_id' => 1]);
        Address::factory(10)->create(['customer_id' => 1]);

        $this->assertCount(10, Address::all());

        $this->json('GET', '/api/address')
            ->assertStatus(200);
    }

    /** @test */
    public function get_address_test()
    {
        User::factory(1)->create();
        $this->assertCount(1, User::all());
        $user = User::first();

        Customer::factory(1)->create(['user_id' => $user->id]);
        $this->assertCount(1, Customer::all());
        $customer = Customer::first();

        Address::factory(1)->create(['customer_id' => $customer->id]);

        $this->assertCount(1, Address::all());
        $address = Address::first();

        $this->json('GET', "/api/address/$address->id", [
            'message' => 'Ok',
            'error' => false,
            'code' => 200,
            'result' => [
                'data' => [
                    'id' => $address->id,
                    'label' => $address->label,
                    'type' => $address->type,
                    'road' => $address->road,
                    'block' => $address->block,
                    'number' => $address->number,
                    'bis' => $address->bis,
                    'stairs' => $address->stairs,
                    'floor' => $address->floor,
                    'door' => $address->door,
                    'postal_code' => $address->postal_code,
                    'locality' => $address->province,
                    'province' => $address->province,
                    'country' => $address->country,
                    'customer_id' => $address->customer_id
                ]
            ]
        ])->assertStatus(200);
    }

    // /** @test */
    // public function get_address_by_country()
    // {
    //     User::factory(1)->create();
    //     $this->assertCount(1, User::all());
    //     $user = User::first();

    //     Customer::factory(1)->create(['user_id' => $user->id]);
    //     $this->assertCount(1, Customer::all());
    //     $customer = Customer::first();

    //     Address::factory(1)->create(['customer_id' => $customer->id]);
    //     $this->assertCount(1, Address::all());
    //     $address = Address::first();

    //     $this->json('GET', "/api/address/showByCountry?country=$address->country", [
    //         'message' => 'Ok',
    //         'error' => false,
    //         'code' => 200,
    //         'result' => [
    //             'data' => [
    //                 'id' => $address->id,
    //                 'label' => $address->label,
    //                 'type' => $address->type,
    //                 'road' => $address->road,
    //                 'block' => $address->block,
    //                 'number' => $address->number,
    //                 'bis' => $address->bis,
    //                 'stairs' => $address->stairs,
    //                 'floor' => $address->floor,
    //                 'door' => $address->door,
    //                 'postal_code' => $address->postal_code,
    //                 'locality' => $address->province,
    //                 'province' => $address->province,
    //                 'country' => $address->country,
    //                 'customer_id' => $address->customer_id
    //             ]
    //         ]
    //     ])->assertStatus(200);
    // }

    // /** @test */
    // public function get_address_by_province()
    // {
    //     User::factory(1)->create();
    //     $this->assertCount(1, User::all());
    //     $user = User::first();

    //     Customer::factory(1)->create(['user_id' => $user->id]);
    //     $this->assertCount(1, Customer::all());
    //     $customer = Customer::first();

    //     Address::factory(1)->create(['customer_id' => $customer->id]);
    //     $this->assertCount(1, Address::all());
    //     $address = Address::first();

    //     $this->json('GET', "/api/address/showByProvince?province=$address->province", [
    //         'message' => 'Ok',
    //         'error' => false,
    //         'code' => 200,
    //         'result' => [
    //             'data' => [
    //                 'id' => $address->id,
    //                 'label' => $address->label,
    //                 'type' => $address->type,
    //                 'road' => $address->road,
    //                 'block' => $address->block,
    //                 'number' => $address->number,
    //                 'bis' => $address->bis,
    //                 'stairs' => $address->stairs,
    //                 'floor' => $address->floor,
    //                 'door' => $address->door,
    //                 'postal_code' => $address->postal_code,
    //                 'locality' => $address->province,
    //                 'province' => $address->province,
    //                 'country' => $address->country,
    //                 'customer_id' => $address->customer_id
    //             ]
    //         ]
    //     ])->assertStatus(200);
    // }

    // /** @test */
    // public function get_address_by_locality()
    // {
    //     User::factory(1)->create();
    //     $this->assertCount(1, User::all());
    //     $user = User::first();

    //     Customer::factory(1)->create(['user_id' => $user->id]);
    //     $this->assertCount(1, Customer::all());
    //     $customer = Customer::first();

    //     Address::factory(1)->create(['customer_id' => $customer->id]);
    //     $this->assertCount(1, Address::all());
    //     $address = Address::first();

    //     $this->json('GET', "/api/address/showByLocality?locality=$address->locality", [
    //         'message' => 'Ok',
    //         'error' => false,
    //         'code' => 200,
    //         'result' => [
    //             'data' => [
    //                 'id' => $address->id,
    //                 'label' => $address->label,
    //                 'type' => $address->type,
    //                 'road' => $address->road,
    //                 'block' => $address->block,
    //                 'number' => $address->number,
    //                 'bis' => $address->bis,
    //                 'stairs' => $address->stairs,
    //                 'floor' => $address->floor,
    //                 'door' => $address->door,
    //                 'postal_code' => $address->postal_code,
    //                 'locality' => $address->province,
    //                 'province' => $address->province,
    //                 'country' => $address->country,
    //                 'customer_id' => $address->customer_id
    //             ]
    //         ]
    //     ])->assertStatus(200);
    // }

    // /** @test */
    // public function get_address_by_customer()
    // {
    //     User::factory(1)->create();
    //     $this->assertCount(1, User::all());
    //     $user = User::first();

    //     Customer::factory(1)->create(['user_id' => $user->id]);
    //     $this->assertCount(1, Customer::all());
    //     $customer = Customer::first();

    //     Address::factory(1)->create(['customer_id' => $customer->id]);
    //     $this->assertCount(1, Address::all());
    //     $address = Address::first();

    //     $this->json('GET', "/api/address/showByCustomer?customer=$address->customer_id", [
    //         'message' => 'Ok',
    //         'error' => false,
    //         'code' => 200,
    //         'result' => [
    //             'data' => [
    //                 'id' => $address->id,
    //                 'label' => $address->label,
    //                 'type' => $address->type,
    //                 'road' => $address->road,
    //                 'block' => $address->block,
    //                 'number' => $address->number,
    //                 'bis' => $address->bis,
    //                 'stairs' => $address->stairs,
    //                 'floor' => $address->floor,
    //                 'door' => $address->door,
    //                 'postal_code' => $address->postal_code,
    //                 'locality' => $address->province,
    //                 'province' => $address->province,
    //                 'country' => $address->country,
    //                 'customer_id' => $address->customer_id
    //             ]
    //         ]
    //     ])->assertStatus(200);
    // }

    /** @test */
    public function create_address_test()
    {
        User::factory(1)->create();
        $this->assertCount(1, User::all());
        $user = User::first();

        Customer::factory(1)->create(['user_id' => $user->id]);
        $this->assertCount(1, Customer::all());
        $customer = Customer::first();

        $data = $this->data();
        $data['customer_id'] = $customer->id;

        $this->postJson('/api/address', $data)->assertStatus(201);

        $this->assertCount(1, Address::all());
        $address = Address::first();

        $this->json('GET', "/api/address/$address->id", [
            'message' => 'Ok',
            'error' => false,
            'code' => 200,
            'result' => [
                'data' => $data
            ]
        ])->assertStatus(200);
    }

    /** @test */
    public function error_constrain_db_creating_address_without_customer()
    {
        $data = $this->data();
        $data['customer_id'] = 10;

        $this->postJson('/api/address', $data)
            ->assertStatus(500);

        $this->assertCount(0, Address::all());
    }

    /** @test */
    public function update_address_test()
    {
        User::factory(1)->create();
        $this->assertCount(1, User::all());
        $user = User::first();

        Customer::factory(1)->create(['user_id' => $user->id]);
        $this->assertCount(1, Customer::all());
        $customer = Customer::first();

        Address::factory(1)->create(['customer_id' => $customer->id]);
        $this->assertCount(1, Address::all());
        $address = Address::first();

        $this->putJson("/api/address/$address->id", [
            'locality' => 'otra',
            'country' => 'otro'
        ])->assertStatus(200);

        $data = $this->data();
        $data['locality'] = 'otra';
        $data['country'] = 'otro';

        $this->json('GET', "/api/address/$address->id", [
            'message' => 'Ok',
            'error' => false,
            'code' => 200,
            'result' => [
                'data' => $data
            ]
        ])->assertStatus(200);
    }

    /** @test */
    public function delete_address_test()
    {
        User::factory(1)->create();
        $this->assertCount(1, User::all());
        $user = User::first();

        Customer::factory(1)->create(['user_id' => $user->id]);
        $this->assertCount(1, Customer::all());
        $customer = Customer::first();

        Address::factory(1)->create(['customer_id' => $customer->id]);
        $this->assertCount(1, Address::all());
        $address = Address::first();

        $this->json('DELETE', "/api/address/$address->id")
            ->assertStatus(200);

        $this->assertCount(0, Address::all());
    }

    private function data()
    {
        return [
            'label' => 'label',
            'type' => 'type',
            'road' => 'road',
            'number' => '10',
            'postal_code' => '123455',
            'locality' => 'locality',
            'province' => 'province',
            'country' => 'country'
        ];
    }
}