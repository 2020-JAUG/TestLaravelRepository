<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function get_user_test()
    {
        $this->withoutExceptionHandling();
        User::factory(1)->create(['email_verified_at' => null]);

        $this->assertCount(1, User::all());
        $user = User::first();

        $this->json('GET', "/api/user/$user->id",[
            'message' => 'Ok',
            'error' => false,
            'code' => 200,
            'result' => [
                'data' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => $user->email_verified_at
                ]
            ]
        ]);
    }

    /** @test */
    public function create_user_test()
    {
        $data = [
            'name' => 'Firstname Lastname',
            'email' => 'firstname.lastname@mail.com',
            'password' => 'passwordExample'
        ];

        $this->postJson('/api/user', $data)->assertStatus(201);

        $this->assertCount(1, User::all());

        $user = User::first();

        $this->json('GET', "/api/user/$user->id",[
            'message' => 'Ok',
            'error' => false,
            'code' => 200,
            'result' => [
                'data' => [
                    'name' => 'Firstname Lastname',
                    'email' => 'firstname.lastname@mail.com'
                ]
            ]
        ]);

        // $this->json('GET', "/api/user/$user->id")
        //     ->assertStatus(200)
        //     ->assertJson([
        //         'message' => 'Ok',
        //         'error' => false,
        //         'code' => 200,
        //         'result' => [
        //             'data' => [
        //                 'name' => 'Firstname Lastname',
        //                 'email' => 'firstname.lastname@mail.com'
        //             ]
        //         ]
        //     ]);
    }
}