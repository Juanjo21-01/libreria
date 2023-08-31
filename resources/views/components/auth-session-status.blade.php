@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'fs-3 text-success']) }}>
        {{ $status }}
    </div>
@endif
