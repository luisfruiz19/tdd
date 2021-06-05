<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;
    /** @test  */
    public function an_user_can_authenticated()
    {
       //$this->withoutExceptionHandling();
        $user = User::factory()->create();

        $response = $this->post('/login',[
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password
        ]);
        $response->assertRedirect('/');

    }

    /** @test */
    public function an_user_autheticathed_can_create_an_user(){
   //     $this->withoutExceptionHandling();

        $response = $this->postJson('/user-create',[
            'name' => 'luis fernando',
            'email' => 'admin@gmail.com',
            'password' => 'password'
        ]);

        $response->assertJson([
            'data' => $response['data']
        ]);

        $this->assertDatabaseHas('users',[
            'name' => 'luis fernando',
        ]);


    }
}
