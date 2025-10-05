@extends('products.main', [
    'title' => $product->code,
    'titleClasses' => ['app-cl-code'],
])

@section('content')
    <form action="{{ route('products.update', [
        'product' => $product->code,
    ]) }}" method="post">
        @csrf

        <div class="app-cmp-form-detail">
            <label for="app-inp-code">Code</label>
            <input type="text" id="app-inp-code" name="code" value="{{ old('code', $product->code) }}" required
                class="app-cl-code" />

            <label for="app-inp-name">Name</label>
            <input type="text" id="app-inp-name" name="name" value="{{ old('name', $product->name) }}" required />

            <label for="app-inp-category">Category</label>
            <select id="app-inp-category" name="category" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->code }}" @selected($category->code === old('category', $product->category->code))>[{{ $category->code }}]
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <label for="app-inp-price">Price</label>
            <input type="number" id="app-inp-price" name="price" value="{{ old('price', $product->price) }}"
                step="any" required />

            <label for="app-inp-description">Description</label>
            <textarea id="app-inp-description" name="description" cols="80" rows="10" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="app-cmp-form-actions">
            <button type="submit" class="app-cl-primary app-cl-filled">
                <i class="material-symbols-outlined">save</i>
                Update
            </button>
            <a href="{{ route('products.view', [
                'product' => $product->code,
            ]) }}">
                <button type="button" class="app-cl-warn app-cl-filled">
                    <i class="material-symbols-outlined">cancel</i>
                    Cancel
                </button>
            </a>
        </div>
    </form>
@endsection
