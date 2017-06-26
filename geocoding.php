<html>
<head>
<title>Google Maps API v3 : Reverse Geocoding</title>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6G-FrvMUhIV-UMRbSN9RkxYGRf4SO_Wg&callback=myMap"></script>
<script type="text/javascript" src="googlemap.php"/></script>
<script type="text/javascript">

var geocoder;
var map;
var infowindow = new google.maps.InfoWindow();
var marker;
var starttime = <?php echo json_encode($_POST["Timestamp"]); ?>;
var lattitude = <?php echo json_encode($_POST["Lattituderecovered"]); ?>;
var longitude = <?php echo json_encode($_POST["longituderecovered"]); ?>;
console.log(starttime);
console.log(lat);

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
</script>
</head>
<body onload="initialize()">
<div align="center" style="height: 30px; width: 430px">
<input id="latlng" type="text" value="27.1900,78.0100">
<input type="button" value="Reverse Geocode" onclick="codeLatLng()">
</div>
<div id="map" style="height: 200px; width: 430px"></div>
</body>
</html>