

<?php include "konten.php" ?>



<br><br>    
<div class="container">
    <h1> Populer </h1>
</div>
<br><br>
<div class="row">
    <?php
    include 'config/database.php';

    // Logika Pencarian
   
        $sql="select * from artikel where status=1 order by RAND() limit 4";
        // $sql = "SELECT * FROM artikel WHERE status=1 ORDER BY id_artikel DESC";
    
    $hasil = mysqli_query($kon, $sql);
    $jumlah = mysqli_num_rows($hasil);
    if ($jumlah > 0) {
        while ($data = mysqli_fetch_array($hasil)):
    ?>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <a href="index.php?halaman=artikel&id=<?php echo $data['id_artikel']; ?>">
                        <img src="admin/artikel/gambar/<?php echo $data['gambar']; ?>" width="250px" height="200px" alt="Cinque Terre">
                    </a>
                    <div class="caption">
                        <h3><?php echo $data['judul_artikel']; ?></h3>
                        
                    </div>
                </div>
            </div>
    <?php
        endwhile;
    } else {
        echo "<div class='alert alert-warning'> Tidak ada artikel pada kategori ini.</div>";
    }
    ?>
</div>
//<//div class="container">
<//?//php //include "galeri.php" ?>
<//div//>

