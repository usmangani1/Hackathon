<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    
  <script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>
</head> 
<body>


  <div id="map" style="width: 1440px; height: 800px;"></div>

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

                
                console.log(lat);
                console.log(lon); 
           
for(var i=0; i<ts.length; i++){

                    timeStamp.push(new Date(ts[i]*1000/1000));
                }
                
    console.log(timeStamp);
   
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 9,
      center: new google.maps.LatLng(12.5663704, 78.7037729),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < lat.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat[i], lon[i]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(activity_type[i]);
          infowindow.setContent(accur[i]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    
     
     var line = new google.maps.Polyline({
    path: [new google.maps.LatLng(lat[i], lon[i]), new google.maps.LatLng(lat[i+1],lon[i+1])],
    strokeColor: "#FF0000",
    strokeOpacity: 1.0,
    strokeWeight: 10,
    geodesic: true,
    map: map
});
 }
 });
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6G-FrvMUhIV-UMRbSN9RkxYGRf4SO_Wg&callback=myMap"></script>
</body>
</html>