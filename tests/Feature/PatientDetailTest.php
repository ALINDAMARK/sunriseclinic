<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Note;

class PatientDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_and_appointments_and_history_endpoints()
    {
        $user = User::factory()->create();
        $doctor = Doctor::create(['name' => 'Dr Test']);
        $service = Service::create(['name' => 'Svc', 'duration_minutes' => 15, 'cost' => 0]);
        $patient = Patient::create(['name' => 'Test Patient', 'email' => 't@example.com']);

        // past appointment
        Appointment::create(['patient_id' => $patient->id, 'doctor_id' => $doctor->id, 'service_id' => $service->id, 'starts_at' => now()->subDays(5), 'duration_minutes' => 30, 'status' => 'completed', 'notes' => 'Past visit']);
        // future appointment
        Appointment::create(['patient_id' => $patient->id, 'doctor_id' => $doctor->id, 'service_id' => $service->id, 'starts_at' => now()->addDays(2), 'duration_minutes' => 30, 'status' => 'pending']);

        $this->actingAs($user)->getJson(route('patients.profile', $patient))->assertStatus(200)->assertJsonFragment(['name' => 'Test Patient']);
        $this->actingAs($user)->getJson(route('patients.appointments', $patient))->assertStatus(200)->assertJsonCount(2, 'data');
        $this->actingAs($user)->getJson(route('patients.history', $patient))->assertStatus(200)->assertJsonCount(1, 'data');
    }

    public function test_notes_crud_and_notes_endpoint()
    {
        $user = User::factory()->create();
        $patient = Patient::create(['name' => 'Note Patient', 'email' => 'n@example.com']);

        // create note
        $res = $this->actingAs($user)->postJson(route('notes.store', $patient), ['note' => 'Initial note']);
        $res->assertStatus(201);
        $noteId = $res->json('data.id');
        $this->assertNotEmpty($noteId);

        // notes endpoint should include note
        $this->actingAs($user)->getJson(route('patients.notes', $patient))->assertStatus(200)->assertJsonFragment(['note' => 'Initial note']);

        // update note
        $this->actingAs($user)->putJson(route('notes.update', $noteId), ['note' => 'Updated note'])->assertStatus(200)->assertJsonFragment(['note' => 'Updated note']);

        // delete
        $this->actingAs($user)->deleteJson(route('notes.destroy', $noteId))->assertStatus(200)->assertJson(['deleted' => true]);

        // now notes should be empty
        $this->actingAs($user)->getJson(route('patients.notes', $patient))->assertStatus(200)->assertJson(['data' => []]);
    }
}
