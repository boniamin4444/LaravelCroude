<!DOCTYPE html>
<html>
<head>
	<title>@yield('title','cogent')</title>
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <a class="navbar-brand" href="{{url('/')}}">cogent</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
    	@guest
    		<li class="nav-item">
    			<a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
    		</li>
    		<li class="nav-item">
    			<a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a>
    		</li>
    	@endguest

    	@auth
    	<li class="nav-item">
    	<a class="nav-link" href="{{route('products.index')}}">Products</a>
    	</li>
    	<li class="nav-item">
    		<form id="logout-form" action="{{route('logout')}}" method="post" class="d-none">
    			@csrf    			
    		</form>
    		<a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout({{ Auth::user()->name }})
    		</a>
    	</li>
    	@endauth     

    </ul>
  </div>
 </div>
</nav>

<div class="container mt-4">

	@yield('content')

</div>

<!--Login Modal -->

<div class="modal fade" id="loginModal" tabindex="-1" @if(session('login_errors')) style="display:block;" @endif>

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>         
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('login.post')}}" method="post">
        	@csrf
        	<div class="form-group mb-3">
        		<label>Email Address:</label>
        		<input type="text" name="email" class="form-control" value="{{ old('email')}}">
        	</div>
        	<div class="form-group mb-3">
        		<label>Password:</label>
        		<input type="password" name="password" class="form-control">
        	</div>

        	<!-- Display error -->

        	@if(session('login_errors'))
        		<div class="alert alert-danger alert-dismissible fade show" role="alert">
        			{{ session('login_errors')}}
        			<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        		</div>
        	@endif

        	<button type="submit" class="btn btn-primary">Login</button>
	       </form>
      </div>      
    </div>
  </div>
</div>

<!--Register Modal -->

<div class="modal fade" id="registerModal" tabindex="-1">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Register</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('register.post')}}" method="post">
        	@csrf
        	<div class="form-group mb-3">
        		<label>User Name:</label>
        		<input type="text" name="name" class="form-control @error('name','register') is-invalid @enderror" name="name" value="{{ old('name')}}">

        		@error('name','register')
        			<div class="invalid-feedback">
        				{{ $message }}
        			</div>
        		@enderror
        	</div>

        	<div class="form-group mb-3">
        		<label>Email:</label>
        		<input type="text" name="email" class="form-control @error('email','register') is-invalid @enderror" name="email" value="{{ old('email')}}">

        		@error('email','register')
        			<div class="invalid-feedback">
        				{{ $message }}
        			</div>
        		@enderror
        	</div>
        	<div class="form-group mb-3">
        		<label>Password:</label>
        		<input type="password" class="form-control @error('password','register') is-invalid @enderror" name="password">

        		@error('password','register')
        			<div class="invalid-feedback">
        				{{ $message }}
        			</div>
        		@enderror
        	</div>

        	<div class="form-group mb-3">
        		<label>Confirm Password:</label>
        		<input type="password" name="password_confirmation" class="form-control @error('password_confirmation','register') is-invalid @enderror">

        		@error('password_confirmation','register')
        			<div class="invalid-feedback">
        				{{ $message }}
        			</div>
        		@enderror
        	</div>

        	<button type="submit" class="btn btn-primary">Register</button>        	
	       </form>
      </div>      
    </div>
  </div>
</div>

<footer class="bg-light py-4 mt-5">
	<div class="container text-center">
		<p class="mb-0">
			&copy; {{date('Y')}} cogent. All rights reserved.
		</p>
	</div>
</footer>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
	window.addEventListener('DOMContentLoaded', (event)=>{

		const alertElement = document.querySelectorAll('.alert');
		
		if(alertElement.length > 0)
		{
			alertElement.forEach(function(alert)
			{
			setTimeout(()=>{
			bootstrap.Alert.getOrCreateInstance(alert).close();
				}, 5000);
			});

		}

		@if(session('login_errors'))
		
			var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
			loginModal.show();
		@endif

		@if($errors->register->any())		
			var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
			registerModal.show();
		@endif
		
	});

</script>
<script>
	document.addEventListener('DOMContentLoaded', function(){
		@if(session('showLoginModal'))

			var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));

			loginModal.show();
		@endif
	});
</script>
</body>
</html>