<?php
<?php
$host = "localhost";
$user = "username";
$password = "password";
$db = "proyek";

// Membuat koneksi ke database
$conn = mysqli_connect($host, $user, $password, $dbname);

// Memeriksa koneksi
if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Mengeksekusi query untuk pemanggilan data
$query = "SELECT * FROM table_name";
$result = mysqli_query($conn, $query);

// Memeriksa hasil query
if (!$result) {
    die("Query tidak berhasil: " . mysqli_error($conn));
}

// Mengambil data dari hasil query
while ($row = mysqli_fetch_assoc($result)) {
    // Lakukan sesuatu dengan data yang diambil
    echo $row['column_name'];
}

// Menutup koneksi
mysqli_close($conn);
?>
