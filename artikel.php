
                <?php include "map.php" ?>
           
<?php
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    include 'config/database.php';
    $id_artikel=input($_GET['id']);
    $query = mysqli_query ($kon,"select * from artikel a inner join kategori k on k.id_kategori=a.id_kategori where id_artikel='".$id_artikel."' limit 1");
    $data = mysqli_fetch_assoc($query); 
?>
<div class="row">
    <div class="col-sm-8">
        <div class="thumbnail">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=home&kategori=<?php echo $data['id_kategori']; ?>"><?php echo $data["nama_kategori"];?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $data["judul_artikel"];?></li>
                </ol>
            </nav>
            <img src="admin/artikel/gambar/<?php echo $data['gambar'];?>" width="100%" height="500px" alt="Cinque Terre">
            <br><br>
            <div class="caption">
                <?php
                echo strip_tags(html_entity_decode($data["isi_artikel"],ENT_QUOTES,"ISO-8859-1"));
                 ?>
                <hr>
            </div>
            
                     
            <?php
                  if (isset($_GET['komentar'])) {
                    //Mengecek nilai variabel add yang telah di enskripsi dengan method md5()
                    if ($_GET['komentar']=='berhasil'){
                        echo"<div class='alert alert-success'>Komentar telah terkirim, menunggu persetujuan dari admin</div>";
                    }else {
                        echo"<div class='alert alert-danger'>Komentar gagal</div>";
                    }   
                }
            ?>
            <div class="row">
                <?php
                    include 'config/database.php';
                    $sql="select * from komentar where id_artikel=$id_artikel and status_komentar=1 order by id_komentar desc";
                    $hasil=mysqli_query($kon,$sql);
                    while ($komentar = mysqli_fetch_array($hasil)):
                ?>
                <div class="col-sm-12">
                    <div class="caption">
                        <h5><?php echo $komentar['nama'];?></h5>
                        <div class="row">
                            <div class="col-sm-1">
                                <img src="gambar/user.png" width="100%" alt="Cinque Terre">
                            </div>
                            <div class="col-sm-11">
                                <?php echo $komentar['isi_komentar']; ?>
                            </div> 
                        </div>
                        <br><br>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>

            <div class="comment">
                <form method="post" action="simpan-komentar.php">
                    <label><h2>Tinggalkan Komentar</h2></label>
                    <div class="form-group">
                        <input type="hidden" name="id_artikel" value="<?php echo $data['id_artikel'];?>" class="form-control">
                        <input type="hidden" name="status" value="0" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Komentar:</label>
                        <textarea class="form-control" name="komentar" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit"  name="form_komentar" class="btn btn-info" value="Kirim Komentar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
    <form method="GET" action="index.php">
    <div class="form-group">
        <input type="text" name="search" class="form-control" placeholder="Cari artikel...">
    </div>
    <button type="submit" class="btn btn-primary">Cari</button>
</form>
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
                    <div class="caption">
                        <h5><a class="text-dark" href="index.php?halaman=artikel&id=<?php echo $data['id_artikel']; ?>"><?php echo $data['judul_artikel']; ?></a></h5>
                        <div class="row">
                            <div class="col-xl-3">
                                <img src="admin/artikel/gambar/<?php echo $data['gambar']; ?>" width="100%" alt="Cinque Terre">
                            </div>
                            <div class="col-sm-9">
                                <?php
                                $ambil = $data["isi_artikel"];
                                $panjang = strip_tags(html_entity_decode($ambil, ENT_QUOTES, "ISO-8859-1"));

                                echo substr($panjang, 0, 80);
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

        <div class="row">
            <div class="col-sm-12">
                <img src="gambar/iklan.png" width="100%"alt="Cinque Terre">
            </div>
        </div>
    </div>  
</div>