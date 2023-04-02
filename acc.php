<?php  
require 'koneksi.php';

$id = $_GET['id'];

if (!$id) {
    header('location: logout.php');
}

$query = mysqli_query($conn, "UPDATE transaksi SET status = 'acc' where idtransaksi = '$id'");

if (mysqli_affected_rows($conn) > 0) {
    echo "
        <script>
            alert('transaksi acc')
            document.location.href = 'orders.php'
        </script>
    ";
}
?>