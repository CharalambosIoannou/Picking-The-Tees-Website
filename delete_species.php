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


$sql = "DELETE FROM inv_species WHERE SpecID= $id_toDelete";

if ($conn->query($sql) === TRUE) {
    header('Location: ReviewSpecies.php');
exit;
} else {
    header('Location: ReviewSpecies.php');
exit;
}

$conn->close();

?>
