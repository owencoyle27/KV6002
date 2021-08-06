<?php
<<<<<<< HEAD
/**
 * Script to allow access to the ver ysecure Twitter API 
 * bearer token is genearted allowing Oauth2 authenication 
 * 
 * @author Tom Hegarty 
 */

  //api keys created for this app
  $app_key = 'hYoiRhNMKfmsuoz4gRCtmsIHm';
  $app_token = 'me9FvDd9Re4GxL1sKem2UGhdu3qQDesJlVEiE41PaUuMxfRz5s';
  $api_base = 'https://api.twitter.com/';
  $bearer_token_creds = base64_encode($app_key.':'.$app_token);

  //genrating twitter autnetication token
  $opts = array(
    'http'=>array(
      'method' => 'POST',
      'header' => 'Authorization: Basic '.$bearer_token_creds."\r\n".
                'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
      'content' => 'grant_type=client_credentials'
    )
  );

  $streamContext = stream_context_create($opts);
  $json = file_get_contents($api_base.'oauth2/token',false,$streamContext);

  $result = json_decode($json,true);

  //if there is an error genrating token 
  if (!is_array($result) || !isset($result['token_type']) || !isset($result['access_token'])) {
    die("Something went wrong. This isn't a valid array: ".$json);
  }

  //if token does not validate with twitter
  if ($result['token_type'] !== "bearer") {
    die("Invalid token type. Twitter says we need to make sure this is a bearer.");
  }

  $accessToken = $result['access_token'];

  //send data to twitter along with new access token
  $opts = array(
    'http'=>array(
      'method' => 'GET',
      'header' => 'Authorization: Bearer '.$accessToken
    )
  );

  $streamContext = stream_context_create($opts);

  //get account name from indexpage
  $accountName = $_POST['accountName'];

  //api endpint to get results, sent as JSON to twitterFeed.js
  $json = file_get_contents($api_base.'1.1/statuses/user_timeline.json?count=20&screen_name='. $accountName .'&tweet_mode=extended&include_entities=true&exclude_replies=true&include_rts=false',false,$streamContext);
  echo $json;
=======

//This is all you need to configure.
$app_key = 'hYoiRhNMKfmsuoz4gRCtmsIHm';
$app_token = 'me9FvDd9Re4GxL1sKem2UGhdu3qQDesJlVEiE41PaUuMxfRz5s';

//These are our constants.
$api_base = 'https://api.twitter.com/';
$bearer_token_creds = base64_encode($app_key.':'.$app_token);

//Get a bearer token.
$opts = array(
  'http'=>array(
    'method' => 'POST',
    'header' => 'Authorization: Basic '.$bearer_token_creds."\r\n".
               'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
    'content' => 'grant_type=client_credentials'
  )
);

$context = stream_context_create($opts);
$json = file_get_contents($api_base.'oauth2/token',false,$context);

$result = json_decode($json,true);

if (!is_array($result) || !isset($result['token_type']) || !isset($result['access_token'])) {
  die("Something went wrong. This isn't a valid array: ".$json);
}

if ($result['token_type'] !== "bearer") {
  die("Invalid token type. Twitter says we need to make sure this is a bearer.");
}


//Set our bearer token. Now issued, this won't ever* change unless it's invalidated by a call to /oauth2/invalidate_token.
//*probably - it's not documentated that it'll ever change.
$bearer_token = $result['access_token'];

//Try a twitter API request now.
$opts = array(
  'http'=>array(
    'method' => 'GET',
    'header' => 'Authorization: Bearer '.$bearer_token
  )
);

$context = stream_context_create($opts);
//$json = file_get_contents($api_base.'1.1/search/tweets.json?count=20&tweet_mode=extended&q=(from%3AnorthumbriaUni%20OR%20from%3Anustudents%20OR%20from%3ANULibrary%20OR%20from%3ANU_CISdept)',false,$context);
$json = file_get_contents($api_base.'1.1/statuses/user_timeline.json?count=20&screen_name=NorthumbriaUni&tweet_mode=extended&exclude_replies=true&include_rts=false',false,$context);
echo $json;


>>>>>>> 94e759be4ca40c4bfd21a35d8c3c8adee1c1d6a8

?>