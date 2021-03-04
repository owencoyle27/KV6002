


function fetchSpaces() {
    //2021 03 02 12 10 00
    //2021 03 02 12 20 00

    //formatting current date to format yyyymmddhhmm required for API
    let d = new Date();
    let EndTime = (d.getUTCFullYear() +  (addLeadingZero(d.getUTCMonth() + 1)) + (addLeadingZero(d.getUTCDate())) + (addLeadingZero(d.getHours())) +  (addLeadingZero(d.getMinutes())));
    //get values from past 10 mins 
    let s = new Date(d - 6000000);
    let StartTime = (s.getUTCFullYear() +  (addLeadingZero(s.getUTCMonth() + 1)) + (addLeadingZero(s.getUTCDate())) + (addLeadingZero(s.getHours())) +  (addLeadingZero(s.getMinutes())));
    
    
    console.log(EndTime);
    console.log(StartTime);

    var apiurl = "http://uoweb3.ncl.ac.uk/api/v1.1/sensors/PER_CARPARK_ELLISON_PLACE_CP_TRAF/data/json/?starttime=" + StartTime + "&endtime=" + EndTime ;
    console.log(apiurl);
    $.ajax({
        type: 'POST', 
        url: "curl.php",
        data: { parkapiurl : apiurl },
        success: function(result){
            console.log(result);
            //urban observatory API returns invalid JSON!!! slice is used to remove errous characters
            const editedresult = result.slice(0, -1);
            const editedresult2 = editedresult.slice(0, -1);
            console.log(editedresult2);
            console.log(result.length);
            console.log(JSON.parse(editedresult2));
            //console.log(JSON.parse(editedresult));
        } 
    });

}

function addLeadingZero(number){
    var newValue = number;
    if(number < 10){
        newValue = ('0' + number); 
    }
    return (newValue); 
}

fetchSpaces();