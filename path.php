
<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js"></script>
    
  <script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>

<style>
   
html,
body,
#map {
  height: 100%;
  width: 100%;
  margin: 0px;
  padding: 0px
}

</style>
</head> 

<body>

  <div id="map" style="width: 1200px; height: 700px;"></div>

  <script type="text/javascript">
  var geocoder;
  var map;
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  var locations = [
    ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
    ['Bondi Beach', -33.890542, 151.274856, 4],
    ['Coogee Beach', -33.923036, 151.259052, 5],
    ['Maroubra Beach', -33.950198, 151.259302, 1],
    ['Cronulla Beach', -34.028249, 151.157507, 3]
  ];

  function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();


    var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: new google.maps.LatLng(-33.92, 151.25),
    mapTypeId: google.maps.MapTypeId.ROADMAP
    });

   directionsDisplay.setMap(map);
  var infowindow = new google.maps.InfoWindow();

  var marker, i;
  var request = {
    travelMode: google.maps.TravelMode.DRIVING
  };
  for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      map: map
    });

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
      }
    })(marker, i));

	if (i == 0) 
        {
    		request.origin = marker.getPosition();

    	}
    else if (i == locations.length - 1) 
    	{
    		request.destination = marker.getPosition();
    		console.log(i);
    	}
    else {
      if (!request.waypoints) 
      {
      	request.waypoints = [];

        request.waypoints.push({
        location: marker.getPosition(),
        stopover: true

      });
    }
}

  }

  directionsService.route(request, function(result, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(result);
    }
  });
}
google.maps.event.addDomListener(window, "load", initialize);

</script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6G-FrvMUhIV-UMRbSN9RkxYGRf4SO_Wg&callback=myMap"></script>
  <form method="post" action="googlemapphpwithoutcalender.php">
<input type="submit" name="submit" value="GO BACK AND TRY ANOTHER ">


</form>
</body>
</html>
