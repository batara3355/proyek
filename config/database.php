<?php
    $host="localhost";
    $user="root";
    $password="";
    $db="proyek";
    
    $kon = mysqli_connect($host,$user,$password,$db);
    if (!$kon){
          die("Koneksi gagal:".mysqli_connect_error());
    }
?>