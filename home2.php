<?php 
include 'config/database.php';
?>
<form action="index.php" method="get">
	<label>Cari :</label>
	<input type="text" name="cari">
	<input type="submit" value="Cari">
</form>
 
<?php 
if(isset($_GET['cari'])){
	$cari = $_GET['cari'];
	echo "<b>Hasil pencarian : ".$cari."</b>";
}
?>
<div class="row">
<?php
            if(isset($_GET['cari'])){
        $cari = $_GET['cari'];
        $sql="select * from artikel where nama_kategori like '%".$cari."%'";
    }else { 
        $sql="select * from artikel where status=1 order by id_artikel desc";
    }
    $no = 1;
    while ($data = mysqli_fetch_array($hasil)){
    $hasil=mysqli_query($kon,$sql);
    $jumlah = mysqli_num_rows($hasil);
    if ($jumlah>0){
        while ($data = mysqli_fetch_array($hasil)):
    ?>
        <div class="col-sm-3">
            <div class="thumbnail">
                <a href="index.php?halaman=artikel&id=<?php echo $data['id_artikel'];?>"><img src="admin/artikel/gambar/<?php echo $data['gambar'];?>" width="100%" alt="Cinque Terre"></a>
                <div class="caption">
                    <h3><?php echo $data['judul_artikel'];?></h3>
                    <p>
                    <?php 
                    $ambil=$data["isi_artikel"];
                    $panjang = strip_tags(html_entity_decode($ambil,ENT_QUOTES,"ISO-8859-1"));
                    echo substr($panjang, 0, 200);?>
                    </p>
                    <p><a href="index.php?halaman=artikel&id=<?php echo $data['id_artikel'];?>" class="btn btn-light btn-block" role="button">Selengkapnya</a></p>
                </div>
            </div>
        </div>
        <?php 
        endwhile;
    }else {
        echo "<div class='alert alert-warning'> Tidak ada artikel pada kategori ini.</div>";
    };
     ?>
     <?php } ?>
</div>
<div class="achievements">
      <div class="work">
        <i class="fas fa-atom"></i>
        <p class="work-heading">Projects</p>
        <p class="work-text">I have worked on many projects and I am very proud of them. I am a very good developer and I am always looking for new projects.</p>
      </div>
      <div class="work">
        <i class="fas fa-skiing"></i>
        <p class="work-heading">Skills</p>
        <p class="work-text">I have a lot of skills and I am very good at them. I am very good at programming and I am always looking for new skills.</p>
      </div>
      <div class="work">
        <i class="fas fa-ethernet"></i>
        <p class="work-heading">Network</p>
        <p class="work-text">I have a lot of network skills and I am very good at them. I am very good at networking and I am always looking for new network skills.</p>
      </div>
    </div>