<?php

// Fungsi untuk validasi nama
function validasi_nama($nama) {
    // Cek jika nama kosong
    if (empty($nama)) {
        return "Nama tidak boleh kosong!";
    }
    // Cek jika nama hanya mengandung huruf dan spasi
    elseif (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        return "Nama hanya boleh mengandung huruf dan spasi!";
    }
    return true; // Validasi berhasil
}

// Fungsi untuk validasi umur
function validasi_umur($umur) {
    // Cek jika umur kosong
    if (empty($umur)) {
        return "Umur tidak boleh kosong!";
    }
    // Cek jika umur hanya berisi angka
    elseif (!is_numeric($umur)) {
        return "Umur harus berupa angka!";
    }
    // Cek jika umur lebih kecil dari 1 atau lebih besar dari 120
    elseif ($umur < 1 || $umur > 120) {
        return "Umur harus antara 1 dan 120!";
    }
    return true; // Validasi berhasil
}

// Proses data form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];

    // Validasi nama
    $validasi_nama = validasi_nama($nama);
    // Validasi umur
    $validasi_umur = validasi_umur($umur);

    // Menampilkan hasil validasi
    if ($validasi_nama === true && $validasi_umur === true) {
        echo "Data valid!<br>";
        echo "Nama: " . htmlspecialchars($nama) . "<br>";
        echo "Umur: " . htmlspecialchars($umur) . "<br>";
    } else {
        // Tampilkan pesan kesalahan jika ada
        if ($validasi_nama !== true) {
            echo $validasi_nama . "<br>";
        }
        if ($validasi_umur !== true) {
            echo $validasi_umur . "<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Validasi Nama dan Umur</title>
</head>
<body>

<h2>Form Input Nama dan Umur</h2>
<form method="POST">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama"><br><br>

    <label for="umur">Umur:</label>
    <input type="text" id="umur" name="umur"><br><br>

    <input type="submit" value="Kirim">
</form>

</body>
</html>
