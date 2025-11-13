<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Patient;
use App\Models\Note;

class NotesEdgeCasesTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_validation_error()
    {
        $user = User::factory()->create();
        $patient = Patient::create(['name' => 'Note Patient', 'email' => 'n2@example.com']);

        $this->actingAs($user)->postJson(route('notes.store', $patient), ['note' => ''])->assertStatus(422)->assertJsonStructure(['message','errors' => ['note']]);
    }

    public function test_unauthorized_update_and_delete()
    {
        $owner = User::factory()->create();
        $attacker = User::factory()->create();
        $patient = Patient::create(['name' => 'Edge Patient', 'email' => 'edge@example.com']);

        // owner creates a note
        $res = $this->actingAs($owner)->postJson(route('notes.store', $patient), ['note' => 'Owner note']);
        $res->assertStatus(201);
        $noteId = $res->json('data.id');
        $this->assertNotEmpty($noteId);

        // verify notes endpoint shape
        $this->actingAs($owner)->getJson(route('patients.notes', $patient))->assertStatus(200)->assertJsonStructure(['data' => [['id','date','note','from']]]);

        // attacker attempts update
        $this->actingAs($attacker)->putJson(route('notes.update', $noteId), ['note' => 'Hacked'])->assertStatus(403);

        // attacker attempts delete
        $this->actingAs($attacker)->deleteJson(route('notes.destroy', $noteId))->assertStatus(403);

        // owner can still update
        $this->actingAs($owner)->putJson(route('notes.update', $noteId), ['note' => 'Owner updated'])->assertStatus(200)->assertJsonFragment(['note' => 'Owner updated']);

        // owner can delete
        $this->actingAs($owner)->deleteJson(route('notes.destroy', $noteId))->assertStatus(200)->assertJson(['deleted' => true]);

        // after deletion, notes endpoint is empty
        $this->actingAs($owner)->getJson(route('patients.notes', $patient))->assertStatus(200)->assertJson(['data' => []]);
    }
}
