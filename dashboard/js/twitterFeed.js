function getTweets(){
    $.ajax({
        type: 'POST', 
        url: "dashboard/php/twitter.php",
        success: function(data){
            console.log(JSON.parse(data));
            var JSONtweets = JSON.parse(data);

            for(i=0; i < JSONtweets.length;i++){
                formatTweet(JSONtweets[i].full_text, JSONtweets[i].user.name, (JSONtweets[i].created_at).substring(4).slice(0,- 14));
            }

            function formatTweet(full_text, username, time){
                document.getElementById("twitterFeed").innerHTML += '<div class="tweetbox"><p class="tweetusername"> From @' + username + '</p><p>' + time + '</p><p class="tweetText">' + full_text + '</p></div>';
            }

        }
    });
}

getTweets();