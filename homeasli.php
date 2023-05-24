<!-- Form Pencarian -->
<form method="GET" action="index.php">
    <div class="form-group">
        <input type="text" name="search" class="form-control" placeholder="Cari artikel...">
    </div>
    <button type="submit" class="btn btn-primary">Cari</button>
</form>

<div class="row">
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
            <div class="col-sm-3">
                <div class="thumbnail">
                    <a href="index.php?halaman=artikel&id=<?php echo $data['id_artikel']; ?>">
                        <img src="admin/artikel/gambar/<?php echo $data['gambar']; ?>" width="100%" alt="Cinque Terre">
                    </a>
                    <div class="caption">
                        <h3><?php echo $data['judul_artikel']; ?></h3>
                        <p>
                            <?php
                            $ambil = $data["isi_artikel"];
                            $panjang = strip_tags(html_entity_decode($ambil, ENT_QUOTES, "ISO-8859-1"));
                            echo substr($panjang, 0, 200);
                            ?>
                        </p>
                        <p>
                            <a href="index.php?halaman=artikel&id=<?php echo $data['id_artikel']; ?>" class="btn btn-light btn-block" role="button">Selengkapnya</a>
                        </p>
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
