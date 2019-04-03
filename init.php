<?php


require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;


// Replace place holders with your API keys.
$connection = new TwitterOAuth('as4FgknXzJGK18XVYWrf73zi4', 'iSx6lyjShSNFFbkwhjUevykODRily2AaW8UicRScj2R36NLiPS', '1081312310013190145-W054Avb8D8OqDNIM0pYpMjv8ef6NGy', '90PVemZWfiWKXRFqr1Fh4VJnOAyMXAiW66niYwiW9mNFH');



$info = $connection->get("account/verify_credentials");



