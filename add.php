<?php  
session_start();
require 'koneksi.php';

$user = $_SESSION['username'];

if (!$user) {
    echo "
        <script>
            alert('Hrap Login')
            document.location.href = 'index.php'
        </script>    
    ";
}

$sql = mysqli_query($conn, "SELECT * FROM user where username = '$user'");
$level = mysqli_fetch_assoc($sql);

if ($level == 'member') {
    echo "
        <script>
            alert('anda gbisa masuk')
            document.location.href = 'index.php'
        </script>
    ";
}

if (isset($_POST['submit'])) {
    if (addproduk($_POST) > 0) {
        echo "
            <script>
                alert('produk berhasil ditambah!')
                document.location.href = 'add.php'
            </script>
        ";
    } else {
        echo "
            <script>
                alert('produk ggal ditambah')
                document.location.href = 'add.php'
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
                    <th colspan="2">product</th>
                </thead>
                <tbody>
                    <form action="" method="post" enctype="multipart/form-data">
                        <tr>
                            <td>Nama Produk</td>
                            <td><input type="text" name="namaproduk"></td>
                        </tr>
                        <tr>
                            <td>Stok Produk</td>
                            <td><input type="number" name="stokproduk"></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td><textarea name="keterangan" cols="30" rows="5"></textarea></td>
                        </tr>
                        <tr>
                            <td>Harga Produk</td>
                            <td><input type="number" name="hargaproduk"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center>
                                    <button type="submit" name="submit">Add</button>
                                </center>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
    </center>
</body>
</html>
