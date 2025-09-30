@extends('users.selves.main', [
    'title' => 'Update',
])

@section('content')
    <form action="{{ route('users.selves.update') }}" method="post">
        @csrf

        <div class="app-cmp-form-detail">
            <label for="app-inp-email">Email</label>
            <output id="app-inp-email" class="app-cl-code">{{ $user->email }}</output>

            <label for="app-inp-name">Name</label>
            <input type="text" id="app-inp-name" name="name" value="{{ $user->name }}" required />

            <label for="app-inp-password">Password</label>
            <input type="password" id="app-inp-password" name="password"
                placeholder="Leave blank if yout don&apos;t need to edit" />
        </div>

        <div class="app-cmp-form-actions">
            <button type="submit">Update</button>
            <a href="{{ session()->get('bookmarks.users.selves.update-form', route('users.selves.view')) }}">
                <button type="button">Cancel</button>
            </a>
        </div>
    </form>
@endsection
