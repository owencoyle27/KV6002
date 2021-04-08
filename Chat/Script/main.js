$(document).ready(function(){





    data = 5;

  $.ajax({
                              type:'POST',
                              url:"ajax/showposts.php",
                              data: {sdata:data},
                              success: function (response) {
                              if(response ==  0){
                              $("#postdisplayer").html('<div style="width:100%;min-height:40vh;display:flex;color:#000;"><h1 style="margin:auto">No Record Found...</h1>');
                                

                              }
                              else{
                              $("#postdisplayer").html(response);


                              }
                              }

                              });


 $(document).on("click","#randomseemore", function () {


data = data + 5;
  $.ajax({
                              type:'POST',
                              url:"ajax/showposts.php",
                              data: {sdata:data},
                              success: function (response) {
                              if(response ==  0){
                              $("#postdisplayer").html('<div style="width:100%;min-height:40vh;display:flex;color:#000;"><h1 style="margin:auto">No Record Found...</h1>');
                                

                              }
                              else{
                              $("#postdisplayer").html(response);


                              }
                              }

                              });







});




 $(document).on("click","#seemore", function () {

      data = data + 5;


                              title =  $("#title").val();
                              cat =  $("#category").val();



                              $.ajax({
                              type:'POST',
                              url:"ajax/show_search_projects.php",
                              data: {title:title,cat:cat,sdata:data},
                              success: function (response) {
                              if(response ==  0){
                              $("#postdisplayer").html('<div style="width:100%;min-height:40vh;display:flex;color:#000;"><h1 style="margin:auto">No Record Found...</h1>');
                                

                              }
                              else{
                              $("#postdisplayer").html(response);


                              }
                              }

                              });

    });

    $('form').on('submit', function (e) {

      data = 5;

                              title =  $("#title").val();
                              cat =  $("#category").val();



                              e.preventDefault();


                              $.ajax({
                              type:'POST',
                              url:"ajax/show_search_projects.php",
                              data: {title:title,cat:cat,sdata:data},
                              success: function (response) {
                              if(response ==  0){
                              $("#postdisplayer").html('<div style="width:100%;min-height:40vh;display:flex;color:#000;"><h1 style="margin:auto">No Record Found...</h1>');
                                

                              }
                              else{
                              $("#postdisplayer").html(response);


                              }
                              }

                              });


            });




});