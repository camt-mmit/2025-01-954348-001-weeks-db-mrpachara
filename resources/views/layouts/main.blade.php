<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai+Looped:wght@100..900&family=Roboto+Flex:opsz,wdth,wght,GRAD@8..144,25..151,100..1000,-200..150&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-25..200&display=block" />

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
                <form action="{{ route('logout') }}" method="post" class="app-cmp-user-actions">
                    @csrf
                    <a href="{{ route('users.selves.view') }}" title="click here of self information"
                        style="padding: 4px; border-radius: 4px;" class="app-cl-primary app-cl-button app-cl-filled">
                        <i class="material-symbols-outlined">person</i>
                        {{ \Auth::user()->name }}
                    </a>
                    <button type="submit" title="Logout" class="app-cl-warn app-cl-filled">
                        <i class="material-symbols-outlined">logout</i>
                    </button>
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
