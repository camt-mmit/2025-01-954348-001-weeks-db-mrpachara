@extends('shops.main', [
    'title' => $shop->code,
    'titleClasses' => ['app-cl-code'],
])

@section('header')
    <nav>
        <form action="{{ route('shops.delete', [
            'shop' => $shop->code,
        ]) }}" method="post"
            id="app-form-delete">
            @csrf
        </form>

        <ul class="app-cmp-links">
            @php
                session()->put('bookmarks.shops.view-products', url()->full());
            @endphp

            <li>
                <a href="{{ session()->get('bookmarks.shops.view', route('shops.list')) }}">
                    <i class="material-symbols-outlined">chevron_backward</i>
                    Back
                </a>
            </li>
            <li>
                <a
                    href="{{ route('shops.view-products', [
                        'shop' => $shop->code,
                    ]) }}">
                    <i class="material-symbols-outlined">list</i>
                    View Products
                </a>
            </li>
            @can('update', $shop)
                <li class="app-cl-filled">
                    <a
                        href="{{ route('shops.update-form', [
                            'shop' => $shop->code,
                        ]) }}">
                        <i class="material-symbols-outlined">edit_square</i>
                        Update
                    </a>
                </li>
            @endcan
            @can('delete', $shop)
                <li class="app-cl-warn app-cl-filled">
                    <button type="submit" form="app-form-delete" class="app-cl-link">
                        <i class="material-symbols-outlined">delete_forever</i>
                        Delete
                    </button>
                </li>
            @endcan
        </ul>
    </nav>
@endsection

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
