@extends('layouts.app')

@section('title','Chat')

@section('content')
<div class="p-4">
  <div class="flex items-center justify-between mb-4">
    <h2 class="text-2xl font-bold">Chat</h2>
    <a href="{{ route('messages.index') }}" class="text-sm">Back to conversations</a>
  </div>

  <div class="rounded border bg-white p-4">
    <div class="mb-4 text-sm text-neutral-medium">Conversation: <strong>{{ $conversationId }}</strong></div>

    <div id="chat-area" class="h-72 overflow-auto p-2 bg-gray-50 rounded">
      <div class="mb-2">
        <div class="text-xs text-neutral-medium">10:01 AM</div>
        <div class="inline-block bg-primary/10 text-primary px-3 py-1 rounded">Hello — this is a placeholder message.</div>
      </div>
      <div class="mb-2 text-right">
        <div class="text-xs text-neutral-medium">10:02 AM</div>
        <div class="inline-block bg-white border px-3 py-1 rounded">Reply from user</div>
      </div>
    </div>

    <form id="chat-form" class="mt-3" onsubmit="event.preventDefault(); alert('No backend yet — placeholder only');">
      <div class="flex gap-2">
        <input id="chat-input" class="flex-1 rounded border p-2" placeholder="Type message..." />
        <button class="px-3 py-2 rounded bg-primary text-white">Send</button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
(function(){
  const conversationId = '{{ $conversationId }}';
  const chatArea = document.getElementById('chat-area');
  const form = document.getElementById('chat-form');
  const input = document.getElementById('chat-input');
  const csrf = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '';

  const CURRENT_USER_ID = @json(auth()->id() ?? null);

  async function loadMessages(){
    try{
      const res = await fetch('/api/conversations/'+encodeURIComponent(conversationId)+'/messages', { credentials: 'same-origin', headers:{ 'Accept':'application/json' } });
      if(!res.ok) throw new Error('Failed to load');
      const j = await res.json();
      chatArea.innerHTML = '';
      (j.data || []).forEach(m => {
        const row = document.createElement('div');
                row.className = 'mb-2 ' + (m.user_id === CURRENT_USER_ID ? 'text-right' : '');
        const ts = document.createElement('div'); ts.className = 'text-xs text-neutral-medium'; ts.textContent = new Date(m.created_at).toLocaleString();
                const bubble = document.createElement('div'); bubble.className = (m.user_id === CURRENT_USER_ID ? 'inline-block bg-primary/10 text-primary px-3 py-1 rounded' : 'inline-block bg-white border px-3 py-1 rounded');
        bubble.textContent = m.body;
        row.appendChild(ts);
        row.appendChild(bubble);
        chatArea.appendChild(row);
      });
      chatArea.scrollTop = chatArea.scrollHeight;
    }catch(e){ console.error(e); chatArea.innerHTML = '<div class="text-sm text-red-500">Failed to load messages</div>'; }
  }

  form.addEventListener('submit', async function(ev){
    ev.preventDefault();
    const body = input.value.trim(); if(!body) return;
    try{
      const res = await fetch('/api/conversations/'+encodeURIComponent(conversationId)+'/messages', { method: 'POST', credentials: 'same-origin', headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': csrf, 'Accept':'application/json' }, body: JSON.stringify({ body: body }) });
      if(!res.ok) throw new Error('Post failed');
      input.value = '';
      await loadMessages();
    }catch(e){ alert('Failed to send message'); console.error(e); }
  });

  // initial load
  loadMessages();
  // poll for new messages every 5s (simple)
  setInterval(loadMessages, 5000);
})();
</script>
@endpush
