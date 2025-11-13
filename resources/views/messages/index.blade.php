@extends('layouts.app')

@section('title','Messages')

@section('content')
<div class="p-4">
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-2xl font-bold">Messages</h2>
    <a href="{{ route('messages.index') }}" class="text-sm text-primary">Refresh</a>
  </div>

  <div class="grid grid-cols-3 gap-4">
    <div class="col-span-1">
      <div class="rounded border bg-white p-3">
        <h3 class="font-semibold mb-2">Conversations</h3>
        <div id="conversations-list" class="divide-y">
          @forelse($conversations as $c)
            <a href="{{ route('messages.chat', $c->id) }}" class="block py-2 hover:bg-gray-50" data-id="{{ $c->id }}">
              <div class="text-sm font-medium">{{ $c->name }}</div>
              <div class="text-xs text-neutral-medium">{{ $c->phone ?? $c->email ?? 'No contact' }}</div>
            </a>
          @empty
            <div class="p-2 text-sm text-neutral-medium">No conversations available.</div>
          @endforelse
        </div>
      </div>
    </div>

    <div class="col-span-2">
      <div class="rounded border bg-white p-3 h-96 flex flex-col">
        <div class="flex-1 text-center text-neutral-medium">Select a conversation to start chatting.</div>
        <div class="mt-3 border-t pt-3">
          <form onsubmit="alert('No backend yet — this is a placeholder.'); return false;">
            <div class="flex gap-2">
              <input type="text" placeholder="Type a message" class="flex-1 rounded border p-2" />
              <button class="px-3 py-2 rounded bg-primary text-white">Send</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

  @push('scripts')
  <script>
    (async function(){
      const list = document.getElementById('conversations-list');
      if(!list) return;
      try{
        const res = await fetch('/api/messages', { credentials: 'same-origin', headers: { 'Accept':'application/json' } });
        if(!res.ok) return;
        const j = await res.json();
        list.innerHTML = '';
        (j.data || []).forEach(c => {
          const a = document.createElement('a');
          a.href = '/messages/'+encodeURIComponent(c.id);
          a.className = 'block py-2 hover:bg-gray-50';
          a.dataset.id = c.id;
          a.innerHTML = `<div class="text-sm font-medium">${c.patient || c.subject || ('Conversation #'+c.id)}</div><div class="text-xs text-neutral-medium">${c.last_message ? (c.last_message.body.slice(0,60)) : ''}</div>`;
          list.appendChild(a);
        });
      }catch(e){ console.error('Failed to load conversations', e); }
    })();
  </script>
  @endpush
