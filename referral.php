<?php
// Connect to database
$conn = mysqli_connect('localhost', 'username', 'password', 'database');

if (!$conn) {
	die('Connection failed: '. mysqli_connect_error());
}

// Get referral link from URL parameter
$referral_link = $_GET['ref'];

// Check if referral link is valid
$query = "SELECT * FROM users WHERE referral_link = '$referral_link'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $referrer_id = mysqli_fetch_assoc($result)['id'];
    
    // Register new user
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
      
      $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
      mysqli_query($conn, $query);
      
      $new_user_id = mysqli_insert_id($conn);
      
      // Add referral to database
      $query = "INSERT INTO referrals (user_id, referred_user_id) VALUES ('$referrer_id', '$new_user_id')";
      mysqli_query($conn, $query);
      
      // Update referrer's balance
      $query = "UPDATE users SET balance = balance + 5 WHERE id = '$referrer_id'";
      mysqli_query($conn, $query);
      
      // Redirect to dashboard
      header('Location: dashboard.php');
      exit;
    }
  }
  
  mysqli_close($conn);
  ?>