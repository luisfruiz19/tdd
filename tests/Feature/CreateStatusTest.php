<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function guests_users_can_not_create_statuses()
    {
        $response = $this->post(route('status.store'),['body'=>'qweqweqw']);
        $response->assertRedirect('login');
    }

    /** @test */
    public function an_autheticated_user_can_create_statuses()
    {
         $this->withoutExceptionHandling();
         $user = User::factory()->create();
         $this->actingAs($user);
          $response = $this->postJson(route('status.store'),['body'=>'Mi Primer status' ]);
          $response->assertJson([
             'body' => 'Mi Primer status'
          ]);
         $this->assertDatabaseHas('statuses',[
             'user_id' => $user->id,
             'body' => 'Mi Primer status',
         ]);
    }

    /** @test */
    public function the_body_of_status_required_min_four_characters()
    {
       // $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->postJson(route('status.store'),['body'=>'qaq' ]);
        $response->assertStatus(422);
        $response->assertJsonStructure([
        'message',
        'errors' => ['body']
        ]);
    }
}
