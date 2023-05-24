<!DOCTYPE html>
<html>
<head>
<style>
    * {
        box-sizing: border-box;
    }

    /* Slideshow container */
    .slideshow-container {
        max-width: 600px;
        position: relative;
        margin: auto;
        
    }

    /* Hide the images by default */
    .mySlides {
        display: none;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -22px;
        padding: 16px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* Caption text */
    .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 60%;
        text-align: center;
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* The dots/bullets/indicators */
    .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active,
    .dot:hover {
        background-color: #717171;
    }

    /* Fading animation */
    .fade {
        animation-name: fade;
        animation-duration: 1.5s;
    }

    @keyframes fade {
        from {
            opacity: 0.4;
        }
        to {
            opacity: 1;
        }
    }
    body{
        background: #717171;
    }
    .container{
        background: #FFFFFF;
    }
</style>

</head>
<body>
    <br><br>
    <div class="container"><h2 style="text-align: center;">Wisata Terbaik</h2></div>
    <br><br>
    <!-- Slideshow container -->
    <div class="slideshow-container">

    <?php
    // Konfigurasi database
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "dinamis1";

    // Membuat koneksi ke database
    $kon = new mysqli($host, $username, $password, $database);

    // Memeriksa koneksi
    if ($kon->connect_error) {
        die('Koneksi database gagal: ' . $kon->connect_error);
    }

    // Menjalankan query untuk mengambil data
    $query = "select * from artikel where status=1 order by id_artikel desc";
    $result = $kon->query($query);

    // Memeriksa apakah query berhasil dieksekusi
    if ($result && $result->num_rows > 0) {
        // Loop through the result set to create slideshow slides
        $slideCount = $result->num_rows;
        $slideNumber = 1;

        while ($row = $result->fetch_assoc()) {
            $image = $row['gambar'];
            $judul = $row['judul_artikel'];

            echo '<div class="mySlides">';
            echo '<img src="admin/artikel/gambar/'. $image . '" alt="Slide ' . $slideNumber . '" style="width:600px; height:500px;" >';
            echo '<div class="text">' . $judul . '</div>';
            echo '</div>';

            $slideNumber++;
        }
    } else {
        echo "Tidak ada data yang ditemukan.";
    }

    // Menutup koneksi
    $kon->close();
    ?>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>

    <!-- The dots/circles -->
    <div style="text-align:center">
    <?php
    // Loop through the slides to create slideshow dots
    for ($i = 1; $i <= $slideCount; $i++) {
        echo '<span class="dot" onclick="currentSlide(' . $i . ')"></span>';
    }
    ?>
    </div>

    <!-- Script for slideshow functionality -->
    <script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1;
        }
        if (n < 1) {
            slideIndex = slides.length;
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
    </script>
</body>
</html>
