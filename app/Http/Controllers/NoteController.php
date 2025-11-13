<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function store(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'note' => 'required|string',
        ]);
        $note = Note::create([
            'patient_id' => $patient->id,
            'user_id' => Auth::id(),
            'note' => $data['note'],
        ]);
        return response()->json(['data' => $note], 201);
    }

    public function update(Request $request, Note $note)
    {
        $this->authorize('update', $note);
        $data = $request->validate(['note' => 'required|string']);
        $note->update(['note' => $data['note']]);
        return response()->json(['data' => $note]);
    }

    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);
        $note->delete();
        return response()->json(['deleted' => true]);
    }
}
