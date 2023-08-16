<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body style="background:#6375eb; color:white; padding:24px; border-radius:20px">
		
		<h2 style="text-align:center;">
			<img src="{{ $message->embed('src/images/logo.png') }}" style="width:400px; height:100px; object-fit: cover;" onerror="this.src='{{url('/noImg.png')}}'">
		</h2>
<h2 style="text-align:center;color: white;">Reset Password</h2>

 		<p style="margin-bottom:30px; color:white; display: block; text-align: center;"> 
 			A request has been recieved to change the password of your account
 		</p>
 		<p style="margin:auto;">
 			<h4 style="text-align:center;"><button style="background:#5bc0de; border: none; padding-right: 24px; padding-left:24px; padding-top:5px; padding-bottom:5px"><a href="{{$button_link}}" style="text-decoration: none;color: white; font-size: 15px;">Reset Password</a></button>
 				</h4>
 		</p>
 		<br>
 		<hr>

 		<p style="width: 400px; margin:auto;word-wrap: break-word; color:white; text-align:center;">
		If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: <a href="{{$button_link}}" style="width: 400px; color:#5bc0de">{{$button_link}}</a>
		</p>



</body>
</html>