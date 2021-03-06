<html>
<head>
<title>Google Maps API v3 : Reverse Geocoding</title>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6G-FrvMUhIV-UMRbSN9RkxYGRf4SO_Wg&callback=myMap"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">

var geocoder;
var map;
var infowindow = new google.maps.InfoWindow();
var marker;

var starttime = <?php echo json_encode($_POST["Timestamp"]); ?>;


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
        var lattitude;
        var longitude;
        var index;
        var found=0;

        
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
                console.log(timeStamp);
                console.log(starttime);

   for(var i=0;i<timeStamp.length;i++)
{
   
	if(starttime==timeStamp[i])
	{

		lattitude=lat[i];
		longitude=lon[i];
		found=1;
	}
	
}
if (found==0)
	{
		alert("WE ARE SO SORRY TO LET YOU KNOW THAT THE DATA YOU ENTERED DOSENT EXISTS IN OUR RECORDS");
			}

console.log(index);
console.log(lattitude);
console.log(longitude);
    });






function initialize()
{
    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById("map"),
    {
        zoom: 8,
        center: new google.maps.LatLng(lattitude,longitude),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
}

function codeLatLng()
{
    var input = document.getElementById("latlng").value;
    var latlngStr = input.split(",",2);
    var lat = parseFloat(latlngStr[0]);
    var lng = parseFloat(latlngStr[1]);
    var latlng = new google.maps.LatLng(lattitude, longitude);
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
</script>
</head>
<body onload="initialize()">
<div align="center" style="height: 30px; width: 430px background-color:#4CAF50";>
<input id="latlng" type="text" value="lattitude,longitude">
<input type="button" value="GET LOCATION INFORMATION" onclick="codeLatLng()">
</div>
<div id="map" style="height: 600px; width: 1200px"></div>
<form method="post" action="googlemapphpwithoutcalender.php">
<input type="submit" name="submit" value="GO BACK AND TRY ANOTHER ">


</form>
</body>
</html>