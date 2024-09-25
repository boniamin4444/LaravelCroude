@extends('layouts.app')
<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
</head>
<body>



@section('content')

<div class="container mt-5">
        @if(Session::has('message'))
            <div class="alert alert-warning">
                {{session('message')}}
            </div>
        @endif
    </div>
    
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Product List</h2>
            
            @if ($products->count())
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->product_name }}">
                                @else
                                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->product_name }}</h5>
                                    <p class="card-text">
                                        <strong>Category:</strong> {{ $product->category ? $product->category->category_name : 'No Category' }}<br>
                                        <strong>Price:</strong> ${{ number_format($product->price, 2) }}<br>
                                        <strong>Stock:</strong> {{ $product->stock }}<br>
                                        <span class="badge {{ $product->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($product->status) }}
                                        </span>
                                    </p>
                                 
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination links -->
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            @else
                <div class="alert alert-warning">
                    No products found.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection


  

</body>
</html>