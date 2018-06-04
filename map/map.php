<?php
$servername = "localhost";
$username = "root";
$password = "ivanov1997";
$dbname = "map";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT Lat,Lng,cityName FROM weather";

$result = $conn->query($sql);
$array = array();
while($row = $result->fetch_assoc())
{
	$array[]=$row;
}
?>
<!DOCTYPE html>
<html>
<head>
	<style>
		#map{
			width: 100%;
			height: 400px;
			background: grey;
		}
	</style>
</head>
<body>
<div id="map"></div>
<script>
	var arr = <?php echo json_encode($array); ?>;
function initMap(){
	var sofia = new google.maps.LatLng(42.69751,23.32415);
	var mapOptions= {
		center:sofia,
    	zoom:9,
	};
	var map = new google.maps.Map(document.getElementById('map'),mapOptions);
	var i;
	for(i = 0; i < arr.length; i++)
	{
		var pos = new google.maps.LatLng(arr[i]['Lat'],arr[i]['Lng']);
		var marker = new google.maps.Marker({position: pos, map: map, title: arr[i]['cityName']});
	}
}
</script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALen_TGF0I74peT6EI2ZhoYTrHjeGnrUc&callback=initMap">	
</script>
</body>
</html>
