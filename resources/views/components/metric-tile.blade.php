@props(['label', 'value', 'trend' => null])
<x-card>
    <div class="text-[13px] text-slate-500">{{ $label }}</div>
    <div class="text-2xl font-semibold mt-1">{{ $value }}</div>
    @if(!is_null($trend))<div class="text-xs mt-1 {{ $trend >= 0 ? 'text-green-600' : 'text-red-600' }}">{{ $trend >= 0 ? '↑' : '↓' }} {{ abs($trend) }}%</div>@endif
</x-card>
