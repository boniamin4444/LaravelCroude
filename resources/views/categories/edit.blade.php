@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Categories</h2>

    
    <form action="{{ route('categories.update', $category) }}" method="POST" class="mb-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name{{ $category->id }}" class="form-label">Category Name:</label>
            <input type="text" name="category_name" id="name{{ $category->id }}" class="form-control" value="{{ old('category_name', $category->category_name) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
  
</div>
@endsection
