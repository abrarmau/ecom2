<?php  
session_start();
require 'koneksi.php';

$username = $_SESSION['username'];
$sql = mysqli_query($conn, "SELECT * FROM user where username = '$username'");
$level = mysqli_fetch_assoc($sql)['level'];

if (!$username) {
    echo "
        <script>
            alert('Harap login')
            document.location.href = 'login.php'
        </script>
    ";
}

if ($level == 'member') {
    echo "
        <script>
            alert('Tidak dapat akses')
            document.location.href = 'index.php'
        </script>
    ";
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

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            width: 650px;
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
                <li><a href="indexadm.php">Home</a></li>
                <li><a href="add.php">Add Products</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <center>
        <div>
            <table border="2">
                <thead>
                    <th>No</th>
                    <th>Akun Customer</th>
                    <th>Nama Produk</th>
                    <th>Stok Produk</th>
                    <th>Harga Produk</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php 
                    $no=1;
                    $produk = mysqli_query($conn, "SELECT * FROM transaksi inner join produk on transaksi.produk = produk.idproduk inner join user on transaksi.user = user.username where status not like 'K'");
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
                            <td><?= $row['user']; ?></td>
                            <td><?= $row['namaproduk'];?></td>
                            <td><input type="number" name="stokproduk" value="<?= $row['stokproduk']; ?>"></td>
                            <td><?= $row['hargaproduk']; ?></td>
                            <td><?= $row['hargaproduk'] * $row['jumlah']; ?></td>
                            <td>
                                <?php  
                                    if ($row['status'] === 'acc') {
                                        echo "<h3 style='color: green;'>Accepted</h3>";
                                    } elseif ($row['status'] === 'reject') {
                                        echo "<h3 style='color: red;'>Rejected</h3>";
                                    } else {
                                        echo '
                                        <button>
                                            <a href="acc.php?id=' . $row['idtransaksi'] . '" style="color: black; text-decoration: none;">Accept</a>
                                        </button>
                                        <button>
                                            <a href="reject.php?id=' . $row['idtransaksi'] . '" style="color: black; text-decoration: none;">Reject</a>
                                        </button>
                                        ';
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </form>
                </tbody>
            </table>
        </div>
    </center>
</body>
</html>