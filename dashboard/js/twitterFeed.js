
function getTweets(){
    account = document.getElementById("twitterSelect").value;
    document.getElementById("twitterFeed").innerHTML = "<div class='loader'></div>";

    $.ajax({
        type: 'POST', 
        url: "dashboard/php/twitter.php",
        data: { accountName : account },
        success: function(data){
            document.getElementById("twitterFeed").innerHTML = "<h2>Twitter Feed</h2><p> recent tweets from offical Nortumbria accounts </p>";
            var JSONtweets = JSON.parse(data);

            for(i=0; i < JSONtweets.length;i++){
                let image = null;

                //check if tweet has any images 
                if(JSONtweets[i].entities.media != null){
                    if(JSONtweets[i].entities.media[0].type == "photo"){
                        image = JSONtweets[i].entities.media[0].media_url;
                    }else{
                        image = null;
                    }
                }else{
                    image = null;
                }


                formatTweet(JSONtweets[i].full_text, JSONtweets[i].user.name, (JSONtweets[i].created_at).substring(4).slice(0,- 14), JSONtweets[i].user.profile_image_url, image);
            }

            function formatTweet(full_text, username, time, profilePicture, image){

                if(image != null){
                    image = '<img class="twitterImage" src="' + image +'" onclick="SizeTwitterImage(this)"></img>' + 
                            '<p class="twitterImagetext"> &#9650 Tap to expand image </p>';
                }else{
                    image = '';
                }

                document.getElementById("twitterFeed").innerHTML += 
                '<div class="tweetbox">' +
                    '<div class="tweetHeader">' +  
                        '<img src="' + profilePicture + '" alt="' + username +' profile picture">' +
                        '<p class="tweetusername">' + username + '</p>' + 
                        '<p class="twittertime">' +  time + '</p>' + 
                    '</div>' +
                    '<p class="tweetText">' + full_text + '</p>' + 
                    image +  
                '</div>';
            }

        }
    });
}

function SizeTwitterImage(image){
    if(image.style.height != "auto"){
        image.style.height = "auto";
    }else{
        image.style.height = "250px";
    }
}

getTweets();