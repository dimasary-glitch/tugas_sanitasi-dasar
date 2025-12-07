<!DOCTYPE html>
<html>
<head>
    <title>Hasil Input GET</title>
</head>
<body>

<h2>Data yang Dikirim dengan Metode GET</h2>

<?php
    $nim = $_GET['nim'] ?? '-';
    $nama = $_GET['nama'] ?? '-';
    $umur = $_GET['umur'] ?? '-';
    $tempat_lahir = $_GET['tempat_lahir'] ?? '-';
    $tanggal_lahir = $_GET['tanggal_lahir'] ?? '-';
    $no_hp = $_GET['no_hp'] ?? '-';
    $alamat = $_GET['alamat'] ?? '-';
    $kota = $_GET['kota'] ?? '-';
    $email = $_GET['email'] ?? '-';

    echo "NIM : " . $nim . "<br>";
    echo "Nama : " . $nama . "<br>";
    echo "Umur : " . $umur . "<br>";
    echo "Tempat Lahir : " . $tempat_lahir . "<br>";
    echo "Tanggal Lahir : " . $tanggal_lahir . "<br>";
    echo "No HP : " . $no_hp . "<br>";
    echo "Alamat : " . $alamat . "<br>";
    echo "Kota : " . $kota . "<br>";

    if (isset($_GET['jk'])) {
        $jk = $_GET['jk'];
        if ($jk == "Laki - Laki") {
            echo "Jenis Kelamin : Laki - Laki<br>";
        } else {
            echo "Jenis Kelamin : Perempuan<br>";
        }
    } else {
        echo "Jenis Kelamin : Belum dipilih<br>";
    }

    if (isset($_GET['status'])) {
        echo "Status : " . $_GET['status'] . "<br>";
    } else {
        echo "Status : Belum dipilih<br>";
    }

    echo "Hobi : ";
    if (!empty($_GET['hobi'])) { 
        foreach ($_GET['hobi'] as $hobi_item) {
            echo $hobi_item . ", ";
        }
    } else {
        echo "Tidak Memiliki Hobi";
    }

    echo "<br>Email : " . $email . "<br>";
?>

</body>
</html>