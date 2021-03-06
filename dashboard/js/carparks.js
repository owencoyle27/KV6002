


function fetchSpaces(location) {

    if(location == "ellison"){
        urlLoac = "PER_CARPARK_ELLISON_PLACE_CP_TRAF";
    }else if(location == "manors"){
        urlLoac = "PER_CARPARK_MANORS_CP_TRAF";
    }else if(location == "eldon"){
        urlLoac = "PER_CARPARK_ELDON_SQUARE_CP_TRAF";
    }

    //formatting current date to format yyyymmddhhmm required for API
    let d = new Date();
    let EndTime = (d.getUTCFullYear() +  (addLeadingZero(d.getUTCMonth() + 1)) + (addLeadingZero(d.getUTCDate())) + (addLeadingZero(d.getHours())) +  (addLeadingZero(d.getMinutes())));
    //get values from past 10 mins 
    let s = new Date(d - 60000000);
    let StartTime = (s.getUTCFullYear() +  (addLeadingZero(s.getUTCMonth() + 1)) + (addLeadingZero(s.getUTCDate())) + (addLeadingZero(s.getHours())) +  (addLeadingZero(s.getMinutes())));
    

    var apiurl = "http://uoweb3.ncl.ac.uk/api/v1.1/sensors/" + urlLoac +"/data/json/?starttime=" + StartTime + "&endtime=" + EndTime ;

    $.ajax({
        type: 'POST', 
        url: "dashboard/php/curl.php",
        data: { parkapiurl : apiurl },
        success: function(result){
            //urban observatory API returns invalid JSON!!! slice is used to remove errous characters
            //this is very verbous dealing with awkwardly formatted api return
            const editedresult = result.slice(0, -1);
            const editedresult2 = editedresult.slice(0, -1);
            let data = (JSON.parse(editedresult2));
            let count = (data.sensors[0].data["Occupied spaces"].length);
            let checkTime = data.sensors[0].data["Occupied spaces"][count - 1].Timestamp;
            let occupiedSpaces = data.sensors[0].data["Occupied spaces"][count - 1].Value;

            // formating time stamp to human readable time
            let date = new Date(checkTime);
            let hours = date.getHours();
            let minutes = "0" + date.getMinutes();

            var formattedTime = hours + ':' + minutes.substr(-2);

            var spaces = {
                occupied : occupiedSpaces,
                time : formattedTime,
            }
            updateDash(spaces, location);
        } 
    });


//testing new api 

    $.ajax({
        type: 'POST', 
        url: "dashboard/php/getCarPark.php",
        data: { parkapiurl : apiurl },
        success: function(result){
            updateDash(JSON.parse(result));
        }
    });



    function updateDash(result){
        console.log(result[87].dynamics[0].lastUpdated);

        let spacesOutput =  (result[87].dynamics[0].occupancy);
        let stateOutput = (result[87].dynamics[0].stateDescription);
        document.getElementById("parkOccupied1").innerHTML = "X"


    }

}

function addLeadingZero(number){
    var newValue = number;
    if(number < 10){
        newValue = ('0' + number); 
    }
    return (newValue); 
}

fetchSpaces("ellison");
//fetchSpaces("manors");
//fetchSpaces("eldon");