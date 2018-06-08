

<?php
$test;
  if("" != trim($_POST["min_temp"]))
  {
    $test .= " WHERE currTemp >= " . $_POST["min_temp"];
    if("" != trim($_POST["max_temp"]))
    {
      $test .= " AND currTemp <= " . $_POST["max_temp"];
    }

      if("" != trim($_POST["city"]))
      {
        $test .= " AND cityName LIKE '%" . $_POST["city"] . "%'";
      }
  }
  else if("" != trim($_POST["max_temp"]))
  {
    $test .= " WHERE currTemp <= " . $_POST["max_temp"];

    if("" != trim($_POST["city"]))
    {
      $test .= " AND cityName LIKE '%" . $_POST["city"] . "%'";
    }
  }
  else if("" != trim($_POST["city"]))
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
  $allCities = "SELECT cityName FROM weather";

  $allCitiesResult = $conn->query($allCities);
  $all_city = array();
  while($row = $allCitiesResult->fetch_assoc())
  {
    $all_city[] = $row;
  }
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
    * {
      box-sizing: border-box;
    }
    body {
      font: 16px Arial;
    }
    .autocomplete {
      /*the container must be positioned relative:*/
      position: relative;
      display: inline-block;
    }
    input {
      border: 1px solid transparent;
      background-color: #f1f1f1;
      padding: 10px;
      font-size: 16px;
    }
    input[type=text] {
      background-color: #f1f1f1;
      width: 100%;
    }
    input[type=submit] {
      background-color: DodgerBlue;
      color: #fff;
      cursor: pointer;
    }
    .autocomplete-items {
      position: absolute;
      border: 1px solid #d4d4d4;
      border-bottom: none;
      border-top: none;
      z-index: 99;
      /*position the autocomplete items to be the same width as the container:*/
      top: 100%;
      left: 0;
      right: 0;
    }
    .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      background-color: #fff;
      border-bottom: 1px solid #d4d4d4;
    }
    .autocomplete-items div:hover {
      /*when hovering an item:*/
      background-color: #e9e9e9;
    }
    .autocomplete-active {
      /*when navigating through the items using the arrow keys:*/
      background-color: DodgerBlue !important;
      color: #ffffff;
    }
  		#map{
  			width: 100%;
  			height: 400px;
  			background: grey;
  		}
  	</style>
  </head>
  <body>
    <form autocomplete="off" action="autocomplete.php" method="post">
      Minimal temperature: <input type="text" name="min_temp" placeholder="Ex: 25" >
      Maximal temperature: <input type="text" name="max_temp" placeholder="Ex: 25" >
      <div class="autocomplete">
      City: <input id="cityInput" type="text" name="city" placeholder="City">
      </div>
      <input type="submit" value = "Submit">
    </form>
  </script>
    <script>
    function autoComplete(input,array)
    {
      var current;

      input.addEventListener("input", function(elem)
      {
        var inputValue = this.value;
        var a,b;
        var i;

        closeAllLists();

        if(!inputValue)
        {
          return false;
        }

        current = -1;

        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class","autocomplete-items");
        this.parentNode.appendChild(a);
        var count = 0;
        for (var i = 0; i < array.length; i++)
        {
          if(array[i]['cityName'].substr(0, inputValue.length).toUpperCase() == inputValue.toUpperCase())
          {
            count++;
            if(count > 10)
              break;
            b = document.createElement("DIV");
            b.innerHTML = "<strong>" + array[i]['cityName'].substr(0,inputValue.length) + "</strong>";
            b.innerHTML += array[i]['cityName'].substr(inputValue.length);
            b.innerHTML += "<input type='hidden' value='" + array[i]['cityName'] + "'>";
            b.addEventListener("click", function(elem)
            {
                input.value = this.getElementsByTagName("input")[0].value;
                closeAllLists();
            });

            a.appendChild(b);

          }
      }
    });

    input.addEventListener("keydown",function(elem)
    {
      var x = document.getElementById(this.id + "autocomplete-list");
      if(x)
        x = x.getElementsByTagName("div");

      if(elem.keyCode == 40) /* arrow Down key*/
      {
        current++;
        addActive(x);
      }
      else if(elem.keyCode == 38) /* arrow Up key */
      {
        current--;
        addActive(x);
      }
      else if(elem.keyCode == 13) /* Enter*/
      {
        elem.preventDefault();
        if(current > -1)
        {
          if(x)
            x[current].click();
        }
      }
    });

    function addActive(x)
    {
      if(!x)
        return false;
      removeActive(x);

      if(current >= x.length)
        current = 0;
      if(current < 0)
        current = x.length - 1;
      x[current].classList.add("autocomplete-active");
    }
    function removeActive(x)
    {
      for(var i = 0; i < x.length; i++)
      {
        x[i].classList.remove("autocomplete-active");
      }
    }

    function closeAllLists(elem)
    {
      var x = document.getElementsByClassName("autocomplete-items");

      for(var i = 0; i < x.length; i++)
      {
        if(elem != x[i] && elem != input)
        {
          x[i].parentNode.removeChild(x[i]);
        }
      }


    }

    document.addEventListener("click",function(elem)
    {
        closeAllLists(elem.target);
    });

  }
  </script>

  <div id="map"></div>
  <script>
    var cities = <?php echo json_encode($all_city); ?>;
  	var arr = <?php echo json_encode($array); ?>;
    autoComplete(document.getElementById("cityInput"),cities);
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
