<?php
    $conn = mysqli_connect("localhost", "root", "", "printer");

    if (!$conn) {
        echo "conn tidak berhasil";
    }

    function addproduk()
{
    global $conn;

    $namaproduk = $_POST['namaproduk'];
    $stokproduk = $_POST['stokproduk'];
    $keterangan = $_POST['keterangan'];
    $hargaproduk = $_POST['hargaproduk'];
   

    $query = mysqli_query($conn, "INSERT INTO produk (namaproduk, stokproduk, keterangan, hargaproduk) VALUES ('$namaproduk', '$stokproduk', '$keterangan', '$hargaproduk')");

    return mysqli_affected_rows($conn);
}

function edit()
{
    global $conn;

    $idproduk = $_POST['idproduk'];
    $namaproduk = $_POST['namaproduk'];
    $stokproduk = $_POST['stokproduk'];
    $keterangan = $_POST['keterangan'];
    $hargaproduk = $_POST['hargaproduk'];

    $query = mysqli_query($conn, "
                        UPDATE produk SET
                        namaproduk = '$namaproduk',
                        stokproduk = '$stokproduk',
                        keterangan = '$keterangan',
                        hargaproduk = '$hargaproduk'
                        WHERE idproduk = '$idproduk'");

    return mysqli_affected_rows($conn);
}

function checkout()
{
    global $conn;

    $idproduk = $_POST['idproduk'];
    $user = $_POST['user'];
    $jumlah = $_POST['kuantitas'];
    $alamat = $_POST['alamat'];
    $nomor = $_POST['nomor'];
    $stok = $_POST['stok'];
    

    $sql = mysqli_query($conn, "INSERT INTO transaksi (user, produk, jumlah, alamatpenerima, nomorhp, status) VALUES ('$user', '$idproduk', '$jumlah', '$alamat', '$nomor', 'P')");

    $prdk = mysqli_query($conn, "UPDATE produk SET
                                    stokproduk = stokproduk - $jumlah
                                    WHERE idproduk = '$idproduk'");

    return mysqli_affected_rows($conn);
}
?>