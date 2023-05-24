<!DOCTYPE html>
<html lang="en">
<head>
    <title>Wisata Toba</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/style.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
/* 
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a, .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

li.dropdown {
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
  display: block;
}
 */

</style>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <?php
        include 'config/database.php';
        $ambil_kategori = mysqli_query($kon, "SELECT * FROM profil LIMIT 1");
        $row = mysqli_fetch_assoc($ambil_kategori); 
        $nama_website = $row['nama_website'];
    ?>
    <a class="navbar-brand" href="index.php?halaman=home"><?php echo $nama_website; ?></a>

    <!-- Toggler/collapsible Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <?php
            $sql = "SELECT * FROM kategori";
            $hasil = mysqli_query($kon, $sql);
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Kabupaten
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php while ($data = mysqli_fetch_array($hasil)): ?>
                    <a class="dropdown-item" href="index.php?halaman=home&kategori=<?php echo $data['id_kategori']; ?>">
                        <?php echo $data['nama_kategori']; ?>
                    </a>
                    <?php endwhile; ?>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php 
                session_start();
                if (isset($_SESSION["id_pengguna"])) {
                    echo "<li><a class='nav-link' href='admin/index.php?halaman=kategori'>Halaman Admin</a></li>";
                } else {
                    echo "<li><a class='nav-link' href='index.php?halaman=login'><span class='fas fa-log-in'></span> Login</a></li>";
                }
            ?>
        </ul>
    </div>
</nav>

<div class="intro">

<?php
    $judul="Wisata Toba";   
    include 'config/database.php';
    if (isset($_GET['id'])) {
        $sql="select * from artikel where status=1 and id_artikel=".$_GET['id']."";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_array($hasil);
        $judul=$data['judul_artikel'];  
    }else if (isset($_GET['kategori'])){
        $sql="select * from kategori where id_kategori=".$_GET['kategori']."";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_array($hasil);
        $judul=$data['nama_kategori'];  
    }

    

?>
    <h1><?php echo $judul;?></h1>

</div>
<div class="container">
<form method="GET" action="index.php">
    <div class="form-group">
        <input type="text" name="search" class="form-control" placeholder="Cari artikel...">
    </div>
    <button type="submit" class="btn btn-primary">Cari</button>
</form>
</div>


<div class="container">
<?php 
    if(isset($_GET['halaman'])){
        $halaman = $_GET['halaman'];
        switch ($halaman) {
            case 'home':
                include "home.php";
                break;
            case 'artikel':
                include "artikel.php";
                break;
            case 'login':
                include "login.php";
                break;
            default:
            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
            break;
        }
    }else {
        include "home.php";
    }
?>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
    <p>Copyright <?php echo $nama_website;?> 2022</p>
</div>
<div>
</div>
</body>
</html>