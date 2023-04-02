<?php

error_reporting(0);
session_start();
require 'koneksi.php';

$username = $_SESSION['username'];
$sql = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
$level = mysqli_fetch_assoc($sql)['level'];

$produk = mysqli_query($conn, "SELECT * FROM transaksi INNER JOIN produk ON transaksi.produk =  produk.idproduk INNER JOIN user ON transaksi.user = user.username WHERE status NOT LIKE 'K' AND user = '$username'");

if (!$username) {
    echo "
        <script>
            alert('Harap login terlebih dahulu')
            document.location.href = 'login.php'
        </script>
    ";
}

if ($level == 'admin') {
    header('location: admin.php');
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $namalengkap = mysqli_fetch_assoc($query)['namalengkap'];
} else {
    $username = null;
    $namalengkap = null;
}

if (isset($_POST['checkout'])) {
    if (checkout($_POST) > 0) {
        echo "
            <script>
                alert('transaksi berhasil')
                document.location.href = 'index.php'
            </script>
        ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        nav{
            background-color: darkslategrey;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 27px 10px;
        }

        li, ul, a{
            text-decoration: none;
            display: inline-block;
            color: white;
            font-size: 25px;
            padding: 0px 8px;
            font-family: sans-serif;
        }
        h1{
            color: white;
            padding: 0px 8px;
        }

        table{
            margin: 75px;
            width: 800px;
            text-align: center;
        }

        td{
            padding: 20px;
        }
        button{
            width: 65px;
            height: 30px;
        }
    </style>
</head>

<body>

   
    <nav>
        <div>
            <a href="">SOPI</a>
        </div>
        <div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="title" align="center">
        <table border="3">
            <thead>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Stok Produk</th>
                <th>Keterangan</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($produk as $row) {
                ?>
                    <form action="" method="post">
                        <tr>
                            <td>
                                <?= $no++; ?>
                                <input type="hidden" name="idtransaksi[]" value="<?= $row['idtransaksi']; ?>">
                                <input type="hidden" name="produk" value="<?= $row['idproduk']; ?>">
                                <input type="hidden" name="user" value="<?= $username; ?>">
                            </td>
                            <td><?= $row['namaproduk']; ?></td>
                            <td><input type="number" name="stokproduk" value="<?= $row['jumlah']; ?>" readonly></td>
                            <td>Rp<?= $row['hargaproduk']; ?></td>
                            <td><?= $row['hargaproduk'] * $row['jumlah']; ?></td>
                            <td>

                                <?php

                                if ($row['status'] === 'acc') {
                                    echo "<h3 style='color: green;'>Accepted</h3>";
                                } elseif ($row['status'] === 'reject') {
                                    echo "<h3 style='color: red;'>Rejected</h3>";
                                } else {
                                    echo "<h3 style='color: black;'>Pending</h3>";
                                }

                                ?>


                            </td>
                        </tr>

                    <?php } ?>
            </tbody>
            </form>
        </table>
    </div>

</body>

</html>