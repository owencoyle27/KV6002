<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>LUCI </title>
    <meta charset="utf-8">
</head>

<body>

    <?php include "newNav.php" ?>

    <div class="heroBannerOuter">
        <img class="heroBanner" src="ChatBot/images/heroBannerChatBot.png" alt="chat bot hero banner">
        <h1 class="dashboardHeading">L.U.C.I. - Legitimately Useful Campus Intelligence</h1>
    </div>

    <iframe class="embededFrame" src="https://l-u-c-i.herokuapp.com/"></iframe>

       

</body>

<style>

    html{
        scroll-behavior: smooth;
        font-family: Arial, Helvetica, sans-serif;
    }

    body{
        margin: 0;
    }

    .embededFrame{
        width: 100%;
        border: none;
        height: 800px; 
    }



    /*----------hero Image -------------------*/
        .nav .logo, .nav .menu{
        margin-bottom: -2px;
    }

    .heroBannerOuter{
        box-sizing: border-box;
        width: 100%;
        height: 250px;
        overflow: hidden;
        margin-top: -10px;
    }

    .heroBanner{
        width: 100%;
        height: 250px;
        object-fit: cover;
        overflow: hidden;
    }

    .heroBannerOuter:after {
        content: '';
        position: relative;
        width: 100%; 
        height: 250px;
        margin-top: -250px;
        display: inline-block;
        background: -moz-linear-gradient(top, rgba(0,0,0,0) 0%, rgba(0, 0, 0, 6) 100%); 
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.6))); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0, 0, 0, 0.6) 100%); 
        background: -ms-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.6) 100%); 
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0.6) 100%); 
    }

    .dashboardHeading{
        color: white;
        width: 70%;
        margin: -50px auto 0px;
        font-size: 220%;
        position: relative;
        z-index: 10;
    }

    @media only screen and (max-width: 800px) {
        .heroBanner{
            height: 250px;
        }

        .dashboardHeading{
            width: 100%;
            text-align: center;
        }
    }

    /*---- close button--------*/
    #nav-mobile > li > a{
       display:none!important;
    }

</style>


</html>
