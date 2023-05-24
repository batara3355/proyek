<!DOCTYPE html>
<html>
<head>
    
    <style>
        #map {
            width: auto;
            height: 100%;
            margin: 20px;
        }
 
        /* Optional: Makes the sample page fill the window. */
        
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
        // infoWindow ini digunakan untuk menampilkan pop-up diatas marker terkait lokasi markernya
        infoWindow = new google.maps.InfoWindow;
        //  Variabel berisi properti tipe peta yang bisa diubah-ubah
        mapOptions = {
            mapTypeId: google.maps.MapTypeId.ROADMAP
        } 
        // Deklarasi untuk melakukan load map Google Maps API
        map = new google.maps.Map(document.getElementById('map'), mapOptions);      
        // Variabel untuk menyimpan batas kordinat
        bounds = new google.maps.LatLngBounds();
        // Pengambilan data dari database MySQL
        <?php
            // Sesuaikan dengan database yang sudah Anda buat diawal
            $host     = "localhost";
            $username = "root";
            $password = "";
            $Dbname   = "db_rnd";
            $db       = new mysqli($host,$username,$password,$Dbname);
            
            $query = $db->query("SELECT * FROM latlng_kota_kab ORDER BY kota_kab ASC");
            while ($row = $query->fetch_assoc()) {
                $nama = $row["kota_kab"];
                $lat  = $row["latitude"];
                $long = $row["longitude"];
                echo "addMarker($lat, $long, '$nama');\n";
            }
        ?>
        // Proses membuat marker 
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
        // Proses ini dapat menampilkan informasi lokasi Kota/Kab ketika diklik dari masing-masing markernya
        function bindInfoWindow(marker, map, infoWindow, html){
            google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
          });
        }
    }
</script>
</body>
</html>