<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
    <script src="https://kit.fontawesome.com/ba8f9bf1b9.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="map/css/Map.css">

</head>
<body>
<?php include "./newNav.php" ?>

<div class='sidebar'>
    <div class="tab">


        <button class="tablinks" onclick="clickHandle(event, 'uniBuildings')">
            <span class="fa-stack fa-2x">
                <i class="fa fa-circle fa-stack-2x" style="color: #0071bd"></i>
                <i class="far fa-circle fa-stack-2x "></i>
                <i class="fas fa-building fa-stack-1x"></i>
            </span>
        </button>

        <button class="tablinks" onclick="clickHandle(event, 'foodAndDrink')">
            <span class="fa-stack fa-2x">
                <i class="fa fa-circle fa-stack-2x" style="color: #295e33"></i>
                <i class="far fa-circle fa-stack-2x "></i>
                <i class="fas fa-utensils fa-stack-1x"></i>
            </span>
        </button>

        <button class="tablinks" onclick="clickHandle(event, 'shops')">
            <span class="fa-stack fa-2x">
                <i class="fa fa-circle fa-stack-2x" style="color: #e7eb86"></i>
                <i class="far fa-circle fa-stack-2x "></i>
                <i class="fas fa-shopping-cart fa-stack-1x"></i>
            </span>
        </button>

        <button class="tablinks" onclick="clickHandle(event, 'busStops')">
            <span class="fa-stack fa-2x">
                <i class="fa fa-circle fa-stack-2x" style="color: #b92928"></i>
                <i class="far fa-circle fa-stack-2x "></i>
                <i class="fas fa-bus fa-stack-1x"></i>
            </span>
        </button>

        <button class="tablinks" onclick="clickHandle(event, 'cashMachines')">
            <span class="fa-stack fa-2x">
                <i class="fa fa-circle fa-stack-2x" style="color: #a3a3a3"></i>
                <i class="far fa-circle fa-stack-2x "></i>
                <i class="fas fa-money-bill-wave fa-stack-1x"></i>
            </span>
        </button>



        <button class="tablinks" onclick="clickHandle(event, 'postBoxes')">
            <span class="fa-stack fa-2x">
                <i class="fa fa-circle fa-stack-2x" style="color: #ff0000"></i>
                <i class="far fa-circle fa-stack-2x "></i>
                <i class="fas fa-mail-bulk fa-stack-1x"></i>
            </span>
        </button>
    </div>



    <div id="uniBuildings" class="tabcontent">
        <h3>University Buildings</h3>
        <div id='uniBuildingslisting' class='listings'></div>
    </div>


    <div id="foodAndDrink" class="tabcontent">
        <h3>Food and Drink</h3>
        <div id='foodAndDrinklisting' class='listings'></div>
    </div>

    <div id="shops" class="tabcontent">
        <h3>Shops</h3>
        <div id='shopslisting' class='listings'></div>
    </div>

    <div id="cashMachines" class="tabcontent">
        <h3>Cash Machines</h3>
        <div id='cashMachineslisting' class='listings'></div>
    </div>


    <div id="busStops" class="tabcontent">
        <h3>Bus Stops</h3>
        <div id='busStopslisting' class='listings'></div>
    </div>

    <div id="postBoxes" class="tabcontent">
        <h3>Post Boxes</h3>
        <div id='postBoxeslisting' class='listings'></div>
    </div>
</div>
<div id="map" class="map"></div>


<script src="map/js/map.js"></script>

</body>
</html>