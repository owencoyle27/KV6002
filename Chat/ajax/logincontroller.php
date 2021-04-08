<?php 
    include '../php_functions/mainfile.php';
    session_start();
    $act = new database;

    
    if(!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
        echo '<script type="text/javascript">
                window.location = "../login.php?error=Please fill the reCAPTHCA to continue our service.."
            </script>';;
        } else {
            $secret = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);

            if($response->success) {
                echo $act->login($_POST['email'],$_POST['pass']);
            } else {
                echo '<script type="text/javascript">
                        window.location = "../login.php?error=Please complete reCAPTHCA to continue our service.."
                    </script>';
            }
        }
    
 ?>