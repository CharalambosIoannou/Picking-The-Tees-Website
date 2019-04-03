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
//$media_path =  $_FILES["photo"]["tmp_name"];/*addslashes(file_get_contents($_FILES["image"]["tmp_name"]));/* ($_FILES['media']['tmp_name'][0]);*/
$addDesc= $_POST['description'];
$date = $_POST['date'];
$long=$_POST['marker-lng'];
$lat=$_POST['marker-lat'];
$bag=$_POST['bag'];
$hour=$_POST['hour'];
$people=$_POST['people'];

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

$litter="";
foreach ($_POST['litter'] as $selected) {
            $litter=$selected.",".$litter;
        }
$litter = rtrim($litter, ',');


if ($_FILES['fileToUpload']['name'] != ""){
	$uploadOk = 1;
}else {
	$uploadOk = 0;
}



move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], $target_dir . basename($_FILES['fileToUpload']['name'] ) );


if(isset($_POST["insert"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["image"]["size"] > 5000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType == "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {

	if($_FILES["fileToUpload"]["size"] == 0)
{

	$uploadOk = 1;
}else {

    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {

		$target_file="uploads/no_img.jpg";
		$sql = "INSERT INTO comppick( title,name,phone,email,addDesc,date,lng,lat, litter, bag,hour,people,photoURL )
		VALUES ( '$title', '$name', '$phoneNumb', '$email','$addDesc', '$date', '$long','$lat', '$litter', '$bag','$hour', '$people', '$target_file') ;";

if ($conn->query($sql) === TRUE) {

        echo "<script>
            alert('Your litter picking action has been submitted successfully.')
            location.href='submissionForm.html'
        </script>";

	} else {
        echo "<script>
            alert('Sorry, there was an error submitting your form.')
            location.href='submissionForm.html'
        </script>";
    }


// if everything is ok, try to upload file
}else {

		$sql = "INSERT INTO comppick( title,name,phone,email,addDesc,date,lng,lat, litter, bag,hour,people,photoURL )
		VALUES ( '$title', '$name', '$phoneNumb', '$email','$addDesc', '$date', '$long','$lat', '$litter', '$bag','$hour', '$people', '$target_file') ;";

if ($conn->query($sql) === TRUE) {

        echo "<script>
            alert('Your litter picking action has been submitted successfully.')
            location.href='submissionForm.html'
        </script>";

	} else {
        echo "<script>
            alert('Sorry, there was an error submitting your form.')
            location.href='submissionForm.html'
        </script>";
    }


}

$conn->close();

?>
