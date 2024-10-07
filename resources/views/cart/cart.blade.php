@extends('layouts.app')
@section('content')

<div class="container mt-5">
	<h2>Cart</h2>
	<a href="{{ url('/') }}" class="btn btn-warning btn-sm">
		Back
	</a>
	@if(session('cart'))
		<table class="table table-bordered">
			<thead>
				<tr>
				<th>Product name</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Total</th>
				<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach(session('cart') as $id => $details)
					<tr>
						<td>{{ $details['name'] }}</td>
						<td>{{ $details['quantity'] }}</td>
						<td>{{ $details['price'] }}</td>
						<td>{{ $details['price'] * $details['quantity'] }}</td>

						<td>
							<button class="btn btn-danger remove-from-cart" data-id="{{ $id }}">Remove</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<h3>Total: ${{ array_reduce(session('cart'), function($carry, $item){
			return $carry + $item['price'] * $item['quantity'];
		},0) }}</h3>

		<form method="post" action="{{ route('cart.clear') }}">
			@csrf
			<button type="submit" class="btn btn-warning">Clear Cart</button>
		</form>
	@else
	<h3>Your Cart is Empty</h3>
	@endif
</div>
@endsection