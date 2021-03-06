/**
 * Fetch BusShedule - 
 * @Tom Hegarty 
 * 
 * @param {STRING} time - curent time converted Time stamp to form formatted needed for API (hr:min:sec)
 * @param {STRING} date - curent time converted for API (m/d/y)
 */
function FetchBusTimes(time, date){
    let stop = document.getElementById("stopsSelect").value
    console.log("stop" + stop);
    let url = "https://transportapi.com/v3/uk/bus/stop/" + stop + "/" + date + "/" + time + "/timetable.json?app_id=4f0d5f61&app_key=103f068736e3b4f9f36bef578e49c5df&group=route&limit=10";
    fetch(url)
    .then(response => response.json())
    .then(data => BusSchedule(data, time, date))
}

/**
 * BusSchedule - renders bus times to DOM, runs async to not block other renders
 * @Tom Hegarty
 * 
 * @param {String} data - data returned from FetchBusTimes api call
 * @param {TimeStamp} time - current date (cleint browser)
 * @param {TimeStamp} date - current time (cleint browser)
 */
async function BusSchedule(data, time, date){
    document.getElementById("BusUpdatedStatus").innerHTML = ("<p id='updateStatus'>Updated at: " + time + " " + date + "</p>" );
    document.getElementById("busTimetableListings").innerHTML = "";
    for(i=0;i<data.departures[1].length; i++){
        const arival = await getArivalTime(data.departures[1][i].id)
        document.getElementById("busTimetableListings").innerHTML += ("<div class='timeTableRow'><img src='dashboard/icons/front-of-bus.svg' alt='bus icon' style='height:30px;'> <p>Bus " + data.departures[1][i].line + " Departs : <b>" + data.departures[1][i].best_departure_estimate + "</b> Arrives: " + arival  + "</p></div>");
    }
}

/**
 * getArival time - gets time that the bus reaches last stop on its route
 * 
 * this function is only needed to to stay within free teir of the API. If business
 * subscription was set up, a diferent endpoint could be accessed to retrive arrival and 
 * start times in a single call
 * 
 * this fucntion uses async/await to ensure returend arival times are correctly matched to routes, this 
 * significantly hurts preformance. this woudl be significantly faster with a better endpoint. 
 * 
 * @Tom Hegarty
 * 
 * @param {STRING} url - url to for the specific route details  
 */
async function getArivalTime(url) {
    try {
        const response = await fetch(url, {
            method: 'GET',
            credentials: 'same-origin'
        });
        //wait for response before trying next iteration
        const ariveTime = await response.json();

        if(ariveTime.dir == "outbound"){
            //coach lane camus is the 17th stop on this route
            return ariveTime.stops[17].time;
        }else{
            //if round is inbound from coach lane, civic centre (free stop) is the 19th stop on the route
            return ariveTime.stops[19].time;
        };

        //return ariveTime.stops[stops.length].time;

    } catch (error) {
        console.error(error);
    }
}

/**
 * refeshBusTimtable - reloads FetchBusTimes based on current time (clients browser time)
 * @Tom Hegarty
 * 
 */
function refreshBusTimetable(){
    document.getElementById("busTimetableListings").innerHTML = "<p>Loading...(api calls commented out for testing, busTimes.js line 84)</p>";
    let d = new Date();
    let busTime = (d.getHours() + ":" + d.getMinutes());
    let busDate = (d.getUTCFullYear() + "-" + (d.getUTCMonth() + 1) + "-" + d.getUTCDate());

    //main function to start timetable
    //FetchBusTimes(busTime, busDate);
}

//starts the bus time table   
refreshBusTimetable();
