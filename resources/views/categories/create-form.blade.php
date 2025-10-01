@extends('categories.main', [
    'title' => 'Create',
    'mainClasses' => ['app-ly-max-width'],
])

@section('content')
    <form action="{{ route('categories.create') }}" method="post">
        @csrf

        <div class="app-cmp-form-detail">
            <label for="app-inp-code">Code</label>
            <input type="text" id="app-inp-code" name="code" required class="app-cl-code" />

            <label for="app-inp-name">Name</label>
            <input type="text" id="app-inp-name" name="name" required />

            <label for="app-inp-description">Description</label>
            <textarea id="app-inp-descruotuib" name="description" cols="80" rows="10" required></textarea>
        </div>

        <div class="app-cmp-form-actions">
            <button type="submit" class="app-cl-primary app-cl-filled">
                <i class="material-symbols-outlined">save</i>
                Create
            </button>
            <a href="{{ session()->get('bookmarks.categories.create-form', route('categories.list')) }}">
                <button type="button" class="app-cl-warn app-cl-filled">
                    <i class="material-symbols-outlined">cancel</i>
                    Cancel
                </button>
            </a>
        </div>
    </form>
@endsection
