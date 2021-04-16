/**
 * Fetch BusShedule - 
 * @author Tom Hegarty 
 * 
 * @param {STRING} time - curent time converted Time stamp to form formatted needed for API (hr:min:sec)
 * @param {STRING} date - curent time converted for API (m/d/y)
 */
function FetchBusTimes(time, date){
    let stop = document.getElementById("stopsSelect").value
    let url = "https://transportapi.com/v3/uk/bus/stop/" + stop + "/" + date + "/" + time + "/timetable.json?app_id=4f0d5f61&app_key=103f068736e3b4f9f36bef578e49c5df&group=route&limit=20";
    fetch(url)
    .then(response => response.json())
    .then(data => BusSchedule(data, time, date))
}

/**
 * BusSchedule - renders bus times to DOM, runs async to not block other renders
 * @author Tom Hegarty
 * 
 * @param {String} data - data returned from FetchBusTimes api call
 * @param {TimeStamp} time - current date (client browser)
 * @param {TimeStamp} date - current time (client browser)
 */
async function BusSchedule(data, time, date){
    document.getElementById("BusUpdatedStatus").innerHTML = ("<p id='updateStatus'>Updated at: " + time +  "</p>" );
    document.getElementById("busTimetableListings").innerHTML = "";
    for(i=0;i<data.departures[1].length; i++){

        //calculage best arival time based on route lenght and live departure time
        let arival = calculateArival(data.departures[1][i].best_departure_estimate, "00:21");
        document.getElementById("busTimetableListings").innerHTML += (
            "<div class='timeTableRow'>" +
                "<img src='dashboard/icons/front-of-bus.svg' alt='bus icon' style='height:30px;'>" +
                "<p>Bus " + data.departures[1][i].line + " Departs : <b>" + data.departures[1][i].best_departure_estimate + "</b> Arrives:<b> " + arival  + "</b></p>" +
            "</div>");
    }
}

/**
 * refeshBusTimtable - reloads FetchBusTimes based on current time (clients browser time)
 * @author Tom Hegarty
 * 
 */
function refreshBusTimetable(){
    document.getElementById("busTimetableListings").innerHTML = "<div class='loader'></div>";
    let d = new Date();
    let busTime = (d.getHours() + ":" + d.getMinutes());
    let busDate = (d.getUTCFullYear() + "-" + (d.getUTCMonth() + 1) + "-" + d.getUTCDate());

    //main function to start timetable
    FetchBusTimes(busTime, busDate);
}


/**
 *  The chosen API does not support a live arival time, this fucntion is used to calulate the 
 *  best possible time by adding the expect route tim of 21mins to the live departure time
 * 
 *  adding time in a human reading string format 
 * 
 * @param {String} departureTime - live depature time supplied by API
 * @param {String} routeTime - time taken for route
 */
function calculateArival(departureTime, routeTime) {

    var arivalTime = [0, 0];
    var max = arivalTime.length;

    var departure = (departureTime || '').split(':');
    var route = (routeTime || '').split(':');


    for (var i = 0; i < max; i++) {
        departure[i] = isNaN(parseInt(departure[i])) ? 0 : parseInt(departure[i]);
        route[i] = isNaN(parseInt(route[i])) ? 0 : parseInt(route[i]);
    }

    //add the values for times togehter to get total route time
    for (var i = 0; i < max; i++) {
        arivalTime[i] = departure[i] + route[i];
    }

    var hours = arivalTime[0];
    var minutes = arivalTime[1];

    //check if minutes are over 60, handle the carry over
    if (minutes >= 60) {
        var carryover = (minutes / 60) << 0
        hours += carryover
        minutes -= 60 * carryover
    }

    return ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2);
}

//starts the bus time table   
refreshBusTimetable();
