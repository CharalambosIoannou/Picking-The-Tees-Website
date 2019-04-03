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
    die('Connection failed: ' . $conn->connect_error);
}
$sql = 'select * from comppick';
$result = mysqli_query($conn, $sql) or die('Error in Selecting ' . mysqli_error($conn));

 $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }

	//echo json_encode($emparray);
	$fp = fopen('submission.json', 'w');
	fwrite($fp, json_encode($emparray));
	fclose($fp);

$sql1 = 'select * from request';
$result1 = mysqli_query($conn, $sql1) or die('Error in Selecting ' . mysqli_error($conn));

 $emparray1 = array();
    while($row1 =mysqli_fetch_assoc($result1))
    {
        $emparray1[] = $row1;
    }

	//echo json_encode($emparray1);
	$fp1 = fopen('request.json', 'w');
	fwrite($fp1, json_encode($emparray1));
    fclose($fp1);

    $sql2 = 'select * from inv_species';
$result2 = mysqli_query($conn, $sql2) or die('Error in Selecting ' . mysqli_error($conn));

 $emparray2 = array();
    while($row2 =mysqli_fetch_assoc($result2))
    {
        $emparray2[] = $row2;
    }

	//echo json_encode($emparray1);
	$fp2 = fopen('species.json', 'w');
	fwrite($fp2, json_encode($emparray2));
	fclose($fp2);

echo "
<!DOCTYPE html>
<html>
<head>

    <title>Picking The Tees | Dashboard</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' integrity='sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr' crossorigin='anonymous'>
    <link rel='stylesheet' type='text/css' href='css/dashboard.css'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>
    <link rel='stylesheet' href='https://unpkg.com/bootstrap-table@1.13.4/dist/bootstrap-table.min.css'>
    <link rel='stylesheet' type='text/css' href='http://www.shieldui.com/shared/components/latest/css/light/all.min.css' />
        <style>

	#selector li{

 display:inline;

 padding-left:10px;

 padding-right:10px;

}
#selector{

 background:#E6F0FF;


 margin-bottom: 0px;

 padding-top:10px;

}

.dropdown:hover .dropdown-menu {
  display: block;
  margin:0px;
}
    </style>

    </head>
    <body>
      <nav class='navbar navbar-expand-lg navbar-dark container-fluid py-1 py-lg-0' id='navbarColour'>
          <a class='navbar-brand text-white' href='#'><strong>Picking</strong> the <Strong>Tees</Strong></a>
          <button class='navbar-toggler btn btn-outline-dark  mr-2' id='toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon '></span>
          </button>
          <div class='collapse navbar-collapse  justify-content-end ' id='navbarNav'>
            <ul class='navbar-nav mr-4'>
              <li class='nav-item'>
                <a class='nav-link active' href='#' id='current'>Dashboard</a>
              </li>
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='specific' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                  Review
                </a>
                <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                  <a class='dropdown-item' href='ReviewSubmission.php'>Litter picks</a>
                  <a class='dropdown-item' href='ReviewRequests.php'>Location Requests</a>
                  <a class='dropdown-item' href='ReviewSpecies.php'>Invasive Species</a>
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
  <form action='change_password.php' method='post' id='formModal'>
 <div class='form-group'>
      <label for='password' class='col-form-label'>New Password:</label>
      <input class='form-control'placeholder='New Password' name='password' id='password' type='password' required>
      </div>
   <div class='form-group'>
   <label for='confirm_password' class='col-form-label'>Confirm Password:</label>
   <input class='form-control' placeholder='Enter your password again' name='confirmPassword' id='confirmPassword'  type='password' required>
   </div>
    <button type='submit' class='btn btn-primary'id='submitPassword'>Submit</button>
   </form>
</div>
   </div>
   </div>
  </div>
      <div class='container'>
        <h2 class='ml-3 mt-3'>Dashboard</h2>

                <section>
                    <div class='container'>
                        <div class='row mb-2'>
                            <div class='col col-lg-6'>
                            <div class=' card w-100 border-left-green'>
                                <div class='card-body'>
                                <div style='float:left;'>
                                <h6 class='card-title'>Submissions</h6>
                                <p class='card-text' id='newSubmission'></p>
                                </div>
                                <div style='float:right;'>
                                        <i class='fas fa-hand-holding-heart fa-3x mr-3'></i>
                                </div>
                                </div>
                            </div>
                             </div>
                             <div class='col col-lg-6'>
                                    <div class=' card w-100 border-left-black'>
                                        <div class='card-body'>
                                        <div style='float:left;'>
                                        <h6 class='card-title'>Requests</h6>
                                        <p class='card-text' id='newRequest'></p>
                                        </div>
                                        <div style='float:right;'>
                                                <i class='far fa-clock fa-3x mr-3' ></i>
                                        </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col col-lg-6'>
                            <div class=' card w-100 border-left-yellow'>
                                <div class='card-body'>
                                <div style='float:left;'>
                                <h6 class='card-title'>Number of Bags</h6>
                                <p class='card-text' id='bagCounter'></p>
                                </div>
                                <div style='float:right;'>
                                        <i class='fas fa-hand-holding-heart fa-3x mr-3'></i>
                                </div>
                                </div>
                            </div>
                             </div>
                             <div class='col col-lg-6'>
                                    <div class=' card w-100 border-left-red'>
                                        <div class='card-body'>
                                        <div style='float:left;'>
                                        <h6 class='card-title'>Number of Hours</h6>
                                        <p class='card-text' id='hourCounter'></p>
                                        </div>
                                        <div style='float:right;'>
                                                <i class='far fa-clock fa-3x mr-3' ></i>
                                        </div>
                                        </div>
                                    </div>
                                     </div>
                        </div>
                </div>
            	  <hr>
                <h2 class='ml-3'>View All Submissions</h2>
                <section>
                    <div class='ml-3 mt-4'>
                    <input type='button' class='btn btn-primary' id='export' value='Export to Excel'>
                    <div class='btn-group mx-3' role='group' aria-label='Basic example'>
                            <button type='button mr-3' class='btn btn-secondary 'id='submissionBtn'>Submission</button>
                            <button type='button mr-3' class='btn btn-secondary'id='requestBtn'>Request</button>
                            <button type='button' class='btn btn-secondary' id='invasiveBtn'>Invasive</button>
                          </div>
                    </div>
                    <div class='container'>
                            <div id='submission' >

                            <table id='tableSubmission'
                            data-pagination='true'
                             data-search='true'>
                                    <thead class='thead-light'>
                                        <tr>
                                            <th data-field='SubmissionID'>Id</th>
                                            <th data-field='name'>Name</th>
                                            <th data-field='litter'>Litter</th>
                                            <th data-field='bag'>Bag</th>
                                            <th data-field='hour'>Hour</th>
                                            <th data-field='people'>People</th>
                                            <th data-field='date'>Date</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                                <div id='request' class='hide'>

                                <table id='tableRequest'
                                           data-pagination='true'
                                        data-search='true'>
                                    <thead class='thead-light'>
                                        <tr>
                                            <th data-field='RequestID'>Id</th>

                                            <th data-field='name'>Name</th>
                                            <th data-field='LitterScale'>Litter Scale</th>
                                            <th data-field='Date'>Date</th>
                                        </tr>
                                    </thead>
                                </table>
                                 </div>
                                 <div id='invasive' class='hide'>


                                <table id='tableInvasive'
                                           data-pagination='true'
                                        data-search='true'>
                                    <thead class='thead-light'>
                                        <tr>
                                            <th data-field='SpecID'>Id</th>
                                            <th data-field='name'>Name</th>
                                            <th data-field='species'>Species</th>
                                            <th data-field='date'>Date</th>
                                  </thead>
                                </table>
                                </div>
                            </div>
                        </section>
                    </div>

            <!-- Latest compiled and minified JavaScript -->

            <script   src='https://code.jquery.com/jquery-3.3.1.js'   integrity='sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60='   crossorigin='anonymous'></script>            <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js' integrity='sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut' crossorigin='anonymous'></script>
            <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js' integrity='sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k' crossorigin='anonymous'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/core-js/2.6.2/core.min.js'></script>
            <script src='https://unpkg.com/bootstrap-table@1.13.4/dist/bootstrap-table.min.js'></script>
            <script type='text/javascript' src='FileSaver.min.js'></script>
            <script type='text/javascript' src='xlsx.core.min.js'></script>
            <script type='text/javascript' src='tableExport.min.js'></script>


            <script>

            $( document ).ready(function() {
            //Function to call json
                let invasiveExcel=false
                let submissionExcel=true
                let requestExcel=false
               $.getJSON('submission.json', function (json) {
                let submission=0
                let bag=0
                let hours=0
                $.each(json,function(key,value){
                    hours+=Number(value.hour)
                    bag+=Number(value.bag)
                        submission += 1
                })

                $('#hourCounter').text(hours)
                $('#bagCounter').text(bag)
                $('#newSubmission').text(submission)

                $('#tableSubmission').bootstrapTable({
                        data: json
                    });
                });

                $.getJSON('request.json', function (json) {
                  let request=0
                    $.each(json,function(key,value){
                            request += 1
                    $('#newRequest').text(request)
                })
              });

                $.getJSON('species.json', function (json) {
                    $('#tableInvasive').bootstrapTable({
                        data: json
                    });
                });

                $.getJSON('request.json', function (json) {
                    $('#tableRequest').bootstrapTable({
                        data: json
                    });
                });

                    //export to excel

            $('#invasiveBtn').click(function(){
                $('#invasive').removeClass('hide')
                $('#submission').addClass( 'hide' )
                $('#request').addClass( 'hide' )
                 invasiveExcel=true
                 submissionExcel=false
                  requestExcel=false

            })

            $('#submissionBtn').click(function(){
                $('#submission').removeClass('hide')
                $('#invasive').addClass( 'hide' )
                $('#request').addClass( 'hide' )
                invasiveExcel=false
                 submissionExcel=true
                  requestExcel=false
            })

            $('#requestBtn').click(function(){
                $('#request').removeClass('hide')
                $('#invasive').addClass( 'hide' )
                $('#submission').addClass( 'hide' )
                invasiveExcel=false
                 submissionExcel=false
                  requestExcel=true
            })

            $('#export').click(function () {
                    if (invasiveExcel===true){
                            $('#tableInvasive').tableExport({fileName:'Invasive Table',type:'csv'});

                        }
                    if (submissionExcel===true){
                        $('#tableSubmission').tableExport({fileName:'Submission Table',type:'csv'});

                      }
                    if (requestExcel===true){
                        $('#tableRequest').tableExport({fileName:'Request Table',type:'csv'});

                      }

               function createFilterCont(data,json){
                $.each(json,function(key,value){
                                 data.push(value)

                            })

               };
               function createToggler(){
                $('#invasive').toggle();
                $('#submission').toggle();
                $('invasive').toggle();
               }

        });

        $('#submitPassword').on('click',function(){
          event.preventDefault();
          let p1 = document.getElementById('password').value;
          let p2 = document.getElementById('confirmPassword').value;
          if(p1 != p2){
            return False;
          } else{
            // Hey Harry! Here you can start connecting to backend.
            window.location.href = 'change_password.php';
            return;
          }
        })
    });


        </script>
        </body>
        </html>

		";
}else {
	echo "Please log in first";
}

?>
