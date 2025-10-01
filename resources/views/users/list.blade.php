@extends('users.main', [
    'title' => 'List',
    'mainClasses' => ['app-ly-max-width'],
])

@section('header')
    <search>
        <form action="{{ route('users.list') }}" method="get" class="app-cmp-search-form">
            <div class="app-cmp-form-detail">
                <label for="app-criteria-term">Search</label>
                <input type="text" id="app-criteria-term" name="term" value="{{ $criteria['term'] }}" />
            </div>

            <div class="app-cmp-form-actions">
                <a href="{{ route('users.list') }}">
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
                session()->put('bookmarks.users.create-form', url()->full());
            @endphp

            <ul class="app-cmp-links">
                @can('create', \App\Models\User::class)
                    <li class="app-cl-filled">
                        <a href="{{ route('users.create-form') }}">
                            <i class="material-symbols-outlined">add_box</i>
                            New User
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>

        {{ $users->withQueryString()->links() }}
    </div>
@endsection

@section('content')
    <table class="app-cmp-data-list">
        <colgroup>
            <col />
            <col />
            <col style="width: 16ch;" />
        </colgroup>

        <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Role</th>
            </tr>
        </thead>

        <tbody>
            @php
                session()->put('bookmarks.users.view', url()->full());
            @endphp

            @foreach ($users as $user)
                <tr>
                    <td>
                        <a href="{{ route('users.view', [
                            'user' => $user->email,
                        ]) }}"
                            class="app-cl-code">
                            {{ $user->email }}
                        </a>
                    </td>
                    <td>{{ $user->name }}</td>
                    <td class="app-cl-code">{{ $user->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
