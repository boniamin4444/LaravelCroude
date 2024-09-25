@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Create New Category</h2>
    
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Category Name:</label>
            <input type="text" name="category_name" id="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
