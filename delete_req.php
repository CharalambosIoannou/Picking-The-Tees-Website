<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "rivertees";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id_toDelete= $_POST['reject'];


$sql = "DELETE FROM request WHERE RequestID= $id_toDelete";

if ($conn->query($sql) === TRUE) {
    header('Location: ReviewRequests.php');
    exit;
} else {
    header('Location: ReviewRequests.php');
    exit;
}

$conn->close();
header('Location: ReviewRequests.php');
exit;
?>
