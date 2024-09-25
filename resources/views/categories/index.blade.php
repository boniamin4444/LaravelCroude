@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create New Category</a>

    <div class="list-group">
        @foreach ($categories as $category)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $category->category_name }}</span>
                <div>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
