<?php  
    session_start();
    require 'koneksi.php';

    $username = $_SESSION['username'];
    $sql = mysqli_query($conn, "SELECT * FROM user where username = '$username'");
    $level = mysqli_fetch_assoc($sql)['level'];

    if (!$username) {
        echo '
            <script>
                alert("Harap login terlebih dahulu")
                document.location.href = "login.php"
            </script>
        ';
    }

    if ($level == 'member') {
        echo "
            <script>
                alert('member tidak memiliki akses')
                document.location.href = 'index.php'
            </script>
        ";
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
        <table border="2">
            <tr>
                <th>No</th>
                <th>Nama Printer</th>
                <th>Stok</th>
                <th>Keterangan</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
            <?php  
                $no=1;
                $sql = mysqli_query($conn, "SELECT * FROM produk");
            ?>
            <?php  
            foreach ($sql as $row) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['namaproduk']; ?></td>
                <td><?= $row['stokproduk']; ?></td>
                <td><?= $row['keterangan']; ?></td>
                <td><?= $row['hargaproduk']; ?></td>
                <td>
                    <button><a href="edit.php?idproduk=<?= $row['idproduk']; ?>" style="color: black; text-decoration: none;">Edit</a></button>
                    <button><a href="delete.php?idproduk=<?= $row['idproduk']; ?>" style="color: black; text-decoration: none;">Delete</a></button>
                </td>
            </tr>
            <?php } ?>
        </table>
    </center>
</body>
</html>