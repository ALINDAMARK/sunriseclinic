<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;

class MessageApiController extends Controller
{
    // List conversations (basic)
    public function index(Request $request)
    {
        $conversations = Conversation::with(['patient'])->orderBy('updated_at', 'desc')->paginate(25);
        $rows = $conversations->map(function($c){
            $last = $c->messages()->latest('created_at')->first();
            return [
                'id' => $c->id,
                'patient' => $c->patient ? $c->patient->name : null,
                'subject' => $c->subject,
                'last_message' => $last ? ['id'=>$last->id, 'body'=>$last->body, 'user_id'=>$last->user_id, 'created_at'=>$last->created_at] : null,
                'updated_at' => $c->updated_at,
            ];
        });
        return response()->json(['data' => $rows, 'meta' => ['pagination' => [ 'current_page' => $conversations->currentPage(), 'last_page' => $conversations->lastPage() ]]]);
    }

    public function storeConversation(Request $request)
    {
        $data = $request->validate([
            'patient_id' => ['nullable','exists:patients,id'],
            'subject' => ['nullable','string','max:255']
        ]);
        $conv = Conversation::create(array_merge($data, ['created_by' => Auth::id()]));
        return response()->json(['data' => $conv], 201);
    }

    public function messages(Request $request, Conversation $conversation)
    {
        $msgs = $conversation->messages()->with('user')->orderBy('created_at','asc')->get()->map(function($m){
            return ['id'=>$m->id,'body'=>$m->body,'user_id'=>$m->user_id,'user_name'=>optional($m->user)->name,'created_at'=>$m->created_at];
        });
        return response()->json(['data' => $msgs]);
    }

    public function postMessage(Request $request, Conversation $conversation)
    {
        $data = $request->validate(['body' => ['required','string']]);
        $m = Message::create(['conversation_id' => $conversation->id, 'user_id' => Auth::id(), 'body' => $data['body']]);
        // touch conversation updated_at
        $conversation->touch();
        return response()->json(['data' => $m], 201);
    }
}
