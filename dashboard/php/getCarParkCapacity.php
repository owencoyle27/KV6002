
<?php
/**
 * A seprate script has had to be made to get the carparks total capcity numebr due to the formation of endpoijtd from api
 * API Docs - https://www.netraveldata.co.uk/?page_id=32
 * @author Tom Hegarty 
 */

    $url = $_POST['parkapiurl'];

    $response = get_web_page($url);
    $resArr = array();
    $resArr = json_decode($response);
    $JSONarray =  print_r(json_encode($resArr));
    substr($JSONarray, 0, -2);
    
    function get_web_page($url) {

        //login details to authenticate with api
        $username = "tomheg";
        $password = "password";

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
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt_array($ch, $options);
    
        $content  = curl_exec($ch);
    
        curl_close($ch);
    
        //retrun to carparks.js
        return $content;
    }
?> 