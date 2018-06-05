	<?php

	$connect = mysqli_connect("localhost","root","*********","map");

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
	$records_not_inserted = 0;
	foreach ($data->list as $row) {

		$check_if_exist = "SELECT * FROM weather WHERE Lat=".$row->coord->Lat." AND Lng=".$row->coord->Lon ." AND DT=" . $row->dt;

		$result=mysqli_query($connect,$check_if_exist);


		if($result->num_rows == 0)
		{
			$rain = "NULL";
			$snow = "NULL";
			if(!empty($row->rain))
			{
				if($row->rain->{'3h'} != NULL)
					$rain = $row->rain->{'3h'};
			}

			if(!empty($row->snow))
			{
				if($row->snow->{'3h'} != NULL)
					$snow = $row->snow->{'3h'};
			}
			$query = "INSERT INTO weather VALUES(" . $row->id . "," . $row->dt . "," . $row->coord->Lat . "," . $row->coord->Lon . ",'" . $row->name . "'," . $row->main->temp_max . "," . $row->main->temp_min . "," . $row->main->temp . "," . $row->main->pressure . "," . $row->wind->speed . "," . $row->wind->deg . "," . $rain . "," . $snow .",'" . $row->weather[0]->main . "','" . $row->weather[0]->description . "'," . $row->main->humidity . "," . $row->clouds->today . ")";

			if(!mysqli_query($connect,$query))
			{
				echo "Query not inserted" . $query . "<br>";
			} 
		}
		else
		{
			$records_not_inserted++;
		}
	}

	echo $records_not_inserted . " records were not inserted because they already exist in the database! <br>";

	mysqli_close($connect);
//
	exit(0);
	?>
