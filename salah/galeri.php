<!DOCTYPE html>
<html lang="en">
<head>
    <!-- SITE TITLE -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Bagian Tenagah</title>

    <!-- Plugins css Style -->
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/plugins/owl-carousel/owl.carousel.min.css" rel="stylesheet" media="screen">
    <link href="assets/css/star.css" id="option_style" rel="stylesheet">
</head>
<body id="body" class="up-scroll" data-spy="scroll" data-target=".element-right-sidebar">
    <div class="py-10">
    
    <div class="container">
    <?php
    include 'config/database.php';

    // Logika Pencarian
    
        $sql="select * from artikel where status=1 order by id_artikel desc";
        // $sql = "SELECT * FROM artikel WHERE status=1 ORDER BY id_artikel DESC";
   

    $hasil = mysqli_query($kon, $sql);
    $jumlah = mysqli_num_rows($hasil);
    if ($jumlah > 0) {
        while ($data = mysqli_fetch_array($hasil)):
    ?>
        <div id="package-slider" class="owl-carousel owl-theme package-slider package-single">
            <div class="item">
                <img src="admin/artikel/gambar/<?php echo $data['gambar']; ?>"  alt="image">
            </div>
        </div>
        <?php
        endwhile;
    } else {
        echo "<div class='alert alert-warning'> Tidak ada artikel pada kategori ini.</div>";
    }
    ?>
    </div>
    </div>

    <!-- JavaScript -->
    <script src="assets/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="assets/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/plugins/menuzord/js/menuzord.js"></script>
    <script src="assets/js/star.js"></script>
</body>
</html>
