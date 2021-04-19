

  /**
   * function to get weather for each day of the week, and add element to display
   * 
   */
  function currentWeather(campus) {
    var url = "http://api.openweathermap.org/data/2.5/weather?" + campus + "&appid=c58da940acce3c6f01464a5c6ea5edb8";
    fetch(url)  
    .then(function(resp) { return resp.json() }) 
    .then(function(data) {
      time = new Date(data.dt * 1000);
      document.getElementById("weatherTime").innerHTML = (time.getHours() + ":" + time.getMinutes());
      if(campus == "lat=54.9779843&lon=-1.6097892"){
        campusName = "Newcastle City Campus";
      }else if(campus == "lat=55.0066217&lon=-1.5778385"){
        campusName = "Coach Lane Campus";
      }
      document.getElementById("weatherLoaction").innerHTML = (campusName);
      document.getElementById("icon").src = ("dashboard/icons/" + (data.weather[0].icon) + ".png");
      document.getElementById("weatherTemp").innerHTML = (Math.floor(data.main.temp - 273.15) + "°C");
      document.getElementById("weatherFeelsLike").innerHTML = ("Feels Like " + Math.floor(data.main.feels_like - 273.15) + "°C");
      document.getElementById("weatherDescription").innerHTML = (data.weather[0].description);
    })
    .catch(function() {
      // catch any errors
    });
  }

  /**
   * function to get weather for each day of the week, and add element to display
   * 
   */
  function dailyWeather(campus){
    var url ="https://api.openweathermap.org/data/2.5/onecall?" + campus + "&exclude=current,minutely,hourly&appid=c58da940acce3c6f01464a5c6ea5edb8";
    fetch(url)  
    .then(function(resp) { return resp.json() }) 
    .then(function(data) {    
      var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
      document.getElementById('hourWeatherDisplay').innerHTML = "";
      for(i=0;i < data.daily.length; i++){
        //getting day
        var date = new Date(data.daily[i].dt * 1000);
        var day = date.getDay();

        //getiing Icon
        let icon = ("dashboard/icons/" + data.daily[i].weather[0].icon + ".png");

        //get temp
        let temp = (Math.floor(data.daily[i].temp.day - 273.15) + "°C");

        //getting description
        let desc = (data.daily[i].weather[0].description);

        document.getElementById('hourWeatherDisplay').innerHTML += ("<div class='hourWeatherCard'><p>" + days[day] + "</p><div class='hourIcon'><img src='" + icon + "' alt='weather icon'></div><b><p>" + temp + "</p></b><p id='hourDesc'>" + desc + "</p><div class='hourTemp'></div></div>"); 
      }
    })
    .catch(function() {
      console.log("error fetching weather data");
    });

  }

  function campusSelect(){
    loac = document.getElementById("weatherSelect").value;
    currentWeather(loac);
    dailyWeather(loac);
  }
  
  window.onload = function() {
      currentWeather("lat=54.9779843&lon=-1.6097892");
      dailyWeather("lat=54.9779843&lon=-1.6097892");
  }
