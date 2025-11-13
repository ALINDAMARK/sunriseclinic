<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Doctor;

class BlockManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_and_delete_block()
    {
        // create admin user
        $admin = User::factory()->create(['is_admin' => true]);
        $doctor = Doctor::create(['name' => 'Dr Test']);

        $starts = now()->addDays(1)->setHour(10)->setMinute(0)->format('Y-m-d H:i:s');

        $resp = $this->actingAs($admin)
            ->postJson('/blocks', [
                'doctor_id' => $doctor->id,
                'starts_at' => $starts,
                'duration_minutes' => 45,
                'notes' => 'Unit test block',
            ]);

        $resp->assertStatus(201)
            ->assertJsonStructure(['data' => ['id','doctor_id','starts_at','duration_minutes']]);

        $blockId = $resp->json('data.id');

        // delete
        $this->actingAs($admin)
            ->deleteJson('/blocks/'.$blockId)
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }

    public function test_non_admin_cannot_create_block()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $doctor = Doctor::create(['name' => 'Dr Test 2']);
        $starts = now()->addDays(2)->setHour(11)->setMinute(0)->format('Y-m-d H:i:s');

        $this->actingAs($user)
            ->postJson('/blocks', [
                'doctor_id' => $doctor->id,
                'starts_at' => $starts,
                'duration_minutes' => 30,
            ])->assertStatus(403);
    }
}
