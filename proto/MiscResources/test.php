<?php
function echoMap($AddressOriginal){  
  $Address = urlencode($AddressOriginal);
  $request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$Address."&sensor=true";
  $xml = simplexml_load_file($request_url) or die("url not loading");
  $status = $xml->status;
  if ($status=="OK") {
      $Lat = $xml->result->geometry->location->lat;
      $Lon = $xml->result->geometry->location->lng;
      $LatLng = "$Lat,$Lon";
  }


echo <<<EOL
<div id="map" style="width:500px;height:500px;margin:auto;"></div>

<script>
function myMap() {
  var mapCanvas = document.getElementById("map");
  var myCenter = new google.maps.LatLng(
EOL;

    echo $LatLng;
        
        echo <<<EOL
);
  var mapOptions = {center: myCenter, zoom: 15};
  var map = new google.maps.Map(mapCanvas,mapOptions);
  var marker = new google.maps.Marker({position: myCenter});
  marker.setMap(map);
}

  var infowindow = new google.maps.InfoWindow({
    content: "
EOL;
    
    echo $AddressOriginal;
    
    echo <<<EOL
"
  });
  infowindow.open(map,marker);
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ9Cvf5punc60HM2DoyPlI69E1fnPqIgc&callback=myMap"></script>
EOL;
}

echoMap("82 Hawkins Road, Stockleigh");









?>