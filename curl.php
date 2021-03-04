<?php

    $url = $_POST['parkapiurl'];

    //$url = "http://uoweb3.ncl.ac.uk/api/v1.1/sensors/PER_CARPARK_ELLISON_PLACE_CP_TRAF/data/json/?starttime=20210302600&endtime=202103021000";

    $response = get_web_page($url);
    $resArr = array();
    $resArr = json_decode($response);
    echo print_r(json_encode($resArr));
    
    function get_web_page($url) {
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
    
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
    
        $content  = curl_exec($ch);
    
        curl_close($ch);
    
        return $content;

    }

    
?> 