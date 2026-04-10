@props(['href', 'label'])
<a href="{{ $href }}" class="group flex items-center px-3 py-2 rounded-lg text-sm {{ request()->url() === $href ? 'bg-slate-800 text-white border-l-2 border-[#2563EB]' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition-all duration-150">
    <span>{{ $label }}</span>
</a>
