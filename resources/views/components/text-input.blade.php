@props(['disabled' => false, 'type' => 'text', 'errors', 'label' => false])

<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \Illuminate\Support\ComponentAttributeBag $attributes */
?>

<?php 
    $errorClasses = 'border-red-600 focus:border-red-600 ring-1 ring-red-600 focus:ring-red-600';
    $defaultClasses = 'ring-gray-300 ring-1 focus:ring-baut-color-red-200';
    $successClasses = 'border-emerald-500 focus:border-emerald-500 ring-1 ring-emerald-500 focus:ring-emerald-500';

    $attributeName = preg_replace('/(\w+)\[\w+]/', '$1.$2', $attributes['name']);
?>

<div>
    @if ($type === 'select')
        <select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
            'class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 '
            .($errors->has($attributeName) ? $errorClasses : (old($attributeName) ? $successClasses : $defaultClasses) )
        ]) !!}>
            {{ $slot }}
        </select>
    @else
        <input {{ $disabled ? 'disabled' : '' }} type="{{$type}}" {!! $attributes->merge([
            'class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 '
            .($errors->has($attributeName) ? $errorClasses : (old($attributeName) ? $successClasses : $defaultClasses))
        ]) !!}>
    @endif
</div>
