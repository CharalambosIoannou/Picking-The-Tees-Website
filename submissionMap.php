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
$sql = "select * from comppick";
$result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));

 $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }

	//echo json_encode($emparray);
	$fp = fopen('submission.json', 'w');
	fwrite($fp, json_encode($emparray));
	fclose($fp);

$sql1 = "select * from request";
$result1 = mysqli_query($conn, $sql1) or die("Error in Selecting " . mysqli_error($conn));

 $emparray1 = array();
    while($row1 =mysqli_fetch_assoc($result1))
    {
        $emparray1[] = $row1;
    }

	//echo json_encode($emparray1);
	$fp1 = fopen('request.json', 'w');
	fwrite($fp1, json_encode($emparray1));
    fclose($fp1);

    $sql2 = "select * from inv_species";
$result2 = mysqli_query($conn, $sql2) or die("Error in Selecting " . mysqli_error($conn));

 $emparray2 = array();
    while($row2 =mysqli_fetch_assoc($result2))
    {
        $emparray2[] = $row2;
    }

	//echo json_encode($emparray1);
	$fp2 = fopen('species.json', 'w');
	fwrite($fp2, json_encode($emparray2));
	fclose($fp2);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta name='viewport' content='initial-scale=1.0, user-scalable=no'>
    <meta charset='utf-8'>
    <title>Picking the Tees | View Submissions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/vmap.css">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 500px;
		width: 800px;
		margin-left: auto;
        margin-right: auto;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      * {
        box-sizing: border-box;
      }

      img {
        padding-right: 10px;
      }

      /* Container for flexboxes */
      section {
        display: -webkit-flex;
        display: flex;
      }

      p {
        margin: 0px;
        padding-left: 0px;
        padding-right: 0px;
        padding-bottom: 3px;
      }


      /* Style the content */
      article {
        -webkit-flex: 3;
        -ms-flex: 3;
        flex: 3;
      }

      h4 {
        font-size: 12px;
        color: red;
        margin: 0;
        padding-left: 0;
        padding-right: 0;
        margin-top: 0;
        margin-bottom: 10px;
      }

      /* Responsive layout - makes the menu and the content (inside the section) sit on top of each other instead of next to each other */
      @media (max-width: 600px) {
        section {
          -webkit-flex-direction: column;
          flex-direction: column;
        }
      }

    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>

    </head>
	<body>
	  <nav class="navbar navbar-expand-lg navbar-dark container-fluid py-1 py-lg-0" id="navbarColour">
		<a class="navbar-brand text-white" href="index.html"><strong>Picking</strong> the <Strong>Tees</Strong></a>
		<button class="navbar-toggler btn btn-outline-dark  mr-2" id="toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon "></span>
		</button>
		<div class="collapse navbar-collapse  justify-content-end " id="navbarNav">
		  <ul class="navbar-nav mr-4">
			<li class="nav-item ">
			  <a class="nav-link" href="index.html" id="specific"><span class="inner">Home</span><span class="sr-only">(current)</span></a>
			</li>
      <li class="nav-item">
        <a class="nav-link" href="#" id="current"><span class="inner">Maps</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="submissionForm.html" id="forms">Forms</a>
      </li>

		  </ul>
		</div>
	</nav>
	<section class="jumbotron mb-0" id="jumbo">
		<h1 class="display-2 text-white" >Maps</h1>
	</section>
   <section id="selector">
		<ul class='container-fluid mb-0'>
			<li><a href='#'><font color='black'>Completed Picks</font></a></li>
			<li>|</li>
			<li><a href='requestMap.php'><font color='grey'>Requested Locations</font></a></li>
			<li>|</li>
            <li><a href='speciesMap.php'><font color='grey'>Invasive Species</font></a></li>
            <li>|<li>
			<li><a href='bothMap.php'><font color='grey'>All</font></a></li>
		</ul>
   </section>
   <section class="d-flex justify-content-center mt-2" id="map"></section>
              <footer>
            <div class="container-fluid navbar d-flex justify-content-center">
            <ul>
                <li><a href="contact.html">Contact</a></li>
                <li id="aboutFooter"><a href="about.html">About</a></li>
                <li>
                  <a href="login.html" >Login</a>
                </li>
            </ul>
            </div>
        </footer>
		<script>

      function initMap() {
		  var json;
		 $.getJSON("submission.json", function (json1) {
            json = json1;
			var map = new google.maps.Map(document.getElementById('map'), {
			  zoom: 11,
			  center: {lat: 54.563586, lng: -1.287070}
			});
			console.log("mag is here",map)
			for(var i in json){
			  let isClick = false;
			  var uluru = {lat: parseFloat(json[i].lat), lng: parseFloat(json[i].lng)};
			  var contentString
				if(json[i].addDesc == ""){
									contentString = "<header><h4>COMPLELETD PICK #"+ json[i].SubmissionID +"</h4></header><section><img src='"+ json[i].photoURL +"' width=100 height=100></ul></nav><article><p><b>Date: </b>"+ json[i].date +"</p><p><b>Litter Type: </b>"+ json[i].litter +"</p><p><b>#Bags Picked: </b>"+ json[i].bag +"</p></article></section>"

				} else{
					contentString = "<header><h4>COMPLELETD PICK #"+ json[i].SubmissionID +"</h4></header><section><img src='"+ json[i].photoURL +"' width=100 height=100></ul></nav><article><p><b>Date: </b>"+ json[i].date +"</p><p><b>Litter Type: </b>"+ json[i].litter +"</p><p><b>#Bags Picked: </b>"+ json[i].bag +"</p><p><b>Additional Description: </b>"+ json[i].addDesc +"</p></article></section>"
				}

			  let marker = new google.maps.Marker({
				position: uluru,
				map: map,
				icon: {
					url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
				}
			  });

			  let infoWindow = new google.maps.InfoWindow({
				content: contentString,
				maxWidth: 400
			  });

			  marker.addListener('click', function() {
				isClick = true;
				infoWindow.open(map,this);
			  });

			  marker.addListener('mouseover', function() {
				infoWindow.open(map,this);
			  });

			  marker.addListener('mouseout', function() {
				if(!isClick){
				  infoWindow.close();
				}
			  });

			  infoWindow.addListener('closeclick', function() {
				isClick = false;
			  });

			}
         });
      }
    </script>
	<script async defer
	src='https://maps.googleapis.com/maps/api/js?key=AIzaSyB_AWzvRLQ4vJCybLAJuKZRNa8MakxV56I&callback=initMap'></script>

  </body>
</html>
