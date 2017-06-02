
myMap(-27.518819, 153.050280, 13, "roadmap", "map" );

 /*
    <summary>
		Function to embed an interactable google map to a container. 
    </summary>
    <param name="latitude">Decimal for the latitude co-ordinate of the center of the map.</param>
	<param name="longitude">Decimal for the longitude co-ordinate of the center of the map.</param>
	<param name="zoomAmt"> Integer for how zoomed in the map is.</param>
	<param name="mapType"> String listing what type of map to embed.</param>
	<param name="containerID"> String listing the id of the container for the map.</param>
*/
function myMap(latitude, longitude, zoomAmt, mapType, containerID) {
    var mapOptions = {
        center: new google.maps.LatLng(latitude, longitude),
        zoom: zoomAmt,
        mapTypeId: google.maps.MapTypeId.roadmap
    }
	var map = new google.maps.Map(document.getElementById(containerID), mapOptions);
}