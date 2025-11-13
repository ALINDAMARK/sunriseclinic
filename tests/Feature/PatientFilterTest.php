<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;

class PatientFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_json_filter_by_search_returns_matching_patient()
    {
        $user = User::factory()->create();

        $p1 = Patient::create(['name' => 'Alice Wonder', 'email' => 'alice@example.com']);
        $p2 = Patient::create(['name' => 'Bob Finder', 'email' => 'bob@example.com']);

        $res = $this->actingAs($user)->getJson(route('patients.data', ['search' => 'Alice']));
        $res->assertStatus(200);
        $json = $res->json();
        $this->assertCount(1, $json['data']);
        $this->assertEquals('Alice Wonder', $json['data'][0]['name']);
    }

    public function test_database_like_query_works()
    {
        $p1 = Patient::create(['name' => 'Alice Wonder', 'email' => 'alice@example.com']);
        $p2 = Patient::create(['name' => 'Bob Finder', 'email' => 'bob@example.com']);
        $count = Patient::where('name', 'like', '%Alice%')->count();
        $this->assertEquals(1, $count);
    }

    public function test_controller_dataJson_direct()
    {
        $p1 = Patient::create(['name' => 'Alice Wonder', 'email' => 'alice@example.com']);
        $controller = new \App\Http\Controllers\PatientController();
        $request = new \Illuminate\Http\Request(['search' => 'Alice']);
        $resp = $controller->dataJson($request);
        $this->assertEquals(200, $resp->getStatusCode());
        $body = json_decode($resp->getContent(), true);
        $this->assertCount(1, $body['data']);
    }

    public function test_json_filter_by_doctor_returns_only_patients_with_appointments()
    {
        $user = User::factory()->create();

        $doctor = Doctor::create(['name' => 'Dr Strange']);
        $service = \App\Models\Service::create(['name' => 'General', 'duration_minutes' => 30, 'cost' => 0]);
        $p1 = Patient::create(['name' => 'Charlie', 'email' => 'c@example.com']);
        $p2 = Patient::create(['name' => 'Dana', 'email' => 'd@example.com']);

        Appointment::create(['patient_id' => $p1->id, 'doctor_id' => $doctor->id, 'service_id' => $service->id, 'starts_at' => now(), 'duration_minutes' => 30, 'status' => 'pending']);

        $res = $this->actingAs($user)->getJson(route('patients.data', ['doctor_id' => $doctor->id]));
        $res->assertStatus(200);
        $json = $res->json();
        $this->assertCount(1, $json['data']);
        $this->assertEquals('Charlie', $json['data'][0]['name']);
    }

    public function test_csv_export_returns_csv_with_headers()
    {
        $user = User::factory()->create();
        $doctor = Doctor::create(['name' => 'Dr Who']);
        $service = \App\Models\Service::create(['name' => 'General', 'duration_minutes' => 30, 'cost' => 0]);
        $p = Patient::create(['name' => 'Eve', 'email' => 'eve@example.com']);
        Appointment::create(['patient_id' => $p->id, 'doctor_id' => $doctor->id, 'service_id' => $service->id, 'starts_at' => now(), 'duration_minutes' => 30, 'status' => 'pending']);

        $res = $this->actingAs($user)->get(route('patients.export', ['doctor_id' => $doctor->id]));
        $res->assertStatus(200);
        $this->assertStringContainsString('text/csv', $res->headers->get('content-type'));
        $this->assertStringContainsString('ID,Name,Email', $res->getContent());
    }
}
