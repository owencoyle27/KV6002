
<?php
/**
 * Script to get carpark location, cURL has had to be used to authenticate with endpoint usign header data 
 * API Docs - https://www.netraveldata.co.uk/?page_id=32
 * 
 * @author Tom Hegarty 
 */

    //api endpoint genetered in javascript
    $url = $_POST['parkapiurl'];

    $response = get_web_page($url);
    $resArr = array();
    $resArr = json_decode($response);
    $JSONarray =  print_r(json_encode($resArr));
    substr($JSONarray, 0, -2);
    
    function get_web_page($url) {

        $username = "tomheg";
        $password = "password";

        //setting request options for cURL request
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HEADER         => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed
            CURLOPT_USERAGENT      => "test", // name of client
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_TIMEOUT        => 120,    // time-out on response
        ); 
    
        //makign curl request
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt_array($ch, $options);
        //$contetn is the JSON encoded response form the parking API 
        $content  = curl_exec($ch);
        curl_close($ch);
    
        //already in JSON, return to carpark.js
        return $content;
    }

    
?> 