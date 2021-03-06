


function fetchSpaces(location) {

    if(location == "ellison"){
        var dynamicURL = "https://www.netraveldata.co.uk/api/v2/carpark/dynamic/CP_NC_ELLSPL";
        var staticURL = "https://www.netraveldata.co.uk/api/v2/carpark/static/CP_NC_ELLSPL";
        var index = 1;
    }else if(location == "manors"){
        var dynamicURL = "https://www.netraveldata.co.uk/api/v2/carpark/dynamic/CP_NC_MANORS";
        var staticURL = "https://www.netraveldata.co.uk/api/v2/carpark/static/CP_NC_MANORS";
        var index = 2;
    }else if(location == "eldon"){
        var dynamicURL = "https://www.netraveldata.co.uk/api/v2/carpark/dynamic/CP0050";
        var staticURL = "https://www.netraveldata.co.uk/api/v2/carpark/static/CP0050";
        var index = 3;
    }else if(location == "eldonGarden"){
        var dynamicURL = "https://www.netraveldata.co.uk/api/v2/carpark/dynamic/CP0049";
        var staticURL = "https://www.netraveldata.co.uk/api/v2/carpark/static/CP0049";
        var index = 4;
    }

    function getCapacity(capacity){
        $.ajax({
            type: 'POST', 
            url: "dashboard/php/getCarPark.php",
            data: { parkapiurl : dynamicURL },
            success: function(data){
                let result = (JSON.parse(data));

                let updateTime = (result.dynamics[0].lastUpdated);
                let formatTime = updateTime.match(/\d\d:\d\d/);
                let spacesOutput =  (result.dynamics[0].occupancy);
                let stateOutput = (result.dynamics[0].stateDescription);
        
                document.getElementById("parkOccupied" + index).innerHTML = (capacity - spacesOutput);
                document.getElementById("parkTime" + index).innerHTML = formatTime;
                document.getElementById("parkState" + index).innerHTML = stateOutput;
                document.getElementById("parkCapacity" + index).innerHTML =  capacity;


                //gets colour between red and green depending on capacity 
                let colorValue = (spacesOutput / capacity);

                function getColor(value){
                    var hue=((1-value)*120).toString(10);
                    return ["hsl(",hue,",100%,50%)"].join("");
                }
                
                document.getElementById("parkState" + index).style.background = getColor(colorValue);
            }
        });
    }

    $.ajax({
        type: 'POST', 
        url: "dashboard/php/getCarParkCapacity.php",
        data: { parkapiurl : staticURL },
        success: function(result){
            var capacity = (JSON.parse(result).configurations[0].capacity);
            getCapacity(capacity);
        }
    });

}

fetchSpaces("ellison");
fetchSpaces("manors");
fetchSpaces("eldon");
fetchSpaces("eldonGarden");