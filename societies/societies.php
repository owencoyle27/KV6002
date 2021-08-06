<!DOCTYPE html>
<html lang="en">
<head>
    <title>Societies</title>
  
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="societyStyle.css"/>  
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>  
    <?php 
        include "connection.php"; 
        include "newNav.php"; 
    ?>
</head>
<body>
    <div class="heroBannerOuter">
        <img class="heroBanner" src="images/SOCheroBanner.jpg" alt="societies hero banner">
        <h1 class="dashboardHeading"> Societies </h1>
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
    <div class = introContainer>
        <p>
            Welcome to the societies page. Here you can find details about all the societies on offer in the university. University is a place where many people gather from different cultures, countries and backgrounds.
            This means there are a wide variety of interests that you can adventure through with a group of people and create lifetime memorable experiences.
        </p>

        <p> 
            On this page you will find a calendar of all events listed for every society, including details about the event istelf, the location and which group is hosting them. You can also click the plus button in the corner to add the calendar to your own personal one to ensure
            you don't miss out on any exciting events happening. You can search for a specific society that you've heard about or know a friend in there using the search bar. All the current socieites that exist in the university will be displayed in the boxes with a short description
            to explain what they are about. If you click on the box you will be led to the society page to find out in-depth details about the society and how to gain membership.
        </p>
    </div>
    <div class="calendar">
        <iframe src="https://calendar.google.com/calendar/embed?height=400&amp;wkst=2&amp;bgcolor=%23ffffff&amp;ctz=Europe%2FLondon&amp;src=amJ2Z2NtNWY2Mm5jOGg5a2ZpbzQ4am5xMGNAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;color=%23795548&amp;title=Society%20and%20University%20Events" style="border-width:0" width="800" height="400" frameborder="0" scrolling="no"></iframe><div class="search-box">
    </div>
    <div class ="search-box">
        <input type="text" autocomplete="off" placeholder="Search Societies..." />
            <div class="result"></div>
    </div>

    <?php
        $dbConn = getConnection();
        $sqlQuery = "SELECT society_Name, society_Description, society_Image FROM Societies ORDER BY society_Name";
        $queryResult = $dbConn->query($sqlQuery);
        echo "<table class='Societies Table'>";
        echo "<tr>";
        $column = 0;
            foreach ($dbConn->query($sqlQuery) as $row) {
            $column++;
            echo "<td> <div class=w3-card-4 style = 'width:90%'>";
            echo "<a href='exampleSociety.php'> <img src=images/$row[society_Image].jpg width='250' height='200'alt='$row[society_Name]' </a>";
            echo "<div class=w3-container>";
            echo "<h4><b>$row[society_Name]</h4></b><p>$row[society_Description]</p>";
            echo "</div> </div> </td>";
            if($column == 3){
                echo '</tr><tr>';
                $column = 0;
            }
        }
        echo "</tr> ";
        echo "</table>";
    
    ?>
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
</div>  


    <script>
        /*Search Box functionality */
    $(document).ready(function(){
        $('.search-box input[type="text"]').on("keyup input", function(){
            /* Change input value each different entry */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if(inputVal.length){
                $.get("backend-search.php", {term: inputVal}).done(function(data){
                    // Display returned data in the browser
                    resultDropdown.html(data);
                });
            } else{
                resultDropdown.empty();
            }
        });
        
        // Set search input value on click of result item
        $(document).on("click", ".result p", function(){
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });

    </script>
</body>


</html>