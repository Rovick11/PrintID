<?php 
include('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<style>
	.header {
		background: #003366;
	}
	button[name=register_btn] {
		background: #003366;
	}
	</style>
</head>
<body>
	<div class="header">
		<h2>Admin - Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<div class="profile_info">
			<img src="../images/admin_profile.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="home.php?logout='1'" style="color: red;">logout</a>
                       &nbsp; <a href="create_user.php"> + add user</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>

	<form>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<?php

			$result = mysqli_query($db, "SELECT * FROM users WHERE user_type != 'admin'");

		?>

		<table class="data">
			<thead>
				<tr>
					<th width="5%">ID</th>
					<th width="15%%">Name</th>
					<th width="15%">Course</th>
					<th width="15%">Birthday</th>
					<th width="15%">Address</th>
					<th width="20%">Guardian</th>
					<th width="15%">Contact Number</th>
					<th width="15%">View ID</th>
					<th width="20%">ID Request</th>

				</tr>
			</thead>

			<tbody>
				<?php
					while ($row = mysqli_fetch_array($result)){

						$req = $row['request']
				?>

			<tr>
				<td><?php echo $row["id"]; ?></td>
				<td><?php echo $row["username"]; ?></td>
				<td><?php echo $row["course"]; ?></td>
				<td><?php echo $row["birthday"]; ?></td>
				<td><?php echo $row["address"]; ?></td>
				<td><?php echo $row["guardian"]; ?></td>
				<td><?php echo $row["contact_num"]; ?></td>
				<td>
					<a href="../viewid.php?id=<?php echo $row['id']; ?>" target="_blank" class="btn btn-primary">View</a>
				</td>
				<?php if($req==0){ ?>
					<td>
						<h3 style="font-family: Arial; font-size: 12px;">No Request</h3>
					</td>
				<?php } else { ?>
					<td>
						<a href="acceptreq.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Accept</a><br>
						<a href="decline.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Decline</a>
					</td>
				
				<?php } ?>
					

			</tr>
				<?php
				}  
			?>
			</tbody>
		</table>
	</form>
</body>
</html>