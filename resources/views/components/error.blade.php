@props(['error'])

@if (Session::has('error'))
    <div {{ $attributes->merge(['class' => 'alert alert-danger']) }}>
        {{ Session::get('error') }}
    </div>
@endif