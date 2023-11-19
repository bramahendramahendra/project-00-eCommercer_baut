@props(['disabled' => false, 'type' => 'text', 'errors', 'label' => false])

<?php 
    $errorClasses = 'border-red-600 focus:border-red-600 ring-1 ring-red-600 focus:ring-red-600';
    $defaultClasses = 'ring-gray-300 ring-1 focus:ring-baut-color-red-200';
    $successClasses = 'border-emerald-500 focus:border-emerald-500 ring-1 ring-emerald-500 focus:ring-emerald-500';
?>
{{-- @if ($label)
    <label>{{$label}}</label>
@endif --}}
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 '
    // 'class' => 'rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6'
    .($errors->has($attributes['name']) ? $errorClasses : (old($attributes['name']) ? $successClasses : $defaultClasses) )
]) !!}>

{{-- @error($attributes['name'])
    <small class="text-red-600">{{$message}}</small>
@enderror --}}