@props(['success'])

@if (Session::has('success'))
    <div {{ $attributes->merge(['class' => 'alert alert-success']) }}>
        {{ Session::get('success') }}
    </div>
@endif