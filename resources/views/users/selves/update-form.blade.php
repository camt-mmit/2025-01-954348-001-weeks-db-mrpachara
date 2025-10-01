@extends('users.selves.main', [
    'title' => 'Update',
    'mainClasses' => ['app-ly-max-width'],
])

@section('content')
    <form action="{{ route('users.selves.update') }}" method="post">
        @csrf

        <div class="app-cmp-form-detail">
            <label for="app-inp-email">Email</label>
            <output id="app-inp-email" class="app-cl-code">{{ $user->email }}</output>

            <label for="app-inp-name">Name</label>
            <input type="text" id="app-inp-name" name="name" value="{{ old('name', $user->name) }}" required />
            @error('name')
                <span></span>
                <b class="app-cl-warn">{{ $message }}</b>
            @enderror

            <label for="app-inp-password">Password</label>
            <input type="password" id="app-inp-password" name="password" autocomplete="new-password"
                placeholder="Leave blank if you don&apos;t need to edit" />
            @error('password')
                <span></span>
                <b class="app-cl-warn">{{ $message }}</b>
            @enderror

            <label for="app-inp-password-confirmation">Password Confirmation</label>
            <input type="password" id="app-inp-password-confirmation" name="password_confirmation"
                autocomplete="new-password" placeholder="This must match &apos;password&apos; field" />
            @error('password_confirmation')
                <span></span>
                <b class="app-cl-warn">{{ $message }}</b>
            @enderror

            <span></span>
            <span></span>

            <label for="app-inp-current-password">Current Password</label>
            <input type="password" id="app-inp-current-password" name="current_password" required
                autocomplete="current-password" placeholder="This is required for updating your information" />
            @error('current_password')
                <span></span>
                <b class="app-cl-warn">{{ $message }}</b>
            @enderror
        </div>

        <div class="app-cmp-form-actions">
            <button type="submit">Update</button>
            <a href="{{ session()->get('bookmarks.users.selves.update-form', route('users.selves.view')) }}">
                <button type="button">Cancel</button>
            </a>
        </div>
    </form>
@endsection
