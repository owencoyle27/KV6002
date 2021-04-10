/**
 * Script to handle mapBox api, laod 2d map onto dashboard and drop pins on locations
 * 
 * @author Tom Hegarty
 */

mapboxgl.accessToken = 'pk.eyJ1Ijoib3dlbmNveWxlMjEiLCJhIjoiY2tsc2p3MWgyMGF5dDJwbnh3M3E0Z2s2ayJ9.GAKLti4vJ81ac_bctZRxaw';
 
//instanciate new map elelemnt using groups MapBox API token
var map = new mapboxgl.Map({
    container: 'map', 
    style: 'mapbox://styles/mapbox/streets-v11', 
    center: [ -1.609, 54.97], 
    zoom: 16
});

//marker for carpark 1
document.getElementById("parkButton1").onclick = function(){

    let marker = new mapboxgl.Marker().setLngLat([-1.6083315, 54.9758702]).addTo(map);
    map.flyTo({
        center: [-1.6083315, 54.9758702],
        essential: true
    });
    document.getElementById("maprow").style.height = "auto";
    document.getElementById("maprow").style.visibility = "visible";
    document.getElementById("map").scrollIntoView();
};

//marker for carpark 2
document.getElementById("parkButton2").onclick = function(){
    let marker = new mapboxgl.Marker().setLngLat([-1.606887, 54.9726012]).addTo(map);
    map.flyTo({
        center: [-1.606887, 54.9726012],
        essential: true
    });
    document.getElementById("maprow").style.height = "auto";
    document.getElementById("maprow").style.visibility = "visible";
    document.getElementById("map").scrollIntoView();

};

//marker for carpark 3
document.getElementById("parkButton3").onclick = function(){
    let marker = new mapboxgl.Marker().setLngLat([-1.615571, 54.975901]).addTo(map);
    map.flyTo({
        center: [-1.615571, 54.975901],
        essential: true
    });
    document.getElementById("maprow").style.height = "auto";
    document.getElementById("maprow").style.visibility = "visible";
    document.getElementById("map").scrollIntoView();
};

//marker for carpark 4
document.getElementById("parkButton4").onclick = function(){
    let marker = new mapboxgl.Marker().setLngLat([-1.6168294, 54.9763291]).addTo(map);
    map.flyTo({
        center: [-1.6168294, 54.9763291],
        essential: true
    });
    document.getElementById("maprow").style.height = "auto";
    document.getElementById("maprow").style.visibility = "visible";
    document.getElementById("map").scrollIntoView();
};

//markers for bus stops 
//show markers for bus the curretly slected bus stop 
document.getElementById("showStopButton").onclick = function(){
    let stopCode = document.getElementById("stopsSelect").value;

    if(stopCode == "410000015640"){
        var stopLatLng = [-1.6097506, 54.9787097];
    }else{
        var stopLatLng = [-1.5716813, 55.0058075];
    }

    let marker = new mapboxgl.Marker().setLngLat(stopLatLng).addTo(map);
    map.flyTo({
        center: stopLatLng ,
        essential: true,
    });
    document.getElementById("maprow").style.height = "auto";
    document.getElementById("maprow").style.visibility = "visible";
    document.getElementById("map").scrollIntoView(); 
};
