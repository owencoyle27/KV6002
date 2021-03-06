<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashboard/styles/dashboardStyle.css">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        campus updates, entered from form somewhere
    </div>
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
                        <img id="icon" src="">
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
            <button onclick="refreshBusTimetable()">Refresh</button>
        </div>
    </div>

    <div class="row2">

        <div id="parkingInfo" class="widget1">
            <h2>Parking Near Campus</h2>
            <div class="carparkRow">
                <div class="upperRow">
                    <h2>Ellison Place</h2>
                    <button>show on map</button>
                </div>
                <div class="lowerRow">
                    <h2><span id="parkOccupied1">X</span>/60 spaces</h2>
                    <p> updated at: <span id="parkTime1">time</span>
                </div>
            </div>
            <div class="carparkRow">
                <div class="upperRow">
                    <h2>Mannors Car Park</h2>
                    <button>show on map</button>
                </div>
                <div class="lowerRow">
                    <h2><span id="parkOccupied2">X</span>/200 spaces</h2>
                    <p> updated at: <span id="parkTime2">time</span>
                </div>
            </div>
            <div class="carparkRow">
                <div class="upperRow">
                    <h2>Eldon Square</h2>
                    <button>show on map</button>
                </div>
                <div class="lowerRow">
                    <h2><span id="parkOccupied3">X</span>/300 spaces</h2>
                    <p> updated at: <span id="parkTime3">time</span>
                </div>
            </div>

        </div>


        <div id="twitterFeed" class="widget1">
            <h2>Twitter Feed</h2>
        </div>

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
</body>

</html>


