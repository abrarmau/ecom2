<?php
    error_reporting(0);
    session_start();
    include 'koneksi.php';

    $username = $_SESSION['username'];
    $sql = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $level = mysqli_fetch_assoc($sql)['level'];
    
    $produk = mysqli_query($conn, "SELECT * FROM produk");
    
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
                <?php  
                    if (isset($username)) {
                        echo "
                            <li> 
                                <a href='myorders.php'>Orders</a>
                            </li>
                            <li> 
                                <a href='logout.php'>Logout</a>
                            </li>
                        ";
                    } else {
                        echo '
                            <li>
                                <a href="login.php">Login</a>
                            </li>
                        ';
                    }
                ?>
            </ul>
        </div>
    </nav>
    <center>
        <div class="intangemas">
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
            foreach ($produk as $row){
        ?>
        <form action="" method="post">
        <tr>
            <td>
                <?= $no++; ?>
                <input type="hidden" name="produk" value="<?= $row['idproduk']; ?>">
                <input type="hidden" name="user" value="<?= $username; ?>">
            </td>
            <td><?= $row['namaproduk']; ?></td>
            <td><?= $row['stokproduk']; ?></td>
            <td><?= $row['keterangan']; ?></td>
            <td><?= $row['hargaproduk']; ?></td>
            <td>
            <?php  
        
        if ($row['stokproduk'] < 1) {
            echo "<p style='color: red;'>Stok Habis</p>";       
         } else {
            echo '
            <button>
                <a href="form.php?id='.$row['idproduk']. ' " style="color: black; text-decoration: none; font-size: 10px;">Buy Now</a>
            </button>
            ';
         }
        ?>
        </td>
        </tr>
        </form>
        <?php } ?>
    </table>
        </div>
    </center>
</body>
</html>