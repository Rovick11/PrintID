<?php
include('../functions.php');

	if(isset($_GET['id'])){
		$id=$_GET['id'];

		$result = mysqli_query($db, "SELECT * FROM users WHERE id != '$id'");

		$sql="UPDATE users SET request = '0', accepted = '1' WHERE id= '$id'";

		if(mysqli_query($db,$sql)){
				header('location:home.php');
		}
	}
	