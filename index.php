<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashboard/styles/dashboardStyle.css">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js"></script>
    <title>Northumbria Dashboard </title>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
</head>

<body>
    <!--NAv by Matt Perez-->
    <div class ="nav">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="societies.html">Societies</a></li>
          <li><a href="map.html">Map</a></li>
          <li><a href="forum.html">Forum</a></li>
        </ul>
    </div> 

    <div class="row1">
        <div id="updateTextArea">
            <p>Latest update from Northumbria campus sevices: </p>
            <h2 id="updateBody">unable to fetch latest update</h2>
            <p id="updateDate"></p>
        </div>
        <div id="upateImageOuter">
            <img id="updateImage" src="dashboard/images/defaultUpdateImage.png" alt="image of buildigns on campus">
        </div>
    </div>

    <script>
        /**
         * updates the campus upate widget with data from the database 
         * @abstract
         */
        $.ajax({
            url: "AdminAssets/php/getDashboardUpdate.php",
            success: function(result){
                let updateJSON = JSON.parse(result);
                
                //check if response is good
                if(updateJSON[0] == "200"){
                    document.getElementById("updateBody").innerHTML = updateJSON[2]; //message body
                    document.getElementById("updateDate").innerHTML = updateJSON[3]; //mesage date
                    document.getElementById("updateImage").src = ("dashboard/images/" + updateJSON[4] + "?" + Date.now()); //Time is added as a fake query strign to prevent browser caching Image.
                }else{
                    document.getElementById("updateBody").innerHTML = "unable to fetch update!"; 
                    document.getElementById("updateDate").innerHTML = ""; 
                }
            }
        });

    </script>


    <div class="row2">
        <div class="weatherdisplay widget1">
            <div class="weatherHeader">
                    <label for="weatherSelect">Choose a Campus:</label>
                    <select id="weatherSelect" onchange="campusSelect()">
                        <option value="lat=54.9779843&lon=-1.6097892">City Campus</option>
                        <option value="lat=55.0066217&lon=-1.5778385">Coach Lane</option>
                    </select>
            </div>
            <div class="mainWeatherDisplay">
                <div class="timeLoaction">
                    <p id="weatherTime">...</p>
                    <p id="weatherLoaction">...</p>
                </div>
                <div class="mainDisplay">
                    <div id="weatherIcon"> 
                        <img id="icon" src="#" alt="current weathe display">
                    </div>
                    <div id="weatherTemp">...</div>
                </div>
                <div class="additonalWeather">
                    <p id="weatherFeelsLike">Feels Like ...</p>
                    <p id="weatherDescription">...</p>
                </div>
            </div>
            <div id="hourWeatherDisplay">
            </div>


        </div>

        <div id="busTimetable" class="widget1">
            <div class="timeTableHead">
                <div id="busTitle">
                    <span id="LiveDot">🔴</span>
                    <p> Bus Times:</p> 
                </div>
                <div id="StopSelectCont">
                    <label for="stopsSelect">Choose a Destination:</label>
                    <select id="stopsSelect" onchange="refreshBusTimetable()">
                        <option value="410000015640">City Campus</option>
                        <option value="410000009923">Coach Lane</option>
                    </select>
                </div>  
            </div>
            <div id="busTimetableListings">

            </div>
            <div id="BusUpdatedStatus"></div>
            <button id="busRefreshButton" onclick="refreshBusTimetable()">Refresh</button>
            <button id="showStopButton" >Show Stop On Map</button>
        </div>
    </div>

    <div class="row2"  id="maprow">
        <div id="map"></div>        
    </div>

    <div class="row2">

        <div id="parkingInfo" class="widget1">
            
            <h2><img src='dashboard/icons/parking.png' style='height:40px;margin-right:5px;' alt="parking icon"> Parking Near Campus</h2>
            <div class="carparkRow">
                <div class="upperRow">
                    <h2>Ellison Place - <span id="parkState1">spaces</span></h2>
                    <button id="parkButton1">show on map</button>
                </div>
                <div class="lowerRow">
                    <h3><span id="parkOccupied1">X</span>/<span id="parkCapacity1">X</span>  free spaces</h3>
                    <p> at: <span id="parkTime1">time</span>
                </div>
            </div>
            <div class="carparkRow">
                <div class="upperRow">
                    <h2>Manors Car Park - <span id="parkState2">spaces</span></h2>
                    <button id="parkButton2">show on map</button>
                </div>
                <div class="lowerRow">
                    <h3><span id="parkOccupied2">X</span>/<span id="parkCapacity2">X</span>  free spaces</h3>
                    <p> at: <span id="parkTime2">time</span>
                </div>
            </div>
            <div class="carparkRow">
                <div class="upperRow">
                    <h2>Eldon Square - <span id="parkState3">spaces</span></h2>
                    <button id="parkButton3">show on map</button>
                </div>
                <div class="lowerRow">
                    <h3><span id="parkOccupied3">X</span>/<span id="parkCapacity3">X</span> free spaces</h3>
                    <p> at: <span id="parkTime3">time</span>
                </div>
            </div>
            <div class="carparkRow">
                <div class="upperRow">
                    <h2>Eldon Garden - <span id="parkState4">spaces</span></h2>
                    <button id="parkButton4">show on map</button>
                </div>
                <div class="lowerRow">
                    <h3><span id="parkOccupied4">X</span>/<span id="parkCapacity4">X</span> free spaces</h3>
                    <p> at: <span id="parkTime4">time</span>
                </div>
            </div>

        </div>


        <div id="twitterFeed" class="widget1">
            <h2>Twitter Feed</h2>
            <p> recent tweets from offical Nortumbria accounts </p>
        </div>

        <style>


        </style>

    </div>


    <div class="row3">
       
            <div class="square bg img1">
            <a href="https://www.northumbria.ac.uk/about-us/our-campuses/coach-lane-campus/new-no-1-bus-service-to-coach-lane/">
                <div class="content">
                    University Bus Information
                </div>
                </a>
            </div>

        <div class="square bg img2">
            <a href="https://www.northumbria.ac.uk/about-us/facilities-services/around-campus/">
                <div class="content">
                    What's Around Campus
                </div>
            </a>
        </div>
        <div class="square bg img3">
            <a href="https://www.northumbria.ac.uk/about-us/facilities-services/safety-on-campus/">
                <div class="content">
                    Safety on Campus
                </div>
            </a>
        </div>

    </div>

    <script src="dashboard/js/bustimes.js"></script>
    <script src="dashboard/js/weather.js"></script>
    <script src="dashboard/js/carparks.js"></script>
    <script src="dashboard/js/twitterFeed.js"></script>
    <script src="dashboard/js/map.js"></script>

    <?php include "footer.php" ?>
</body>

</html>


