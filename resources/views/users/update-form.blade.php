@extends('users.main', [
    'title' => $user->email,
    'titleClasses' => ['app-cl-code'],
    'mainClasses' => ['app-ly-max-width'],
])

@section('content')
    <form action="{{ route('users.update', [
        'user' => $user->email,
    ]) }}" method="post">
        @csrf

        <div class="app-cmp-form-detail">
            <label for="app-inp-email">Email</label>
            <output id="app-inp-email" class="app-cl-code">{{ $user->email }}</output>

            <label for="app-inp-name">Name</label>
            <input type="text" id="app-inp-name" name="name" value="{{ $user->name }}" required />

            <label for="app-inp-role">Role</label>
            @can('updateRole', $user)
                <select id="app-inp-role" name="role" required class="app-cl-code">
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" @selected($user->role === $role)>{{ $role }}</option>
                    @endforeach
                </select>
            @else
                <output id="app-inp-role" class="app-cl-code">{{ $user->role }}</output>
            @endcannot

            <label for="app-inp-password">Password</label>
            <input type="password" id="app-inp-password" name="password"
                placeholder="Leave blank if yout don&apos;t need to update" />
        </div>

        <div class="app-cmp-form-actions">
            <button type="submit" class="app-cl-primary app-cl-filled">
                <i class="material-symbols-outlined">save</i>
                Update
            </button>
            <a
                href="{{ session()->get(
                    'bookmarks.users.update-form',
                    route('users.view', [
                        'user' => $user->email,
                    ]),
                ) }}">
                <button type="button" class="app-cl-warn app-cl-filled">
                    <i class="material-symbols-outlined">cancel</i>
                    Cancel
                </button>
            </a>
        </div>
    </form>
@endsection
