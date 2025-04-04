<?php
	echo "hello world",'<br>';
	$x = 5;
	$y = 7;
	echo "First number: ", $x,'<br>';
	echo "Second number: ", $y, '<br>';
	echo "The sum is: ", $x + $y,'<br>';
?>

<html>
	<head>
		<title> Hello PHP </title>
	</head>

	<body>
		<form action="dashboard.php" method="POST">
			Name: <input type="text" name="name" placeholder="Please enter your name here"><br>
		</form>

		<button id="login"> Login </button>
	</body>

	<script src="../scripts/login.js"></script>
</html>
