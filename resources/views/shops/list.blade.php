@extends('shops.main', [
    'title' => 'List',
    'mainClasses' => ['app-ly-max-width'],
])

@section('header')
    <search>
        <form action="{{ route('shops.list') }}" method="get" class="app-cmp-search-form">
            <div class="app-cmp-form-detail">
                <label for="app-criteria-term">Search</label>
                <input type="text" id="app-criteria-term" name="term" value="{{ $criteria['term'] }}" />
            </div>

            <div class="app-cmp-form-actions">
                <a href="{{ route('shops.list') }}">
                    <button type="button" class="app-cl-warn app-cl-filled">
                        <i class="material-symbols-outlined">close</i>
                    </button>
                </a>
                <button type="submit" class="app-cl-primary app-cl-filled">
                    <i class="material-symbols-outlined">search</i>
                </button>
            </div>
        </form>
    </search>

    <div class="app-cmp-links-bar">
        <nav>
            @php
                session()->put('bookmarks.shops.create-form', url()->full());
            @endphp

            <ul class="app-cmp-links">
                @can('create', \App\Models\Shop::class)
                    <li class="app-cl-filled">
                        <a href="{{ route('shops.create-form') }}">
                            <i class="material-symbols-outlined">add_box</i>
                            New Shop
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>

        {{ $shops->withQueryString()->links() }}
    </div>
@endsection

@section('content')
    <table class="app-cmp-data-list">
        <colgroup>
            <col style="width: 5ch;" />
            <col />
            <col />
            <col style="width: 4ch;" />
        </colgroup>

        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Owner</th>
                <th>No. of Products</th>
            </tr>
        </thead>

        <tbody>
            @php
                session()->put('bookmarks.shops.view', url()->full());
            @endphp

            @foreach ($shops as $shop)
                <tr>
                    <td>
                        @can('view', $shop)
                            <a href="{{ route('shops.view', [
                                'shop' => $shop->code,
                            ]) }}"
                                class="app-cl-code">
                                {{ $shop->code }}
                            </a>
                        @else
                            <span class="app-cl-code">{{ $shop->code }}</span>
                        @endcan
                    </td>
                    <td>{{ $shop->name }}</td>
                    <td>{{ $shop->owner }}</td>
                    <td class="app-cl-number">{{ $shop->products_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
