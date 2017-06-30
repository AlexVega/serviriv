<?php 
	$db = mysqli_connect('localhost','d2ada3c197ab', '7503cf645e45f40e', 'infriserdbcontact'); 

	if(mysqli_connect_errno())
	{
		echo 'Failed to connect to MySQL: '.mysqli_connect_error();
	}
 ?>