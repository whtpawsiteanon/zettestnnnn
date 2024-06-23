<?php
// Connect to database
$conn = mysqli_connect('localhost', 'username', 'password', 'database');

if (!$conn) {
	die('Connection failed: '. mysqli_connect_error());
}

// Register user
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	
	$query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
	mysqli_query($conn, $query);
	
	$user_id = mysqli_insert_id($conn);
	
	// Generate referral link
	$referral_link = 'https://zetwallet.ru/register.php?ref='. $user_id;
	
	$query = "UPDATE users SET referral_link = '$referral_link' WHERE id = $user_id";
	mysqli_query($conn, $query);
	
	// Redirect to dashboard
	header('Location: dashboard.php');
	exit;
}

mysqli_close($conn);
?>