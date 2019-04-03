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

$title=$_POST['title'];
$name=$_POST['name'];
$phoneNumb=$_POST['phone'];
$email=$_POST['email'];
$addDesc= $_POST['description'];
$date = date('Y-m-d H:i:s');
$long=$_POST['marker-lng'];
$lat=$_POST['marker-lat'];

if ($addDesc == ""){
	$addDesc="No additional information provided by the user";
}

if ($phoneNumb == ""){
	$phoneNumb="No phone number provided by the user";
}


if ($email == ""){
	$email="No email provided by the user";
}



$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], $target_dir . basename($_FILES['fileToUpload']['name'] ) );


$species="";
foreach ($_POST['species'] as $selected) {
            $species=$selected.",".$species;
        }
$species = rtrim($species, ',');


if ($_FILES['fileToUpload']['name'] != ""){
	$uploadOk = 1;
}else {
	$uploadOk = 0;
}

if ($uploadOk == 0) {

		$target_file="uploads/no_img.jpg";
		$sql = "INSERT INTO inv_species( title,name,phone,email,addDesc,date,lng,lat, species,photoURL )
		VALUES ( '$title', '$name', '$phoneNumb', '$email','$addDesc', '$date', '$long','$lat', '$species','$target_file') ;";

    // if everything is ok, try to upload file
        if ($conn->query($sql) === TRUE) {
    
            echo "<script>
                alert('The alien invaders have been reported successfully.')
                 location.href='alienInvadar.html'
            </script>";
    
    	} else {
            echo "<script>
                alert('Sorry, there was an error submitting your form1234.')
                 location.href='alienInvadar.html'
            </script>";
        }
    }else {
    
    	$sql = "INSERT INTO inv_species( title,name,phone,email,addDesc,date,lng,lat, species,photoURL )
    	VALUES ( '$title', '$name', '$phoneNumb', '$email','$addDesc', '$date', '$long','$lat', '$species','$target_file') ;";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                alert('The alien invaders have been reported successfully.')
                location.href='alienInvadar.html'
            </script>";
    	} else {
    	    echo "failed to insert".$sql."<br>".mysqli_error($conn);
            echo "<script>
                alert('Sorry, there was an error submitting your form1234.')
                location.href='alienInvadar.html'
            </script>";
        }
}

$conn->close();
?>
