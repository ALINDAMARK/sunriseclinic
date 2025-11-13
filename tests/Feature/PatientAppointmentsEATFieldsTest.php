<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Appointment;

class PatientAppointmentsEATFieldsTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_appointments_include_eat_helper_fields()
    {
        $user = User::factory()->create();
        $doctor = Doctor::create(['name' => 'Dr Test']);
        $service = Service::create(['name' => 'Svc', 'duration_minutes' => 15, 'cost' => 0]);
        $patient = Patient::create(['name' => 'Test Patient', 'email' => 't@example.com']);

        $starts = now()->addDays(1)->setHour(9)->setMinute(30);
        $ends = (clone $starts)->addMinutes(30);

        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'service_id' => $service->id,
            'starts_at' => $starts,
            'ends_at' => $ends,
            'duration_minutes' => 30,
            'status' => 'pending',
            'notes' => 'Test'
        ]);

        $res = $this->actingAs($user)->getJson(route('patients.appointments', $patient));
        $res->assertStatus(200);
        // ensure the response data array exists and first element has the EAT helper fields
        $res->assertJsonStructure(['data' => [['id','starts_at','ends_at','starts_at_eat','starts_at_eat_display','duration_minutes']]]);

        // also check starts_at is an ISO8601 UTC string ending with Z
        $first = $res->json('data.0');
        $this->assertArrayHasKey('starts_at', $first);
        $this->assertMatchesRegularExpression('/Z$/', $first['starts_at']);
    }
}
