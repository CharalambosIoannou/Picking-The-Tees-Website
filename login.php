<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "rivertees";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error)
{
 die("Connection failed: " . $conn->connect_error);

}


if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $username = trim($_POST["email"]);
  $password = trim($_POST["password"]);

  $sql = "SELECT Userid FROM user WHERE Email = '$username' and password = '$password'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $active = $row['active'];
  $count = mysqli_num_rows($result);


  if($count == 1)
  {
    #session_register("username");
    #$_SESSION['login_user'] = $username;
	session_start();
    $_SESSION['loggedin'] = true;
    header('Location: dashboard.php');
	exit;
   }
  else
  {
    echo "<script>
	alert('Invalid Credentials');
	window.location.href='login.html';
	
	</script>";
  }

}

