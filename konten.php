<bodywww>
<div class="container">
    <h2>TERBARU</h2>
</div>

<div class="container">
    <div class="row">
        <?php
        include 'config/database.php';

        // Check if search query is provided
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Modify the SQL query to include the search condition
        if ($search != '') {
            $sql = "SELECT * FROM artikel WHERE status=1 AND judul_artikel LIKE '%$search%' ORDER BY id_artikel DESC";
        } elseif (isset($_GET['kategori'])) {
            $sql = "SELECT * FROM artikel WHERE status=1 AND id_kategori=" . $_GET['kategori'] . " ORDER BY id_artikel DESC";
        } else {
            $sql = "SELECT * FROM artikel WHERE status=1 ORDER BY id_artikel DESC";
        } 
        $hasil = mysqli_query($kon, $sql);

        $resultCount = 0; // Counter variable

        while ($data = mysqli_fetch_array($hasil)):
            if ($resultCount < 5) { // Change '5' to the desired number of results
                $resultCount++;
        ?>
                <div class="col-sm-12">
                    <br>
                    <div class="caption">
                        <h3><a class="text-dark" href="index.php?halaman=artikel&id=<?php echo $data['id_artikel']; ?>"><?php echo $data['judul_artikel']; ?></a></h3>
                        <div class="row">
                            <div class="col-xl-3">
                                <img src="admin/artikel/gambar/<?php echo $data['gambar']; ?>" width="100%" height="200px" alt="Cinque Terre">
                            </div>
                            <div class="col-sm-9">
                                <?php
                                $ambil = $data["isi_artikel"];
                                $panjang = strip_tags(html_entity_decode($ambil, ENT_QUOTES, "ISO-8859-1"));

                                echo substr($panjang, 0, 500);
                                ?>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
        <?php
            } else {
                break; // Stop the loop if the desired number of results is reached
            }
        endwhile;
        ?>
    </div>
</div>
</body>
