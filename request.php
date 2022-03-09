<?php
include('functions.php');

			if (isset($_SESSION['user'])) {
			$_POST['username'] = $_SESSION['user']['username'];
			$user = $_POST['username'];
		}
			$result = mysqli_query($db, "SELECT * FROM users WHERE username = '$user'");

			if ($_SESSION["user"]['username']) {
				// code...

				$sql="UPDATE users SET request = '1', accepted = '0' WHERE username= '$user'";

				if (mysqli_query($db,$sql)) {
					// code...
					header('location:index.php');
				}
			?>	

		<?php
		}	
	?>	
	