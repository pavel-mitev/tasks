<?php

	$connect = mysqli_connect("localhost","root","ivanov1997","map");

	if(!$connect)
	{
		echo "Connection to DB not successfull";
		exit(5);
	}

	$lon_left = -150;
	$lat_bottom = -80;
	$lon_right = 150;
	$lat_top = 80;
	
	$filepath = "http://api.openweathermap.org/data/2.5/box/city?bbox=".$lon_left.",".$lat_bottom.",".$lon_right.",".$lat_top.",10&APPID=791de61b7250afeadfe72f125d6d04bf";
	$json = file_get_contents($filepath);
	$data = json_decode($json);

	foreach ($data->list as $row) {

		$query = "INSERT INTO coords(Lat,Lng,name) VALUES(" . $row->coord->Lat . "," . $row->coord->Lon . ",'" . $row->name ."');";

		if(!mysqli_query($connect,$query))
		{
			echo "Error executing: " . $query . "<br>";
		} 
	}

	mysqli_close($connect);

	exit(0);
	?>
