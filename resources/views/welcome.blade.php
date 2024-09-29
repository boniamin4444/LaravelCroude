@extends('layouts.app')
<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .product-card img {
            height: 200px;
            object-fit: cover;
        }

        .card-footer {
            background: none;
            border-top: none;
            text-align: left;
        }

        .progress {
            height: 20px;
            margin-top: 10px;
        }

        .progress-bar {
            background-color: #007bff; /* Change color as needed */
        }
    </style>
</head>
<body>

@section('content')

<div class="container mt-5">
    <div class="row">
        @if(Session::has('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif

        <!--Category Section -->        
        <div class="col-md-3">
            <h5>Filter by Categories</h5>
            <form id="categoryFilterForm">
                @foreach($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input category-checkbox" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category-{{ $category->id }}">
                        <label class="form-check-label" for="category-{{ $category->id }}">
                            {{ $category->category_name }}
                        </label>
                    </div>
                @endforeach
            </form>

            <h5>Filter by Price</h5>
            <input type="range" min="0" max="1000" value="500" id="priceRange" class="form-range">
            <div id="priceValue">Price: $500</div>
            <div class="progress">
                <div id="priceProgress" class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="500" aria-valuemin="0" aria-valuemax="1000"></div>
            </div>
        </div>

        <!-- Products Section -->
        <div class="col-md-9">
            <div id="productsList" class="row">
                @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product_name }}" width="250">
                        @else
                            No Image
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($product->details, 100) }}</p>
                            <p><strong>Price:</strong> ${{ $product->price }}</p>
                            <p><strong>Status:</strong>
                                <span class="badge {{ $product->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </p>
                            <div class="card-footer">
                                <button class="btn btn-primary order-now-btn" data-product="{{ json_encode($product) }}">Order Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="loginModal">
    <style>
        .modal-header {
            background-color: #f8f9fa; /* Light background for the header */
        }
        
        .modal-title {
            color: #007bff; /* Custom color for the title */
        }
        
        .mt-2 a {
            color: #007bff; /* Link color */
            font-weight: bold; /* Bold text for link */
        }
        
        .mt-2 a:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                    <div class="mt-2">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript">
    let selectedProduct = null;

    $(document).on('click', '.order-now-btn', function() {
        selectedProduct = $(this).data('product');
        $('#loginModal').modal('show');
    });

    // Handle login form submission
    $('#loginModal').on('submit', function(event) {
        event.preventDefault();

        // Perform AJAX request for login
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    $('#loginModal').hide();
                    if (selectedProduct) {
                        console.log('Ordered Products are:', selectedProduct);
                    }
                    selectedProduct = null;
                } else {
                    console.error('Login Failed');
                }
            },
            error: function(xhr) {
                console.error('Login Failed');
            }
        });
    });

    // Price range filter and progress bar
    $(document).ready(function() {
        $('#priceRange').on('input', function() {
            const value = this.value;
            $('#priceValue').text(`Price: $${value}`);
            const maxValue = this.max;
            const percentage = (value / maxValue) * 100;
            $('#priceProgress').css('width', percentage + '%').attr('aria-valuenow', value);
        });

        // Handle category and price filtering
        $('.category-checkbox, #priceRange').change(function() {
            let selectedCategories = [];
            $('.category-checkbox:checked').each(function() {
                selectedCategories.push($(this).val());
            });

            const selectedPrice = $('#priceRange').val();

            $.ajax({
                url: '{{ route("products.filter") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    categories: selectedCategories,
                    price: selectedPrice
                },
                success: function(response) {
                    $('#productsList').empty();

                    if (response.length > 0) {
                        response.forEach(function(product) {
                            let productCard = `
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="${product.image ? '/storage/' + product.image : 'No Image'}" class="card-img-top" alt="${product.product_name}">
                                        <div class="card-body">
                                            <h5 class="card-title">${product.product_name}</h5>
                                            <p class="card-text">${product.details.substring(0, 100)}</p>
                                            <p><strong>Price:</strong> $${product.price}</p>
                                            <p><strong>Status:</strong>
                                                <span class="badge ${product.status === 'active' ? 'badge-success' : 'badge-danger'}">
                                                    ${product.status.charAt(0).toUpperCase() + product.status.slice(1)}
                                                </span>
                                            </p>
                                            <div class="card-footer">
                                                <button class="btn btn-primary order-now-btn" data-product='${JSON.stringify(product)}'>Order Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            $('#productsList').append(productCard);
                        });
                    } else {
                        $('#productsList').append('<p>No products found for the selected filters.</p>');
                    }
                }
            });
        });
    });
</script>
</body>
</html>
