
/**
 * Script to handle weather widget functionality 
 * @author Tom Hegarty
 */

/**
 * fucntion to retreieve weater datae based on campus slected 
 * 
 * @param {STRING} campus - latitued and logitude of campus location 
 */
function currentWeather(campus) {
  var url = "http://api.openweathermap.org/data/2.5/weather?" + campus + "&appid=c58da940acce3c6f01464a5c6ea5edb8";
  fetch(url)
    .then(function (resp) { return resp.json() })
    .then(function (data) {
      time = new Date(data.dt * 1000);
      document.getElementById("weatherTime").innerHTML = ("Last Updated: " + time.getHours() + ":" + time.getMinutes());
      if (campus == "lat=54.9779843&lon=-1.6097892") {
        campusName = "Newcastle City Campus";
      } else if (campus == "lat=55.0066217&lon=-1.5778385") {
        campusName = "Coach Lane Campus";
      } else if (campus == "lat=51.5178234&lon=-0.0800967") {
        campusName = "London Campus";
      } else if (campus == "lat=52.3462904&lon=4.9153553") {
        campusName = "Amsterdam Campus";
      }

      document.getElementById("weatherLoaction").innerHTML = (campusName);
      document.getElementById("icon").src = ("dashboard/icons/" + (data.weather[0].icon) + ".png");
      document.getElementById("weatherTemp").innerHTML = (Math.floor(data.main.temp - 273.15) + "°C");
      document.getElementById("weatherFeelsLike").innerHTML = ("Feels Like " + Math.floor(data.main.feels_like - 273.15) + "°C");
      document.getElementById("weatherDescription").innerHTML = (data.weather[0].description);
    })
    .catch(function () {
      // catch any errors
      console.log("could not update weather");
    });
}

/**
 * function to get weather for each day of the week, and add element to display
 * @param {STRING} campus - latitued and logitude of campus location 
 */
function dailyWeather(campus) {
  var url = "https://api.openweathermap.org/data/2.5/onecall?" + campus + "&exclude=current,minutely,daily&appid=c58da940acce3c6f01464a5c6ea5edb8";
  fetch(url)
    .then(function (resp) { return resp.json() })
    .then(function (data) {
      var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
      document.getElementById('hourWeatherDisplay').innerHTML = "";
      for (i = 0; i < 20; i++) {
        //getting time
        var date = new Date(data.hourly[i].dt * 1000);
        var weekday = days[date.getDay()];
        var day = weekday + " " + (date.getHours() + ":00");

        //getiing Icon
        let icon = ("dashboard/icons/" + data.hourly[i].weather[0].icon + ".png");

        //get temp
        let temp = (Math.floor(data.hourly[i].temp - 273.15) + "°C");

        //getting description
        let desc = (data.hourly[i].weather[0].description);

        document.getElementById('hourWeatherDisplay').innerHTML += ("<div class='hourWeatherCard'><p>" + day + "</p><div class='hourIcon'><img src='" + icon + "' alt='weather icon'></div><b><p>" + temp + "</p></b><p id='hourDesc'>" + desc + "</p><div class='hourTemp'></div></div>");
      }
    })
    .catch(function () {
      console.log("error fetching weather data");
    });

}

//upon slecting a new campus on the dashbaord, this fucntion calls both others to update
function campusSelect() {
  loac = document.getElementById("weatherSelect").value;
  currentWeather(loac);
  dailyWeather(loac);
}

//initally loads City Campus weather 
window.onload = function () {
  currentWeather("lat=54.9779843&lon=-1.6097892");
  dailyWeather("lat=54.9779843&lon=-1.6097892");
}
