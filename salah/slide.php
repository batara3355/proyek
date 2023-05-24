<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/slide.css">
    <script src="bootstrap/js/slide.js"></script>
</head>
<body>
    
<div class="slideshow-container">


<?php
    include 'config/database.php';

    // Logika Pencarian
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    if ($search != '') {
        $sql = "SELECT * FROM artikel WHERE status=1 AND judul_artikel LIKE '%$search%' ORDER BY id_artikel DESC";
    }elseif(isset($_GET['kategori'])){
        $sql="select * from artikel where status=1 and id_kategori=".$_GET['kategori']." order by id_artikel desc";
    }
    else {
        $sql="select * from artikel where status=1 order by id_artikel desc";
        // $sql = "SELECT * FROM artikel WHERE status=1 ORDER BY id_artikel DESC";
    }

    $hasil = mysqli_query($kon, $sql);
    $jumlah = mysqli_num_rows($hasil);
    if ($jumlah > 0) {
        while ($data = mysqli_fetch_array($hasil)):
    ?>




<!-- Full-width images with number and caption text -->
<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
    <img src="admin/artikel/gambar/<?php echo $data['gambar']; ?>" width="100%" alt="Cinque Terre">
  <div class="text"><?php echo $data['judul_artikel']; ?></div>
</div>

<!-- <div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="img2.jpg" style="width:100%">
  <div class="text">Caption Two</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="img3.jpg" style="width:100%">
  <div class="text">Caption Three</div>
</div> -->

<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
<?php
        endwhile;
    } else {
        echo "<div class='alert alert-warning'> Tidak ada artikel pada kategori ini.</div>";
    }
    ?>




</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
<span class="dot" onclick="currentSlide(<?php echo $data['id_artikel + 1']; ?>)"></span>
</div>
</body>
</html>