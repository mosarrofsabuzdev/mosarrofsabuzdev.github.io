@props(['type' => 'success', 'message' => 'Done'])
<div class="fixed bottom-4 right-4 px-4 py-3 rounded-xl text-white shadow-lg {{ $type === 'success' ? 'bg-green-600' : ($type === 'error' ? 'bg-red-600' : 'bg-slate-700') }}">{{ $message }}</div>
