<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
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

$sql = "SELECT * FROM inv_species";
$result = $conn->query($sql);
echo "
<!DOCTYPE html>
<html>
<head>

    <title>Picking The Tees | Review Species</title>
    <link rel='stylesheet' type='text/css' href='css/style.css'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
    <!-- <link rel='stylesheet' type='text/css' href='css/form.css'> -->
	<style>
    #navbarColour{
      background-color:#3C4A65;
      font-size:10px;
      padding:0;
      padding-left:10px;
    }
    .navbar-light .navbar-toggler #toggler{
    color:white;



    }
    #specific{
        color:white;
        font-size:20px;
    }
    #current{
        color:grey;
        font-size:20px;
    }

	#selector li{

 display:inline;

 padding-left:10px;

 padding-right:10px;

}#selector{

 background:#E6F0FF

;

 text-align:center;

 margin-bottom: 0px;

 padding-top:10px;

}

    .inner{
        border-right:1px solid white;
        height:40%;
        padding-left:4px;
        padding-right:20px;
        margin-left:5px;
    }
    .inner:hover,#login:hover{
        color:black;
    }
    #login{
        color:white;
        margin-top:4px;
        font-size:16px;
        padding-left:4px;
    }

    .dropdown:hover .dropdown-menu {
    display: block;
  margin:0px;
}

    </style>
</head>

<body>
      <nav class='navbar navbar-expand-lg navbar-dark container-fluid py-1 py-lg-0' id='navbarColour'>
          <a class='navbar-brand text-white' href='dashboard.php'><strong>Picking</strong> the <Strong>Tees</Strong></a>
          <button class='navbar-toggler btn btn-outline-dark  mr-2' id='toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon '></span>
          </button>
          <div class='collapse navbar-collapse  justify-content-end ' id='navbarNav'>
            <ul class='navbar-nav mr-4'>
            <ul class='navbar-nav mr-4'>
              <li class='nav-item'>
                <a class='nav-link' href='dashboard.php' id='specific'>Dashboard</a>
              </li>
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='current' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                  Review
                </a>
                <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                  <a class='dropdown-item' href='ReviewSubmission.php'>Litter picks</a>
                  <a class='dropdown-item' href='ReviewRequests.php'>Location Requests</a>
                  <a class='dropdown-item active' href='#'>Invasive Species</a>
                </div>
              </li>
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='specific' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                  Account
                </a>
                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='navbarDropdown'>
                  <a class='dropdown-item' href='#'><span data-toggle='modal' data-target='#exampleModal' data-whatever='@edit'>Reset Password</span><span class='sr-only'>(current)</span></a>
                  <a class='dropdown-item' href='logout.php'>Logout</a>
                </div>
              </li>
            </ul>
          </div>
      </nav>

      <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
          <div class='modal-dialog' role='document'>
           <div class='modal-content'>
         <div class='modal-header'>
         <h5 class='modal-title'  id='exampleModalLabel'>Reset Password</h5>
     <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
   <span aria-hidden='true'>&times;</span>
    </button>
   </div>
  <div class='modal-body'>
  <form id='formModal'>
 <div class='form-group'>
      <label for='password' class='col-form-label'>New Password:</label>
      <input class='form-control'placeholder='New Password' name='password' id='password' type='password' required>
      </div>
   <div class='form-group'>
   <label for='confirm_password' class='col-form-label'>Confirm Password:</label>
   <input class='form-control' placeholder='Enter your password again' name='confirmPassword' id='confirmPassword'  type='password' required>
   </div>
   </form>
</div>
<div class='modal-footer'>
   <!-- submit password-->
 <button type='button' class='btn btn-primary'id='submitPassword'>Submit</button>
    </div>
   </div>
   </div>
  </div>
		<section id='selector'>
				<ul class='container-fluid mb-0'>
					<li><a href='ReviewSubmission.php'><font color='grey'>Review Submissions</font></a></li>
					<li>|</li>
					<li><a href='ReviewRequests.php'><font color='grey'>Review Requests</font></a></li>
					<li>|</li>
					<li><a href='#'><font color='black'>Review Invasive Species</font></a></li>
				</ul>
		</section>
    <section  id='gallery'>

        <!-- This will be automatically updated according to the number of requests returned from the database -->
        <h1 class='pt-2' style='font-size: 34px'>Endagered Species to Review: </h1>
        <br/>

";
while($row = $result->fetch_assoc()) {
	$litter;
	$req_id=$row['SpecID'];
	$current_reqid;
	$extension= substr($row['photoURL'], -3);
	$current_img=$row['photoURL'];


/*
	switch ($row['LitterScale']) {
    case 1:
        $litter= "Small";
        break;
    case 2:
        $litter= "Median";
        break;
    case 3:
        $litter= "A lot";
        break;
}
*/
	echo "
        <div class='list-group' style='margin-left: 50px; margin-right: 50px'>
            <a class='list-group-item list-group-item-action flex-column align-items-start'>
                <div class='container' align='center'>
                    <div class='row'>
                        <div class='col-8' style='padding-right:20px; border-right: 1px solid #ccc;'>
							ID: ". $req_id."
							<br>
                            Name: ". $row['name']."
                            <br>
                            Email: ". $row['email']."

							<br>
                            Species: ". $row['species']."
							<br>
							Additional Description: ". $row['addDesc']."
							<br>
              <br>

							<img src='https://maps.googleapis.com/maps/api/staticmap?center= ".$row['lat']. ','.$row['lng']." &zoom=13&size=400x400&maptype=roadmap&markers=color:red%7Clabel:%7C ".$row['lat']. ','.$row['lng']." &key=AIzaSyB_AWzvRLQ4vJCybLAJuKZRNa8MakxV56I' alt='marker'>

                        </div>

                        <div class='col-4'>

						<br>
                             ";
							if ($current_img == ""){
								echo "<b>No image was uploaded by the user</b>";
							}
							else {
								echo"
								Image:
							   <img id='test' src=".$current_img ." onerror='no picture' width='300' height='200'>
							   <p > </p>

							   <form action='fb_post.php' method='post'>
					<input value='$current_img' name='imgUp' accept='image/*' class='form-control' hidden>

                    <br/>
					";

							}
							echo "


             </form>
			 <form onclick='return clicked()' action='delete_species.php' method='post' id='form'>
				<input type='hidden' name='reject' value='$req_id' class='btn btn-danger' >
				<input type='submit' name='reject_show' value='Reject' id='reject-btn' class='btn btn-danger' >
			</form>

								<script>
								function clicked(){
									if (confirm('Are you sure you want to delete this review?')){
										document.getElementById('form_del').submit();
									}
									else {
										return false;
									}
								}
								document.addEventListener('DOMContentLoaded', function(event) {

								   document.querySelectorAll('img').forEach(function(img){
									img.onerror = function() {
									this.style.display='none';
									};

								   })
								});

</script>




                        </div>
                    </div>
                </div>
            </a>
            <br/>
            <a>


            </a>
        </div>
		<br>
		<br>



                </div>
            </div>
        </div>
    </div>



" ;

}

echo "

    </section>




</body>
</html>";








} else {
    echo "Please log in first to see this page.";
}


?>
