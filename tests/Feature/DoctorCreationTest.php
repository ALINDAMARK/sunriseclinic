<?php

namespace Tests\Feature;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoctorCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_doctor_via_ajax()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);

        $payload = ['name' => 'Dr Test', 'specialty' => 'General'];
        $res = $this->postJson('/doctors', $payload);
        $res->assertStatus(201)->assertJsonPath('data.name', 'Dr Test');

        $this->assertDatabaseHas('doctors', ['name' => 'Dr Test']);
    }

    public function test_non_admin_gets_forbidden()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $this->actingAs($user);

        $payload = ['name' => 'Dr Bad', 'specialty' => 'General'];
        $res = $this->postJson('/doctors', $payload);
        $res->assertStatus(403);

        $this->assertDatabaseMissing('doctors', ['name' => 'Dr Bad']);
    }

    public function test_validation_errors_return_422()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);

        // missing required 'name' should trigger validation
        $payload = ['name' => '', 'specialty' => ''];
        $res = $this->postJson('/doctors', $payload);
        $res->assertStatus(422)->assertJsonStructure(['message', 'errors']);
    }
}
