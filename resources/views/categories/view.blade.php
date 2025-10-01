@extends('categories.main', [
    'title' => $category->code,
    'titleClasses' => ['app-cl-code'],
])

@section('header')
    <nav>
        <form action="{{ route('categories.delete', [
            'category' => $category->code,
        ]) }}" method="post"
            id="app-form-delete">
            @csrf
        </form>

        <ul class="app-cmp-links">
            @php
                session()->put('bookmarks.categories.view-products', url()->full());
            @endphp

            <li>
                <a href="{{ session()->get('bookmarks.categories.view', route('categories.list')) }}">
                    <i class="material-symbols-outlined">chevron_backward</i>
                    Back
                </a>
            </li>
            <li>
                <a
                    href="{{ route('categories.view-products', [
                        'category' => $category->code,
                    ]) }}">
                    <i class="material-symbols-outlined">list</i>
                    View Products
                </a>
            </li>
            @can('update', $category)
                <li class="app-cl-filled">
                    <a
                        href="{{ route('categories.update-form', [
                            'category' => $category->code,
                        ]) }}">
                        <i class="material-symbols-outlined">edit_square</i>
                        Update
                    </a>
                </li>
            @endcan
            @can('delete', $category)
                <li class="app-cl-warn app-cl-filled">
                    <button type="submit" form="app-form-delete" class="app-cl-link">
                        <i class="material-symbols-outlined">delete_forever</i>
                        Delete
                    </button>
                </li>
            @endcan
        </ul>
    </nav>
@endsection

@section('content')
    <dl class="app-cmp-data-detail">
        <dt>Code</dt>
        <dd>
            <span class="app-cl-code">{{ $category->code }}</span>
        </dd>

        <dt>Name</dt>
        <dd>
            {{ $category->name }}
        </dd>
    </dl>

    <pre>{{ $category->description }}</pre>
@endsection
