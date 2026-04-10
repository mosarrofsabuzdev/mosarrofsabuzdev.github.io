@props(['src' => null, 'name' => 'U', 'size' => 'sm'])
@php($wh = $size === 'lg' ? 'h-10 w-10' : 'h-8 w-8')
@if($src)
<img src="{{ $src }}" alt="{{ $name }}" class="{{ $wh }} rounded-full object-cover">
@else
<div class="{{ $wh }} rounded-full bg-blue-600 text-white grid place-items-center text-xs font-semibold">{{ strtoupper(substr($name, 0, 2)) }}</div>
@endif
