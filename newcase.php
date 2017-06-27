<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    
  <script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>

          <style>
          div.relative {
    position: absolute;
    right: 20px;
    width: 208px;
    height: 800px;
    
    background-color: blue;
}
</style>

</head> 


<div class="relative">

<form method="post" action="selectsome.php">
  <br>
      <br>


Enter the Starttime:
     <input type="date" id="myDate" name="fromtime" value="2014-02-09" id="starttime">

     <button onclick="myFunction()">Try it</button>
      
      <br>
      <br>
      Enter the Endtime:
      <input type="date" id="myDate" name="totime" value="2014-02-09" id="endtime">

      <button onclick="myFunction()">Try it</button>

      <p id="demo"></p>

<script>
function myFunction() {
    var x = document.getElementById("myDate").value;
    document.getElementById("demo").innerHTML = x;
}
</script> 

      <br>
      <br>
      <input type="submit" name="submit" value="PLOT ">
      
</form>
</div>






  <div id="map" style="width: 1200px; height: 800px;"></div>

  <script type="text/javascript">

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
                    
                }
function initialize()
{
    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById("map"),
    {
        zoom: 8,
        center: new google.maps.LatLng(22.7964,79.5410),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
}

function codeLatLng()
{
    var input = document.getElementById("latlng").value;
    var latlngStr = input.split(",",2);
    var lat = parseFloat(latlngStr[0]);
    var lng = parseFloat(latlngStr[1]);
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status)
    {
        if (status == google.maps.GeocoderStatus.OK)
        {
            if (results[0])
            {
                map.setZoom(11);
                marker = new google.maps.Marker(
                {
                    position: latlng,
                    map: map
                });
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
            }
            else
            {
                alert("No results found");
            }
        }
        else
        {
            alert("Geocoder failed due to: " + status);
        }
    });
}
                
    
 });
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6G-FrvMUhIV-UMRbSN9RkxYGRf4SO_Wg&callback=myMap"></script>
<body onload="initialize()">
<div align="center" style="height: 30px; width: 430px">
<input id="latlng" type="text" value="27.1900,78.0100">
<input type="button" value="Reverse Geocode" onclick="codeLatLng()">
</div>
<div id="map" style="height: 200px; width: 430px"></div>
</body>
</html>