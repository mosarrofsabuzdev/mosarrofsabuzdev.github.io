@props(['status'])
@php
$colors = ['paid' => 'bg-green-100 text-green-700','pending' => 'bg-amber-100 text-amber-700','overdue' => 'bg-red-100 text-red-700','draft' => 'bg-slate-100 text-slate-700','active' => 'bg-blue-100 text-blue-700'];
@endphp
<span class="inline-flex items-center rounded-lg px-2.5 py-1 text-xs font-medium {{ $colors[strtolower($status)] ?? 'bg-slate-100 text-slate-700' }}">{{ ucfirst($status) }}</span>
