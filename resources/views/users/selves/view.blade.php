@extends('users.selves.main')

@section('header')
    <nav>
        <ul class="app-cmp-links">
            @php
                session()->put('bookmarks.users.selves.update-form', url()->full());
            @endphp

            <li>
                <a href="{{ session()->get('bookmarks.users.selves.view', route('products.list')) }}">
                    <i class="material-symbols-outlined">chevron_backward</i>
                    Back
                </a>
            </li>
            @can('selfUpdate', $user)
                <li class="app-cl-filled">
                    <a href="{{ route('users.selves.update-form') }}">
                        <i class="material-symbols-outlined">person_edit</i>
                        Self Update
                    </a>
                </li>
            @endcan
        </ul>
    </nav>
@endsection

@section('content')
    <dl class="app-cmp-data-detail">
        <dt>Email</dt>
        <dd>
            <span class="app-cl-code">{{ $user->email }}</span>
        </dd>

        <dt>Name</dt>
        <dd>
            {{ $user->name }}
        </dd>
    </dl>
@endsection
