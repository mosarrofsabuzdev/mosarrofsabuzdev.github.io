@props(['title','message','time'])
<div class="p-3 border-b border-slate-100 hover:bg-slate-50 transition-colors">
    <p class="text-sm font-medium">{{ $title }}</p>
    <p class="text-xs text-slate-500">{{ $message }}</p>
    <p class="text-xs text-slate-400 mt-1">{{ $time }}</p>
</div>
