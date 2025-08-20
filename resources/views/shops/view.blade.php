@extends('shops.main', [
    'title' => $shop->name,
])

@section('content')
    <dl class="app-cmp-data-detail">
        <dt>Code</dt>
        <dd>
            <span class="app-cl-code">{{ $shop->code }}</span>
        </dd>

        <dt>Name</dt>
        <dd>
            {{ $shop->name }}
        </dd>

        <dt>Owner</dt>
        <dd>
            {{ $shop->owner }}
        </dd>

        <dt>Location</dt>
        <dd>
            <span class="app-cl-number">{{ $shop->latitude }}, {{ $shop->longitude }}</span>
        </dd>

        <dt>Address</dt>
        <dd>
            <pre style="margin: 0px;">{{ $shop->address }}</pre>
        </dd>
    </dl>
@endsection
