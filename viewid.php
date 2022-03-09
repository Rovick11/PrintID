<?php
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');

} 
$id = $_GET['id'];
$result = mysqli_query($db, "SELECT * FROM users WHERE id='$id'");
    $user = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>ID VIEWER</h2>
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
			<img src="images/<?php echo $_SESSION['user']['id']?>.png" style="width:60px;height:70px;" />
			<br><br>
            <strong style="font-family: TNR; font-size: 20px;"><?php echo $_SESSION['user']['username']; ?></strong>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<a href="index.php?logout='1'" style="color: red;">logout</a>
						<br>
			
		</div>
	</div>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<div id="view" style="padding-left:210px; padding-bottom: 40px">
            <form class="frontcard" style="float:left;">
            <img src="images/<?php echo $user['id']?>.png" alt="picture" style="width:100%">
            <h1><?php echo $user['username']; ?></h1>
            <p class="title">Student</p>
            <p>CPUniversity</p>
            <h4><?php echo $user['course']; ?></h4>
            </form>
            
            <form class="backcard" style="float:left;">
            <img src="logo.png" alt="picture" style="width:84%">
            <h4>Address</h4>
            <small><?php echo $user['address']; ?></small>
            <br><br>
            <h4>Contact No.</h4>
            <small><?php echo $user['contact_num']; ?></small>
            <br>
            </form>  
        </div>
    <div style="padding-left:210px;">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <button class="printButton" onClick='window.print()'>Print ID</button>
            <style>
            @media print {
                .printButton,
                .header, .content {
                display: none !important;
             }
  }
</style>
    </div>
</body>
</html>

