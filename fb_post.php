<?php
define('Facebook/');
require_once('Facebook/autoload.php');
require "init.php";

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    die("Not Allowed");
}

//echo $_POST['button_submit'];
$status= $_POST['status'];
$media= $_POST['imgUp'];



switch ($_POST['button_submit']){
	case "Facebook":
		$fb = new Facebook\Facebook([
    'app_id' => '2164780950208886',
    'app_secret' => '3e4ff462f1dac5212492e902e2be34b3',
    'default_graph_version' => 'v3.2',
   ]);
   $pageAccessToken ='EAAew21eNwXYBANzLPe433xQWk67xZBEDJSFZBP4xTaQgZAbxulk4fLHczx8LZASVayxvyJjSBXLpC5rKbOIRNIxfZAgijfVZAJZBZCQ6EHi6KiutJlR5JdHA4ZBrmgDBpZB5XWVQ3BjmLjkx12znGrSpf28IsigeFwHOUZBFWNIGZCcC6CDGNE4iWnxZAEgMzZAJZAZAG9EZD';
	if (($media == "") and (!$status)) {
    die("Nothing to Post");
	}else if ($media != ""){
	  $data = ['message' => $status,
			'source' => $fb -> fileToUpload($media)];
	$response = $fb->post('/me/photos', $data, $pageAccessToken);
}
else {  
  $linkData = [
    'message' =>  $status
   ];
	$response = $fb->post('/me/feed', $linkData, $pageAccessToken);
}	
   try {
	
    //$response = $fb->post('/me/feed', $linkData, $pageAccessToken);
    header('Location: dashboard.php');
	exit;
   
   } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: '.$e->getMessage();
    exit;
   } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: '.$e->getMessage();
    exit;
   }
   $graphNode = $response->getGraphNode();
   
   
		break;
		
		
		
		
	case "Twitter":
	
	
	
	
	if (($media == "") and (!$status)) {
    die("Nothing to Post");
}else if ($media != ""){
	 $tweetWM = $connection->upload('media/upload', ['media' => $media]);
	$tweet = $connection->post('statuses/update', ['media_ids' => $tweetWM->media_id, 'status' => $status]);
	header('Location: dashboard.php');
	exit;
}else { 
	$parameters = [
    'status' => $status
	];
	$result = $connection->post('statuses/update', $parameters);


}
die();
		
		
		
		
		
		
		
		break;
	case "Both":
		
		$fb = new Facebook\Facebook([
    'app_id' => '2164780950208886',
    'app_secret' => '3e4ff462f1dac5212492e902e2be34b3',
    'default_graph_version' => 'v3.2',
   ]);
   $pageAccessToken ='EAAew21eNwXYBANzLPe433xQWk67xZBEDJSFZBP4xTaQgZAbxulk4fLHczx8LZASVayxvyJjSBXLpC5rKbOIRNIxfZAgijfVZAJZBZCQ6EHi6KiutJlR5JdHA4ZBrmgDBpZB5XWVQ3BjmLjkx12znGrSpf28IsigeFwHOUZBFWNIGZCcC6CDGNE4iWnxZAEgMzZAJZAZAG9EZD';
	if (($media == "") and (!$status)) {
    die("Nothing to Post");
	}else if ($media != ""){
	  $data = ['message' => $status,
			'source' => $fb -> fileToUpload($media)];
	$response = $fb->post('/me/photos', $data, $pageAccessToken);
}
else {  
  $linkData = [
    'message' =>  $status
   ];
	$response = $fb->post('/me/feed', $linkData, $pageAccessToken);
}	
   try {
	
    //$response = $fb->post('/me/feed', $linkData, $pageAccessToken);
    header('Location: dashboard.php');
	exit;
	
   
   } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: '.$e->getMessage();
    exit;
   } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: '.$e->getMessage();
    exit;
   }
   $graphNode = $response->getGraphNode();
   
			if (($media == "") and (!$status)) {
    die("Nothing to Post");
}else if ($media != ""){
	 $tweetWM = $connection->upload('media/upload', ['media' => $media]);
	$tweet = $connection->post('statuses/update', ['media_ids' => $tweetWM->media_id, 'status' => $status]);
}else { 
	$parameters = [
    'status' => $status
	];
	$result = $connection->post('statuses/update', $parameters);
	

}



die();
		
		
		
		
		
		break;
}


?>