<?php

namespace Tests\Feature;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoctorEditDestroyTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_and_delete_doctor()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin);

        $doctor = Doctor::create(['name' => 'Old Name', 'specialty' => 'X']);

        $res = $this->put('/doctors/' . $doctor->id, ['name' => 'New Name', 'specialty' => 'Y']);
        $res->assertRedirect();
        $this->assertDatabaseHas('doctors', ['id' => $doctor->id, 'name' => 'New Name']);

        $res = $this->delete('/doctors/' . $doctor->id);
        $res->assertRedirect();
        $this->assertDatabaseMissing('doctors', ['id' => $doctor->id]);
    }

    public function test_non_admin_cannot_update_or_delete()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $this->actingAs($user);

        $doctor = Doctor::create(['name' => 'Someone', 'specialty' => 'X']);

        $res = $this->put('/doctors/' . $doctor->id, ['name' => 'Hacked', 'specialty' => 'Z']);
        $res->assertStatus(403);
        $this->assertDatabaseHas('doctors', ['id' => $doctor->id, 'name' => 'Someone']);

        $res = $this->delete('/doctors/' . $doctor->id);
        $res->assertStatus(403);
        $this->assertDatabaseHas('doctors', ['id' => $doctor->id]);
    }
}
