<?php

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
{

$servername = "localhost";
$username1 = "root";
$password = "root";
$dbname = "rivertees";

// Create connection
$conn = new mysqli($servername, $username1, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$password1 = mysqli_real_escape_string($conn, $_POST['password']);
$password2 = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
//$username = mysqli_real_escape_string($conn, $_SESSION['username']);
echo $password1;
echo $password2;


if ($password1 <> $password2)
{
      echo "<script>
            alert('Could not change password')
            location.href='dashboard.php'
        </script>";
}
else if (mysqli_query($conn, "UPDATE user SET Password='$password1' WHERE Username='admin'"))
{
    echo "<script>
            alert('Successfully changed the password')
            location.href='dashboard.php'
        </script>";
}

}
else
{
    mysqli_error($conn);
}
mysqli_close($conn);

?>