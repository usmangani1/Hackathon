<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6G-FrvMUhIV-UMRbSN9RkxYGRf4SO_Wg&callback=myMap"></script>
<script type="text/javascript">

        var starttime = <?php echo json_encode($_POST["fromtime1"]); ?>;
        var endtime =<?php echo json_encode($_POST["endtime1"]); ?>;


        console.log(starttime);
        console.log(endtime);
        var timeStamp=[];
        var ts=[];
        var lat=[];
        var lon=[];
        var accur=[];

        var date=[];
        var activity_type=[];
        var flag=0;
        var month=[];
        var minutes=[];
        var seconds=[];
        var day=[];
        
        var startlan;
        var startlon;
        var endlat;
        var endlon;


        
        var data;
    
            //JSON INPUT//
            $.getJSON('location.json', function(data) {
                //PARSING JSON INPUT//
                $.each(data, function(idx, obj){ 
                    $.each(obj , function(key , value){ 
                        //if(key == "FORWARD_4D_MODEL"){
                            $.each(value , function(key1 , value1){
                                //$.each(value1 , function(key2 , value2){
                                    if(key1 == "timestampMs"){
                                        ts.push(value1);
                                    }
                                    else if(key1 == "latitudeE7"){
                                        lat.push(value1/10000000);
                                    }
                                    else if(key1 == "longitudeE7"){
                                        lon.push(value1/10000000);
                                    }
                                    else if(key1 == "accuracy"){
                                        accur.push(value1/10000000);
                                    }
                                    if(key1 == "activity"){
                                        flag=1;
                                        activity_type.push(value1[0].activity[0].type);
                                    }
                                    if(flag==0){
                                        activity_type.push("STILL");
                                    }
                                    flag=0;
                                //})
                            })                  
                        //}
                    });
                });

                
                
           
for(var i=0; i<ts.length; i++){

                    timeStamp.push(new Date(ts[i]*1000/1000));
                    date.push(new Date(timeStamp[i]));
                    
                }
                console.log(timeStamp);

for ( var i = 0; i < timeStamp.length; i++) 
{
  
if(starttime==timeStamp[i])
{ 
startlan=lat[i];
startlon=lon[i];
}
if(endtime==timeStamp[i])
{ 
endlat=lat[i];
endlon=lon[i];
}
}
console.log(startlan);
console.log(startlon);
console.log(endlat);
console.log(endlon);
           

           




  var directionDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;

  function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    var myOptions = {
      mapTypeId: google.maps.MapTypeId.ROADMAP,
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    directionsDisplay.setMap(map);

    var start = new google.maps.LatLng(startlan,startlon);
    var end = new google.maps.LatLng(endlat,endlon);
    var request = {
      origin:start, 
      destination:end,
      travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
        var myRoute = response.routes[0];
        
        
      }
    });
  }
  google.maps.event.addDomListener(window, "load", initialize);
   });
</script>
</head>

<div id="map_canvas" style="width:500px;height:500px;"></div>
</body>
</html>