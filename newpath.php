
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
html, body {
    height: 100%;
    margin: 0px;
    padding: 0px;
    width: 100%;
}
#map-canvas {
    height: 100%;
    width: 100%;
}
#directions-panel {
    width: 100%;
    height: 100%;
    position: relative;
}
table, tbody, tr {
    width: 100%;
    height: 100%;
}
td {
    width: 50%;
    height: 100%;
}
}
</style>

</head> 
<body>

  <div id="map-canvas" style="width: 1200px; height: 700px;"></div>


  <script type="text/javascript">
 function calculate() {
    var request = {
        origin: origin,
        waypoints: waypts,
        destination: destination,
        travelMode: google.maps.TravelMode.DRIVING
    };
    directionsDisplay.setPanel(document.getElementById('directions-panel'));
    directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        }
    });
}

// global variables
var origin = null;
var destination = null;
var waypts = [];
var infowindow = new google.maps.InfoWindow();
var directionsDisplay = new google.maps.DirectionsRenderer();
var directionsService = new google.maps.DirectionsService();
var features_added = 0;

function initialize() {
    // Create a simple map.
    features = [];
    map = new google.maps.Map(document.getElementById('map-canvas'), {
        zoom: 4,
        center: {
            lat: -28,
            lng: 137.883
        }
    });
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById('directions-panel'));
    google.maps.event.addListener(map, 'click', function () {
        infowindow.close();
    });
    // process the loaded GeoJSON data.
    google.maps.event.addListener(map.data, 'addfeature', function (e) {
        if (e.feature.getGeometry().getType() === 'Point') {
features_added++;            map.setCenter(e.feature.getGeometry().get());
            // set the origin to the first point
            if (!origin) origin = e.feature.getGeometry().get();
            // set the destination to the second point
            else waypts.push({
                location: e.feature.getGeometry().get(),
                stopover: true
            });
            setTimeout(function() {features_added--; if (features_added <= 0) google.maps.event.trigger(map, 'data_idle');
                }, 500);
        }
    });
    google.maps.event.addListenerOnce(map, 'data_idle', function () {
        if (!destination) {
            destination = waypts.pop();
            destination = destination.location;
            // calculate the directions once both origin and destination are set 
            calculate();
        }
    });
    map.data.addGeoJson(data);
}

google.maps.event.addDomListener(window, 'load', initialize);
var data = {
    "type": "FeatureCollection",
        "features": [{
        "type": "Feature",
            "geometry": {
            "type": "Point",
                "coordinates": [-73.563032, 45.495403]
        },
            "properties": {
            "prop0": "value0"
        }
    }, {
        "type": "Feature",
            "geometry": {
            "type": "Point",
                "coordinates": [-73.549762, 45.559673]
        },
            "properties": {
            "prop0": "value1"
        }
    }, {
        "type": "Feature",
            "geometry": {
            "type": "Point",
                "coordinates": [-73.9395687, 42.8142432] // Schenectady, NY
        },
            "properties": {
            "prop0": "value2"
        }
    }, {
        "type": "Feature",
            "geometry": {
            "type": "Point",
                "coordinates": [-73.7562317, 42.6525793] // Albany, NY
        },
            "properties": {
            "prop0": "value3"
        }
    }, {
        "type": "Feature",
            "geometry": {
            "type": "Point",
                "coordinates": [-74.005941, 40.712784] // New York, NY
        },
            "properties": {
            "prop0": "value0"
        }
    }, {
        "type": "Feature",
            "geometry": {
            "type": "Point",
                "coordinates": [-74.1723667, 40.735657] // Newark, NJ
        },
            "properties": {
            "prop0": "value0"
        }
    }]
};

</script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6G-FrvMUhIV-UMRbSN9RkxYGRf4SO_Wg&callback=myMap"></script>
  <form method="post" action="googlemapphpwithoutcalender.php">
<input type="submit" name="submit" value="GO BACK AND TRY ANOTHER ">


</form>
</body>
</html>
