<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bitfumes Paypal Payment Integration</title></title>
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom Css -->
    <style>
    	form, input{
    		color: #fff;
    		font-family: cursive;
    	}
    	button{
    		display: block;
    		margin-top: 10px;
    	}
    	body{
    		background-image: url(http://www.sdjgjx.com/up/pc/background%20hd.jpg);
    		background-position: center center;
    		background-size: cover;
    		height: 600px;
    	}
    	input{
    		background-color: transparent !important;
    		margin: 10px 0px 20px 0px;
    	}
    	.session-message-area{
    		margin-top: 150px;
    	}
    </style>
</head>
<body>
    <div class="container"> 
    	<div class="row">
    		<div class="col-md-8 offset-md-2 session-message-area">
    			@php
    				$success = Session::get('success');
    				$error = Session::get('error');
    			@endphp
    			@if(Session::has('success'))
    				<div class="alert alert-success" role="alert">
    					{{ $success }}
    				</div>
    			@endif
    			@if(Session::has('error'))
    				<div class="alert alert-danger" role="alert">
    					{{ $error }}
    				</div>
    			@endif
    		</div>
    		<div class="col-md-8 offset-md-2">
    			<form action="{{ route('create-payment') }}">
    				<div class="form-group">
    					<label for="paypal">Enter your payment amount</label>
    					<input id="paypal" class="form-control" type="text" name="amount">
    			    	<button class="btn btn-danger" type="submit">Pay with Paypal</button>
    				</div>
    			</form>
    		</div>
    	</div>
    </div>
    @php
    	Session::forget('success');
    	Session::forget('error');
    @endphp
</body>
</html>