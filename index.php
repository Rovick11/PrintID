<?php
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
} ?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
	<div class="header">
		<h2>Home Page</h2>
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
			<img src="images/<?php echo $_SESSION['user']['id']?>.png" style="width:220px;height:250px;" />

			<div>
				<?php  if (isset($_SESSION['user'])){
				    $username = $_SESSION['user']['username'];
					?>
    
					<strong style="font-family: TNR; font-size: 35px;"><?php echo $_SESSION['user']['username']; ?></strong>
                
					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<a href="index.php?logout='1'" style="color: red;">logout</a>
						<br>
						<?php
							$result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");		
						?>

						<label><b>Course: </b></label>

						<?php
							while ($row = mysqli_fetch_array($result)){
								$cor=$row['course'];
								echo $cor;
							}
						  ?>

						  <br>

						  <label><b>Birthday: </b></label>

						<?php
							$result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");	

							while ($row = mysqli_fetch_array($result)){
								$bday=$row['birthday'];
								echo $bday;
							}
						  ?>

						  <br>

						  <label><b>Address: </b></label>

						<?php
							$result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");	

							while ($row = mysqli_fetch_array($result)){
								$add=$row['address'];
								echo $add;
							}
						  ?>

						  <br>

						  <label><b>Guardian: </b></label>

						<?php
							$result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");	

							while ($row = mysqli_fetch_array($result)){
								$guar=$row['guardian'];
								echo $guar;
							}
						  ?>

						  <br>

						  <label><b>Contact Number: </b></label>

						<?php
							$result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");	

							while ($row = mysqli_fetch_array($result)){
								$con=$row['contact_num'];
								echo $con;
							}
						  ?>

						  <br>
						  <?php $result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'"); ?>

						  <table class="data">

								<tbody>
									<?php
										while ($row = mysqli_fetch_array($result)){
									?>
								<tr>
								    <div id="request" <?php if ($row['request']==0 && $row['accepted']==0){echo " style='display: none';"; ?>>
								        <td><a href="request.php" id="request" onclick='window.location.reload(true);' class="btn btn-primary">Request ID</a></td>
								        <?php } ?>
								    </div>
								    <div id="requested" <?php if ($row['request']==1 && $row['accepted']==0){echo " style='display: none';"; ?>>
								        <td><a href="" id="requested" class="btn btn-secondary">Requested</a></td>
								         <?php } ?>
								    </div>
								    <div id="view" <?php if ($row['request']==0 && $row['accepted']==1){echo " style='display: none';"; ?>>
								        <td><a href="../viewid.php?id=<?php echo $row['id']; ?>" class="btn btn-success">View ID</a></td>
								        <?php } ?>
								    </div>
								</tr>
							<?php } } ?>

					</small>
			</div>
		</div>
	</div>
</body>
</html>