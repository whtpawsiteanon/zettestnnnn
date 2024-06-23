<?php
// Connect to database
$conn = mysqli_connect('localhost', 'username', 'password', 'database');

if (!$conn) {
	die('Connection failed: '. mysqli_connect_error());
}

// Get user information
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Display referral link and balance
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<style>
		body {
			font-family: Arial, sans-serif;
		}
	</style>
</head>
<body>
	<h1>Dashboard</h1>
	<p>Your referral link is: <a href="<?php echo $user['referral_link']?>"><?php echo $user['referral_link']?></a></p>
	<p>Your current balance is: $<?php echo $user['balance']?></p>
</body>
</html>