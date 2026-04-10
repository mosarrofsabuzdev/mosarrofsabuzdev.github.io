@props(['title' => 'No data yet', 'cta' => null])
<div class="text-center py-14 border border-dashed border-slate-300 rounded-xl bg-slate-50">
    <p class="text-base font-semibold">{{ $title }}</p>
    @if($cta)<div class="mt-3">{{ $cta }}</div>@endif
</div>
