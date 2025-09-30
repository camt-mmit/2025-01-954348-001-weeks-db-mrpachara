<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/common.css') }}" />

    <title>{{ $title }}</title>
</head>

<body>
    <header id="app-cmp-main-header">
        <nav class="app-cmp-user-panel">
            <ul class="app-cmp-links">
                <li>
                    <a href="{{ route('products.list') }}">Products</a>
                </li>
                <li>
                    <a href="{{ route('categories.list') }}">Categories</a>
                </li>
                <li>
                    <a href="{{ route('shops.list') }}">Shops</a>
                </li>
                @can('list', \App\Models\User::class)
                    <li>
                        <a href="{{ route('users.list') }}">Users</a>
                    </li>
                @endcan
            </ul>

            @php
                if (!Route::is('users.selves.*')) {
                    session()->put('bookmarks.users.selves.view', url()->full());
                }
            @endphp

            @auth
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <a href="{{ route('users.selves.view') }}" title="click here of self information"
                        class="app-cl-name">{{ \Auth::user()->name }}</a>
                    <button type="submit">Logout</button>
                </form>
            @endauth
        </nav>
    </header>

    <main id="app-cmp-main-content" @class($mainClasses ?? [])>
        <header>
            <h1>
                @section('title')
                    <span @class($titleClasses ?? [])>{{ $title }}</span>
                @show
            </h1>

            <div class="app-cmp-notifications">
                @session('status')
                    <div role="status">
                        {{ $value }}
                    </div>
                @endsession
            </div>

            @yield('header')
        </header>

        @yield('content')
    </main>

    <footer id="app-cmp-main-footer">
        &#xA9; Copyright Pachara's Database.
    </footer>
</body>

</html>
