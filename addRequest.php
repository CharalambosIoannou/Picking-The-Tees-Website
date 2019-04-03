<?php
/*
$servername = "localhost";
$username = "id8730343_rivertees";
$password = "rivertees";
$dbname = "id8730343_rivertees";
*/
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
$litterScale=$_POST['scale'];
$long=$_POST['marker-lng'];
$lat=$_POST['marker-lat'];
//$media_path = ($_FILES['media']['tmp_name'][0]);
$addDesc= $_POST['description'];

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

//echo $title . "<br>". $name . "<br>". $phoneNumb. "<br>". $email . "<br>". $litterScale. "<br>". $addDesc. "<br>". $target_file . "<br>". $lat . "<br>". $long;

$date = date('Y-m-d H:i:s');

if ($_FILES['fileToUpload']['name'] != ""){
	$uploadOk = 1;
}else {
	$uploadOk = 0;
}

if ($uploadOk == 0) {

		$target_file="uploads/no_img.jpg";
		$sql = "INSERT INTO request( title,name,PhoneNumber,email,imgPath,Date,lat,lng,LitterScale,AdditionalDescription,isApproved )
		VALUES ( '$title', '$name', '$phoneNumb', '$email','$target_file', '$date', '$lat','$long', '$litterScale', '$addDesc', 0 );";

if ($conn->query($sql) === TRUE) {

    echo "<script>
            alert('Your location request has been submitted successfully.')
            location.href='RequestForm.html'
        </script>";

	} else {
        echo "<script>
            alert('Sorry, there was an error submitting your request.')
            location.href='RequestForm.html'
        </script>";
    }


// if everything is ok, try to upload file
}else {

		$sql = "INSERT INTO request( title,name,PhoneNumber,email,imgPath,Date,lat,lng,LitterScale,AdditionalDescription,isApproved )
		VALUES ( '$title', '$name', '$phoneNumb', '$email','$target_file', '$date', '$lat','$long', '$litterScale', '$addDesc', 0 );";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Your location request has been submitted successfully.')
            location.href='RequestForm.html'
        </script>";

	} else {
        echo "<script>
            alert('Sorry, there was an error submitting your request.')
            location.href='RequestForm.html'
        </script>";
    }
}

$conn->close();


?>
