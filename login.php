<?php  
    session_start();
    require 'koneksi.php';

    if (isset($_SESSION['username'])) {
        header('location: index.php');
    }

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = mysqli_query($conn, "SELECT * FROM user where username = '$username' and password = '$password'");
        $row = mysqli_fetch_assoc($sql);

        if (mysqli_num_rows($sql) > 0) {
            if ($row['level'] == 'member') {
                $_SESSION['username'] = $row['username'];
                echo '
                    <script>
                        alert("Login Berhasil")
                        document.location.href = "index.php"
                    </script>
                ';
            }
        elseif ($row['level'] == 'admin') {
                $_SESSION['username'] = $row['username'];
                echo "
                    <script>
                        alert('Berhasil Login')
                        document.location.href = 'indexadm.php'
                    </script>
                ";
        }
    } else {

        echo '
            <script>
                alert("Login Gagal!!")
                document.location.href = "login.php"
            </script>
        ';
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

        .bujug{
            border: solid 2px black;
            width: 300px;
            margin: 75px;
            border-radius: 8px;
            padding: 50px;
        }

        h1{
            margin-bottom: 25px;
        }

        input{
            width: 150px;
            padding: 5px;
            border-radius: 5px;
            margin: 0px 7px;
        }
        
        button{
            border-radius: 4px;
            margin-top: 25px;
            width: 60px;
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
            </ul>
        </div>
    </nav>
    <center>
    <div class="bujug">
        <h1>LOGIN</h1>
        <form action="" method="post">
            <div>
                <input type="text" name="username" placeholder="username"><br>
                <input type="text" name="password" placeholder="password"><br>
                <button type="submit" name="submit">submit</button>
            </div>
        </form>
    </div>
    </center>
</body>
</html>