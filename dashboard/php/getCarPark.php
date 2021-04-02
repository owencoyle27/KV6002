
<?php
/**
 * Script to get carpark location, cURL has had to be used to authenticate with endpoint usign header data 
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
            CURLOPT_RETURNTRANSFER => true,   
            CURLOPT_FOLLOWLOCATION => true,   
            CURLOPT_MAXREDIRS      => 10,  
            CURLOPT_AUTOREFERER    => true,   
            CURLOPT_HEADER         => false, 
            CURLOPT_CONNECTTIMEOUT => 120,    
            CURLOPT_TIMEOUT        => 120,       
            CURLOPT_ENCODING       => "",     
            CURLOPT_USERAGENT      => "test", 
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