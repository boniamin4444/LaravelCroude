@component('mail::message')
# New Product Added: {{$productName}}

A new Product has been added to our stock. Check it out now!

@component('mail::panel')
<img src="{{$productImageUrl}}" alt="{{$productName}}" style="max-width:100%">

@endcomponent

@component('mail::button', ['url' => 'http://localhost:8000/product-details/'.$product->id])

View Product
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
