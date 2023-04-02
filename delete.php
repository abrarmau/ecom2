<?php 
require 'koneksi.php';

$id = $_GET['idproduk'];

if (!$id) {
    header('location: logout.php');
}

$query = mysqli_query($conn, "DELETE FROM produk where idproduk = '$id'");

if (mysqli_affected_rows($conn)) {
    echo"
        <script>
            alert('produk berhasil dihapus')
            document.location.href = 'indexadm.php'
        </script>
    ";
} else {
    echo "
        <script>
            alert('Produk gaga dihapus')
        </script>
    ";
}

?>