<?php
  $test;
  if(!empty($_POST["min_temp"]))
  {
    $test .= " WHERE currTemp > " . $_POST["min_temp"];
    if(!empty($_POST["max_temp"]))
    {
      $test .= " AND currTemp < " . $_POST["max_temp"];
    }
  }
  else if(!empty($_POST["max_temp"]))
  {
    $test .= " WHERE currTemp < " . $_POST["max_temp"];
  }
  else if(!empty($_POST["city"]))
  {
    $test .= " WHERE cityName LIKE '%" . $_POST["city"] . "%'";
  }
  $servername = "localhost";
  $username = "root";
  $password = "ivanov1997";
  $dbname = "map";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT Lat,Lng,cityName FROM weather";

  if(!empty($test))
  {
    $sql .= $test;
  }

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
    <form action="output.php" method="post">
      Minimal temperature: <input type="text" name="min_temp" placeholder="Ex: 25" size="2">
      Maximal temperature: <input type="text" name="max_temp" placeholder="Ex: 25" size="2"><br>
      City name: <input type="text" name ="city" placeholder="Ex: New York" size="7"><br>
      <input type="submit" value="Update Data">
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
