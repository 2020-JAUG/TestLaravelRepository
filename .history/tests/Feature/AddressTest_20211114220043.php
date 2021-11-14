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

        $this->json('GET', "/api/address/show/$address->id", [
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

    /** @test */
    public function get_address_by_country()
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

        $this->json('GET', "/api/address/showByCountry?country=$address->country", [
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

    /** @test */
    public function get_address_by_province()
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

        $this->json('GET', "/api/address/showByProvince?province=$address->province", [
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

    /** @test */
    public function get_address_by_locality()
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

        $this->json('GET', "/api/address/showByLocality?locality=$address->locality", [
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

    /** @test */
    public function get_address_by_customer()
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

        $this->json('GET', "/api/address/showByCustomer?customer=$address->customer_id", [
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

    /** @test */
    public function create_address_test()
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

    }
}
