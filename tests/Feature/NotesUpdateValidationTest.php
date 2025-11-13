<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Patient;

class NotesUpdateValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_validation_error()
    {
        $owner = User::factory()->create();
        $patient = Patient::create(['name' => 'Edge Patient', 'email' => 'edge2@example.com']);

        // owner creates a note
        $res = $this->actingAs($owner)->postJson(route('notes.store', $patient), ['note' => 'Owner note']);
        $res->assertStatus(201);
        $noteId = $res->json('data.id');
        $this->assertNotEmpty($noteId);

        // attempt update with empty note should return 422
        $this->actingAs($owner)->putJson(route('notes.update', $noteId), ['note' => ''])->assertStatus(422)->assertJsonStructure(['message','errors' => ['note']]);
    }
}
