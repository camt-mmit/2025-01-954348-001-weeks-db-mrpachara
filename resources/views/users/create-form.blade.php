@extends('users.main', [
    'title' => 'Create',
    'mainClasses' => ['app-ly-max-width'],
])

@section('content')
    <form action="{{ route('users.create') }}" method="post">
        @csrf

        <div class="app-cmp-form-detail">
            <label for="app-inp-email">Email</label>
            <input type="email" id="app-inp-email" name="email" required class="app-cl-code" />

            <label for="app-inp-password">Password</label>
            <input type="password" id="app-inp-password" name="password" required />

            <label for="app-inp-name">Name</label>
            <input type="text" id="app-inp-name" name="name" required />

            <label for="app-inp-role">role</label>
            <select id="app-inp-role" name="role" required>
                <option value="">--- Please Select Role ---</option>
                @foreach ($roles as $role)
                    <option value="{{ $role }}">{{ $role }}</option>
                @endforeach
            </select>
        </div>

        <div class="app-cmp-form-actions">
            <button type="submit" class="app-cl-primary app-cl-filled">
                <i class="material-symbols-outlined">save</i>
                Create
            </button>
            <a href="{{ session()->get('bookmarks.users.create-form', route('users.list')) }}">
                <button type="button" class="app-cl-warn app-cl-filled">
                    <i class="material-symbols-outlined">cancel</i>
                    Cancel
                </button>
            </a>
        </div>
    </form>
@endsection
