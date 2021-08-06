<!DOCTYPE html>
<html lang="en">
<head>
    <title>Example Society</title>
    <link rel="stylesheet" type="text/css" href="societyStyle.css"/>  
    <?php
    include "newNav.php"; 
    include "connection.php"; 
    ?>
</head>
<body>
<script
    src="https://www.paypal.com/sdk/js?client-id=AXXplyBxEKnr3RKndc9WYkjr6Ub8sn2XbBUCHv86m2MZa630XbTIFZI1c_xhiYp418inDcFWdi3PyfoC"> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
</script>

<div class="heroBannerOuter">
        <img class="heroBanner" src="images/SOCheroBanner.jpg" alt="campus dasboard hero banner">
        <h1 class="exampleSocietyHeading"> Dummy Society </h1>
</div>

<style>
    /* styles for heading image  */

    html{
        scroll-behavior: smooth;
        font-family: Arial, Helvetica, sans-serif;
    }

    body{
        margin: 0;
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
        z-index: -1;
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

    /*---- chat window--------*/
            #root > div > div > div {
            width: auto!important;
            postition: initial!important;
            border: solid black!important;
            margin-top: 20px!important;
            top: initial!important;
            right:initial!important;
    }

    /*---- close button--------*/
    #nav-mobile > li > a{
       display:none!important;
    }

</style>
<div id ="page-wrap">
    <div id=dummy_desc> 
    <img id=dummy_image src="images/dummy.jpg" width='300' height='250' alt='dummy'> 
    <h4> Welcome to the Dummy Experience Society! </h4>
    <p id=dummy_desc_text> Have you ever looked at a dummy and wondered to yourself, what must that feel like?<br><br>

    Well wonder no longer, our society lets you get involded in the process of making, becoming and living life all the way a dummy does!<br><br>

    Look at the calendar for past and upcoming events to peak your interest! <br><br>

    If this sounds like something you'd be interested in click the interactive buttons to pay for membership and join our group! <br><br><br><br>

    </p>
    </div>
    <div id="gallery_container">
        <h3> Image Gallery </h3>
        <div class="gallery">
        <a href="images/dummy2.jpg" target="_blank" >
        <img src="images/dummy2.jpg" alt="dummy" width="600" height="400">
        </a>
        </div>

        <div class="gallery">
        <a target="_blank" href="images/dummy3.jpg">
        <img src="images/dummy3.jpg" alt="dummy" width="600" height="400">
        </a>
        </div>

        <div class="gallery">
        <a target="_blank" href="images/dummy4.jpg">
        <img src="images/dummy4.jpg" alt="dummy" width="600" height="400">
        </a>
        </div>
    </div>
    

    <div class="calendar">
        <iframe src="https://calendar.google.com/calendar/embed?height=400&amp;wkst=2&amp;bgcolor=%23ffffff&amp;ctz=Europe%2FLondon&amp;src=amJ2Z2NtNWY2Mm5jOGg5a2ZpbzQ4am5xMGNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;color=%23795548&amp;title=Society%20and%20University%20Events" style="border-width:0" width="800" height="400" frameborder="0" scrolling="no"></iframe><div class="search-box">
    </div>

    <div id="paypal-button-container">
    <p> Current price for membership: £1:60 </p>
    <script>
        paypal.Buttons({
        createOrder: function(data, actions) {
        // This function sets up the details of the transaction, including the amount and line item details.
        return actions.order.create({
            purchase_units: [{
            amount: {
                value: '2.00'
            }
            }]
        });
        },
        onApprove: function(data, actions) {
        // This function captures the funds from the transaction.
        return actions.order.capture().then(function(details) {
            // This function shows a transaction success message to your buyer.
            alert('Transaction completed by ' + details.payer.name.given_name);
        });
        }
        }).render('#paypal-button-container');
        //This function displays Smart Payment Buttons on your web page.
    </script>
    </div>             

</div> 
</div>
<div class="FooterOuter">
    <div class=FooterInner>
        <p><b>Northumbria University Newcastle</b></p>
        <p>Team Project and Profesionalism </p>
        <p> Alan Godfrey, Group 3</p>
        <p>Group Members</p>
        <p>Tom Hegarty : 16017590</p>
        <p>Owen Coyle : 17032712 </p>
        <p>Ben Tinson : 17006564</p>
        <p>Matt Perez : 17005703 </p>
        <p>Enes Zengin : 16021863</p>
</div>

<style>
    /* stlyes for footer */
        .FooterOuter{
        width: 100%;
        background-color: black;
        color: white;
        padding: 40px;
        box-sizing: border-box;
        text-align: center;
        }

        .FooterInner a{
            color: white;
            text-decoration: none;
            border: solid white;
            padding: 5px;
        }

        .FooterInner a:hover{
            color: black;
            background-color: white;
        }
    </style>
</body>


</html>