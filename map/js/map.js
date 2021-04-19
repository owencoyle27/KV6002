if (!('remove' in Element.prototype)) {
    Element.prototype.remove = function() {
        if (this.parentNode) {
            this.parentNode.removeChild(this);
        }
    };
}

mapboxgl.accessToken = 'pk.eyJ1Ijoib3dlbmNveWxlMjEiLCJhIjoiY2tsc2p3MWgyMGF5dDJwbnh3M3E0Z2s2ayJ9.GAKLti4vJ81ac_bctZRxaw';

var map = new mapboxgl.Map({
    style: 'mapbox://styles/mapbox/light-v10',
    center: [-1.606395,54.977053],
    zoom: 15.91,
    pitch: 41,
    bearing: 12.8,
    container: 'map',
    antialias: true
});

var POI = {
    "type": "FeatureCollection",
    "features": []
}

var currentmarkers=[];


map.on('load', function (e) {
    map.addLayer(
        {
            'id': '3d-buildings',
            'source': 'composite',
            'source-layer': 'building',
            'filter': ['==', 'extrude', 'true'],
            'type': 'fill-extrusion',
            'minzoom': 15,
            'paint': {
                'fill-extrusion-color': '#aaa',
                'fill-extrusion-height': [
                    'interpolate',
                    ['linear'],
                    ['zoom'],
                    15,
                    0,
                    15.05,
                    ['get', 'height']
                ],
                'fill-extrusion-base': [
                    'interpolate',
                    ['linear'],
                    ['zoom'],
                    15,
                    0,
                    15.05,
                    ['get', 'min_height']
                ],
                'fill-extrusion-opacity': 0.6
            }
        })
    d3.json(
        'map/geoJson/universityBuildings.geojson',
        function(err, data) {
            if (err) throw err;
            map.addSource('buildings', {
                'type': 'geojson',
                'data': data
            });

            map.addLayer({
                'id': 'buildings',
                'type': 'fill',
                'source': 'buildings',
                'layout': {},
                'paint': {
                    'fill-color': '#088',
                    'fill-opacity': 0.8
                }
            });
        });


    map.addSource('places', {
        type: 'geojson',
        data: POI
    });


    map.on('click', function(e) {
        var features = map.queryRenderedFeatures(e.point, {
            layers: ['locations']
        });
        if (features.length) {
            var clickedPoint = features[0];
            flyToStore(clickedPoint);
            createPopUp(clickedPoint);

            var activeItem = document.getElementsByClassName('active');
            if (activeItem[0]) {
                activeItem[0].classList.remove('active');
            }
            var listing = document.getElementById('listing-' + clickedPoint.properties.id);
            listing.classList.add('active');
        }
    });
});

function generatePOI(category) {
    clearMarkers();
    switchStatement(category)
    buildLocationList(category)
    addMarkers(category);
}


function clearMarkers(){
    if (currentmarkers !== null) {
        for (var i = currentmarkers.length - 1; i >= 0; i--) {
            currentmarkers[i].remove();
        }
    }
}

function switchStatement(category) {
    POI.features.length = 0
    console.log(category);
    switch (category) {
        case "foodAndDrink":
            $.ajax({
                url: 'http://api.ratings.food.gov.uk/establishments?localAuthorityId=122&businessTypeId=7844&longitude=-1.607&latitude=54.977&maxDistanceLimit=1',
                method: 'GET',
                dataType: 'json',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("x-api-version", "2");
                    xhr.setRequestHeader("accept", "application/json");
                },
                success: function (data) {
                    for (var i = 0; i < data.establishments.length; i++) {

                        let value = data.establishments[i];
                        let object = {

                            'type': 'Feature',
                            'geometry': {
                                'type': 'Point',
                                'coordinates': [value.geocode.longitude, value.geocode.latitude]
                            },
                            'properties': {
                                'phoneFormatted': '(202) 234-7336',
                                'businessname': value.BusinessName,
                                'businesstype': value.BusinessType,
                                'phone': value.Phone,
                                'address': value.AddressLine1,
                                'addressline2': value.AddressLine2,
                                'addressline3': value.AddressLine3,
                                'addressline4': value.AddressLine4,
                                'hygene': value.RatingValue,
                            }
                        }


                        POI.features.forEach(function (poi, i) {
                            poi.properties.id = i;
                        });
                        POI.features.push(object);
                    }
                }
            });

            break;
        case "shops":
            $.ajax({
                url: 'https://overpass-api.de/api/interpreter?data=%5Bout%3Ajson%5D%5Btimeout%3A25%5D%3B%0A%28%0A%20%20node%5B%22shop%22%5D%2854.973247949577654%2C-1.6135525703430176%2C54.98111698792517%2C-1.5984570980072021%29%3B%0A%20%20way%5B%22shop%22%5D%2854.973247949577654%2C-1.6135525703430176%2C54.98111698792517%2C-1.5984570980072021%29%3B%0A%20%20relation%5B%22shop%22%5D%2854.973247949577654%2C-1.6135525703430176%2C54.98111698792517%2C-1.5984570980072021%29%3B%0A%29%3B%0Aout%20body%3B%0A%3E%3B%0Aout%20skel%20qt%3B',
                method: 'GET',
                dataType: 'json',
                success: function (data) {

                    for (var i = 0; i < data.elements.length; i++) {

                        let value = data.elements[i];

                        if (value.tags.name !== null) {
                            let object = {

                                'type': 'Feature',
                                'geometry': {
                                    'type': 'Point',
                                    'coordinates': [value.lon, value.lat]
                                },
                                'properties': {
                                    'phoneFormatted': '(202) 234-7336',
                                    'businessname': value.tags.name,
                                    'address': value.tags['addr:street'],
                                }
                            }
                            POI.features.forEach(function (poi, i) {
                                poi.properties.id = i;
                            });
                            POI.features.push(object);
                        }
                    }
                }
            });
            break;
        case "cashMachines":
            $.ajax({
                url: 'https://overpass-api.de/api/interpreter?data=%5Bout%3Ajson%5D%5Btimeout%3A25%5D%3B%0A%28%0A%20%20node%5B%22amenity%22%3D%22atm%22%5D%2854.973247949577654%2C-1.6135525703430176%2C54.98111698792517%2C-1.5984570980072021%29%3B%0A%29%3B%0Aout%20body%3B%0A%3E%3B%0Aout%20skel%20qt%3B',
                method: 'GET',
                dataType: 'json',
                success: function (data) {

                    for (var i = 0; i < data.elements.length; i++) {

                        let value = data.elements[i];
                        let object = {

                            'type': 'Feature',
                            'geometry': {
                                'type': 'Point',
                                'coordinates': [value.lon, value.lat]
                            },
                            'properties': {
                                'businessname': "Cash Machine / ATM",
                                'address': "Newcastle-Upon-Tyne",
                            }
                        }
                        POI.features.forEach(function (poi, i) {
                            poi.properties.id = i;
                        });
                        POI.features.push(object);
                    }
                }
            });
            break;
            case "uniBuildings":
                console.log("test");
                $.ajax({
                    url: '/map/js/getUniBuildings.php',
                    method: 'GET',
                    success: function (data) {
                        for (i = 0; i < data.length; i++)
                        {
                            let value = data[i];
                            let object = {

                                'type': 'Feature',
                                'geometry': {
                                    'type': 'Point',
                                    'coordinates': [value[5], value[4]]
                                },
                                'properties': {
                                    'businessname': value[1],
                                    'address': ("Opening time: <b>" + value[2] + "</b> <br> Closing time: <b>" + value[3] + "</b>")
                                }
                            }

                            POI.features.forEach(function (poi, i) {
                                poi.properties.id = i;
                            });
                            POI.features.push(object);
                            console.log(object);
                        }
                        console.log(POI);
                    }
                });

            break;
            case "busStops":
                $.ajax({
                    url: 'https://overpass-api.de/api/interpreter?data=%5Bout%3Ajson%5D%5Btimeout%3A25%5D%3B%0A%28%0A%20%20node%5B%22public_transport%22%3D%22platform%22%5D%5B%22bus%22%3D%22yes%22%5D%2854.97322947584234%2C-1.6137349605560303%2C54.981098517809905%2C-1.5986394882202148%29%3B%0A%29%3B%0Aout%20body%3B%0A%3E%3B%0Aout%20skel%20qt%3B',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {

                        for (var i = 0; i < data.elements.length; i++) {

                            let value = data.elements[i];
                            let object = {

                                'type': 'Feature',
                                'geometry': {
                                    'type': 'Point',
                                    'coordinates': [value.lon, value.lat]
                                },
                                'properties': {
                                    'businessname': value.tags.name,
                                    'address': value.tags['naptan:Street'],
                                }
                            }
                            POI.features.forEach(function (poi, i) {
                                poi.properties.id = i;
                            });
                            POI.features.push(object);
                        }
                    }
                });
            break;


            case "postBoxes":
                $.ajax({
                    url: 'https://overpass-api.de/api/interpreter?data=%5Bout%3Ajson%5D%5Btimeout%3A25%5D%3B%0A%28%0A%20%20node%5B%22amenity%22%3D%22post_box%22%5D%2854.97321716001407%2C-1.6152477264404295%2C54.98108620439502%2C-1.6001522541046143%29%3B%0A%29%3B%0Aout%20body%3B%0A%3E%3B%0Aout%20skel%20qt%3B',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {

                        for (var i = 0; i < data.elements.length; i++) {

                            let value = data.elements[i];
                            let object = {

                                'type': 'Feature',
                                'geometry': {
                                    'type': 'Point',
                                    'coordinates': [value.lon, value.lat]
                                },
                                'properties': {
                                    'businessname': "Royal Mail Postbox",
                                    'address': value.tags.ref,
                                }
                            }
                            POI.features.forEach(function (poi, i) {
                                poi.properties.id = i;
                            });
                            POI.features.push(object);
                        }
                    }
                });
            break;
    }
}


function addMarkers(category) {
    setTimeout(() => {
    POI.features.forEach(function(marker) {
        var el = document.createElement('div');
        el.id = "marker-" + marker.properties.id;
        el.classList.add('marker', category);


        var newmarker = new mapboxgl.Marker(el, { offset: [0, -23] })
            .setLngLat(marker.geometry.coordinates)
            .addTo(map);

        currentmarkers.push(newmarker);


        el.addEventListener('click', function(e){
            /* Fly to the point */
            flyToStore(marker);
            /* Close all other popups and display popup for clicked store */
            createPopUp(marker);
            /* Highlight listing in sidebar */
            var activeItem = document.getElementsByClassName('active');
            e.stopPropagation();
            if (activeItem[0]) {
                activeItem[0].classList.remove('active');
            }
            var listing = document.getElementById('listing-' + marker.properties.id);
            listing.classList.add('active');
        });
    });
    }, 500);

}


function buildLocationList(category) {

    let data = POI;

    setTimeout(() => {

    data.features.forEach(function (store, i) {
        var prop = store.properties;


        var listings = document.getElementById(category + 'listing');
        var listing = listings.appendChild(document.createElement('div'));
        listing.id = "listing-" + data.features[i].properties.id;
        listing.className = 'item';

        var link = listing.appendChild(document.createElement('a'));
        link.href = '#';
        link.className = 'title';
        link.id = "link-" + prop.id;
        link.innerHTML = prop.businessname;

        var details = listing.appendChild(document.createElement('div'));
        details.innerHTML = prop.address;
        if (prop.phone) {
            details.innerHTML += ' · ' + prop.phoneFormatted;
        }
        if (prop.distance) {
            var roundedDistance = Math.round(prop.distance * 100) / 100;
            details.innerHTML +=
                '<p><strong>' + roundedDistance + ' miles away</strong></p>';
        }

        link.addEventListener('click', function (e) {
            for (var i = 0; i < data.features.length; i++) {
                if (this.id === "link-" + data.features[i].properties.id) {
                    var clickedListing = data.features[i];
                    flyToStore(clickedListing);
                    createPopUp(clickedListing);
                }
            }
            var activeItem = document.getElementsByClassName('active');
            if (activeItem[0]) {
                activeItem[0].classList.remove('active');
            }
            this.parentNode.classList.add('active');
        });
    });
    }, 1500);
}

function flyToStore(currentFeature) {
    map.flyTo({
        center: currentFeature.geometry.coordinates,
        zoom: 15
    });
}

function createPopUp(currentFeature) {
    var popUps = document.getElementsByClassName('mapboxgl-popup');
    if (popUps[0]) popUps[0].remove();

    var popup = new mapboxgl.Popup({ closeOnClick: false })
        .setLngLat(currentFeature.geometry.coordinates)
        .setHTML('<h3>' + currentFeature.properties.businessname + '</h3>' +
            '<h4>' + currentFeature.properties.address + '</h4>')
        .addTo(map);
}

function clickHandle(evt, categoryName) {


    console.log(categoryName)

    generatePOI(categoryName)


    let i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(categoryName).style.display = "block";
    evt.currentTarget.className += " active";
}

