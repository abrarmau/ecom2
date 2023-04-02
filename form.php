<?php  

session_start();
require 'koneksi.php';

$username= $_SESSION['username'];
$sql = mysqli_query($conn, "SELECT * FROM user where username = '$username'");
foreach ($sql as $usr) {
    $level = $usr['level'];
    $user = $usr['username'];
    $iduser = $usr['id'];
}
$idproduk = $_GET['id'];

$produk = mysqli_query($conn, "SELECT * FROM produk");

if ($level == 'admin') {
    header('location: admin.php');
}

if (!$username) {
    echo "
        <script>
            alert('Login dulu!!')
            document.location.href = 'login.php'
        </script>
    ";
}

if (isset($_POST['co'])) {
    if (checkout($_POST) > 0) {
        echo "
            <script>
                alert('transaksi berhasil')
                document.location.href = 'index.php'
            </script>
        ";
    } else {
        echo "
            <script>
                alert('transaksi gagal')
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
                <li><a href="index.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <center>
        <div>
            <table border="2">
                <thead>
                    <th colspan="6">
                        <center>
                            Informasi Produk
                        </center>
                    </th>
                </thead>
                <thead>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Stok</th>
                    <th>Keterangan</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                </thead>
                <form action="" method="post">
                    <tbody>
                        <?php  
                        $no=1;
                        foreach ($produk as $row) {
                        ?>

                        <tr>
                            <td>
                                <?= $no++; ?>
                                <input type="hidden" name="idproduk" value="<?= $idproduk; ?>">
                            </td>
                            <td><?= $row['namaproduk']; ?></td>
                            <td><?= $row['stokproduk']; ?></td>
                            <td><?= $row['keterangan']; ?></td>
                            <td>Rp<?= $row['hargaproduk'];  ?></td>
                            <td>
                                <input type="number" name="kuantitas" value="1" min="1" max="<?= $row['stokproduk']; ?>"required>
                                <input type="hidden" name="stok" value="<?= $rpw['stokproduk']; ?>">
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
            </table>
        </div>

        <div>
            <table border="2">
                <thead>
                    <th colspan="3">
                    <center>
                        Informasi Customer
                    </center>
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>Account Pembeli</td>
                        <td> : </td>
                        <td>
                            <input type="text" name="user" value="<?= $user; ?> "readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat Pembeli</td>
                        <td> : </td>
                        <td>
                            <textarea name="alamat" cols="30" rows="5"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Nomor telp pembeli</td>
                        <td> : </td>
                        <td>
                            <input type="number" name="nomor">
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <th colspan="3">
                        <center>
                            <button type="submit" name="co">Checkout</button>
                        </center>
                    </th>
                </tfoot>
                </form>
            </table>
        </div>
    </center>
</body>
</html>