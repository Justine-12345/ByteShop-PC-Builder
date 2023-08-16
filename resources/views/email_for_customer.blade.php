<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body style="background:#6375eb; color:white; padding:24px;border-radius:20px">
	<h2 style="text-align:center;">
			<img src="{{ $message->embed('src/images/logo.png') }}" style="width:400px; height:100px; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
		</h2>
<h2>Order Status</h2>
<h3>
	@php
	 $totalPrice = 0;
	@endphp
	Status: <b>{{$order->status}}</b><br>
	Code: <b>{{$order->code}}</b><br>
</h3>
<hr>
 @foreach($order->items as $item)
 @php
$result = file_exists( public_path() . '/src/images/products/'.$item->image);
              
 @endphp
 		<p style="margin-bottom:30px; color:white"> 

 			<img src="{{$result == true? $message->embed('src/images/products/'.$item->image):$message->embed(url('/noImg.png'))  }}" style="width:200px; height:200px; object-fit: cover;">
 			<br>
 		    <span style="color:white">Name: <b>{{$item->title}}</b></span><br>
 		    <span style="color:white">Quantity: <b>{{$item->pivot->quantity}}</b></span><br>
 		 	<span style="color:white">Price: <b>₱ {{ number_format($item->price,2,'.',",")}}</b></span><br>
 		 	<span style="color:white">Total: <b>₱ {{ number_format($item->price * $item->pivot->quantity,2,'.',",")}}</b></span><br>
 		 	@php
 		 		$total =$item->price * $item->pivot->quantity;
 		 		$totalPrice += $total; 
 		 	@endphp
 		 	<hr>
 		</p>
 @endforeach
 <h3 style="color:white">Total Price : ₱ {{ number_format($totalPrice,2,'.',",")}}</h3>
</body>
</html>