<!DOCTYPE html>
<html>
<head>
    <title>Intip Cara Menampilkan Marker Google Maps API Menggunakan PHP dan MySQL | Terralogiq</title>

    <style>
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>

<div id="map"></div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGl5e95hdB_l6vlyar0aNSv8pkK36Ccrg&callback=GMPStart" async defer></script>
<script type="text/javascript">

    let map;
    let infoWindow;
    let mapOptions;
    let bounds;

    function GMPStart(){
        infoWindow = new google.maps.InfoWindow();
        mapOptions = {
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        bounds = new google.maps.LatLngBounds();

        <?php
        $host = "localhost";
        $username = "root";
        $password = "";
        $Dbname = "db_rnd";
        $db = new mysqli($host, $username, $password, $Dbname);

        // Check if search query is provided
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Modify the SQL query to include the search condition
        $query = $db->query("SELECT * FROM latlng_kota_kab WHERE kota_kab LIKE '%$search%' ORDER BY kota_kab ASC");
        while ($row = $query->fetch_assoc()) {
            $nama = $row["kota_kab"];
            $lat = $row["latitude"];
            $long = $row["longitude"];
            echo "addMarker($lat, $long, '$nama');\n";
        }
        ?>

        var location;
        var marker;
        function addMarker(lat, lng, info){
            location = new google.maps.LatLng(lat, lng);
            bounds.extend(location);
            marker = new google.maps.Marker({
                map: map,
                position: location
            });
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
         }

        function bindInfoWindow(marker, map, infoWindow, html){
            google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
          });
        }
    }
</script>

<!-- Add a search form -->
<form method="GET" action="">
    <input type="text" name="search" placeholder="Search by location">
    <button type="submit">Search</button>
</form>

</body>
</html>
