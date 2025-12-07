<?php

// Fungsi sanitasi
function bersihkan($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

//Fungsi validasi nim
function validasi_nim($nim) {
    $nim = trim($nim);
    if (empty($nim)) return "Nim tidak boleh kosong. ";
    if (!is_numeric($nim)) return "Nim harus berisi angka. ";
    return "";
}

// Fungsi validasi nama
function validasi_nama($nama) {
    $nama = trim($nama);
    if (empty($nama)) return "Nama tidak boleh kosong.";
    if (!preg_match("/^[a-zA-Z\s]+$/", $nama)) return "Nama harus hanya berisi huruf dan spasi.";
    return "";
}

// Fungsi validasi umur
function validasi_umur($umur) {
    $umur = trim($umur);
    if (empty($umur)) return "Umur tidak boleh kosong.";
    if (!is_numeric($umur)) return "Umur harus berupa angka.";
    if ($umur < 1 || $umur > 150) return "Umur harus antara 1 dan 150 tahun.";
    return "";
}

$error_nim  = "";
$error_nama = "";
$error_umur = "";
$error_form = false;

// Validasi jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim           = bersihkan($_POST['nim']);
    $nama          = bersihkan($_POST['nama']);
    $umur          = bersihkan($_POST['umur']);
    $tempat_lahir  = bersihkan($_POST['tempat_lahir']);
    $tanggal_lahir = bersihkan($_POST['tanggal_lahir']);
    $no_hp         = bersihkan($_POST['no_hp']);
    $alamat        = bersihkan($_POST['alamat']);
    $email         = bersihkan($_POST['email']);
    $kota          = bersihkan($_POST['kota']);
    $jk            = $_POST['jk'] ?? "-";
    $status        = $_POST['status'] ?? "-";

    $error_nim = validasi_nim($nim);
    $error_nama = validasi_nama($nama);
    $error_umur = validasi_umur($umur);

    if ($error_nim || $error_nama || $error_umur) $error_form = true;

    // Checkbox hobi
    $hobi_list = [];
    if (!empty($_POST['hobi'])) {
        foreach ($_POST['hobi'] as $h) {
            $hobi_list[] = bersihkan($h);
        }
    }
    $hobi_output = implode(", ", $hobi_list);
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Form POST Modern</title>

<style>
    /* Background Keren */
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #ffb700ff, #e2d32dff);
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 100vh;
        padding-top: 40px;
    }

    /* Card Glassmorphism */
    .container {
        width: 95%;
        max-width: 500px;
        background: rgba(255, 255, 255, 0.13);
        backdrop-filter: blur(12px);
        border-radius: 15px;
        padding: 25px;
        color: white;
        box-shadow: 0 8px 28px rgba(0,0,0,0.4);
        animation: fadeIn .7s ease-in-out;
    }

    h2 {
        text-align: center;
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }

    input, select {
        width: 100%;
        padding: 10px;
        border-radius: 10px;
        border: none;
        margin-top: 5px;
        outline: none;
    }

    input[type="radio"], input[type="checkbox"] {
        width: auto;
        margin-right: 6px;
    }

    /* Tombol Keren */
    input[type="submit"] {
        margin-top: 20px;
        background: #3e3e3eff;
        padding: 12px;
        font-weight: bold;
        border-radius: 12px;
        cursor: pointer;
        transition: .2s;
        width: 100%;
    }

    input[type="submit"]:hover {
        background: white;
        color: #1a004dff;
        transform: scale(1.03);
        box-shadow: 0 0 14px #00E0FF;
    }

    /* Pesan Error */
    .error-box {
        background: rgba(255, 0, 0, 0.4);
        padding: 10px;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    /* Output */
    .hasil {
        margin-top: 25px;
        padding: 15px;
        background: rgba(255,255,255,0.2);
        border-radius: 12px;
    }

    @media (max-width: 480px) {
        .container {
            padding: 18px;
        }
        h2 { font-size: 20px; }
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

</style>

</head>
<body>

<div class="container">
    <h2>Form Input Mahasiswa</h2>

    <?php if ($error_form): ?>
        <div class="error-box">
            <p><?= $error_nim ?></p>
            <p><?= $error_nama ?></p>
            <p><?= $error_umur ?></p>
        </div>
    <?php endif; ?>

    <form method="POST">

        <label>NIM:</label>
        <input type="text" name="nim" value="<?= $nim ?? '' ?>">

        <label>Nama:</label>
        <input type="text" name="nama" value="<?= $nama ?? '' ?>">

        <label>Umur:</label>
        <input type="text" name="umur" value="<?= $umur ?? '' ?>">

        <label>Tempat Lahir:</label>
        <input type="text" name="tempat_lahir" value="<?= $tempat_lahir ?? '' ?>">

        <label>Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" value="<?= $tanggal_lahir ?? '' ?>">

        <label>No HP:</label>
        <input type="text" name="no_hp" value="<?= $no_hp ?? '' ?>">

        <label>Alamat:</label>
        <input type="text" name="alamat" value="<?= $alamat ?? '' ?>">

        <label>Email:</label>
        <input type="email" name="email" value="<?= $email ?? '' ?>">

        <label>Kota:</label>
        <select name="kota">
            <?php 
            $daftar_kota = ["Semarang","Solo","Brebes","Kudus","Demak","Salatiga"];
            foreach ($daftar_kota as $k) {
                $sel = (isset($kota) && $kota == $k) ? "selected" : "";
                echo "<option value='$k' $sel>$k</option>";
            }
            ?>
        </select>

        <label>Jenis Kelamin:</label>
        <input type="radio" name="jk" value="L" <?= ($jk ?? '') == "L" ? "checked" : "" ?>> Laki-laki
        <input type="radio" name="jk" value="P" <?= ($jk ?? '') == "P" ? "checked" : "" ?>> Perempuan

        <label>Status Kawin:</label>
        <input type="radio" name="status" value="Belum" <?= ($status ?? '') == "Belum" ? "checked" : "" ?>> Belum Kawin
        <input type="radio" name="status" value="Kawin" <?= ($status ?? '') == "Kawin" ? "checked" : "" ?>> Kawin

        <label>Hobi:</label>
        <input type="checkbox" name="hobi[]" value="Membaca" <?= isset($hobi_list) && in_array("Membaca",$hobi_list) ? "checked" : "" ?>> Membaca
        <input type="checkbox" name="hobi[]" value="Olahraga" <?= isset($hobi_list) && in_array("Olahraga",$hobi_list) ? "checked" : "" ?>> Olahraga
        <input type="checkbox" name="hobi[]" value="Musik" <?= isset($hobi_list) && in_array("Musik",$hobi_list) ? "checked" : "" ?>> Musik

        <input type="submit" value="Kirim">
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$error_form): ?>
        <div class="hasil">
            <h3>Data Diterima:</h3>
            <p><b>NIM:</b> <?= $nim ?></p>
            <p><b>Nama:</b> <?= $nama ?></p>
            <p><b>Umur:</b> <?= $umur ?></p>
            <p><b>Tempat Lahir:</b> <?= $tempat_lahir ?></p>
            <p><b>Tanggal Lahir:</b> <?= $tanggal_lahir ?></p>
            <p><b>No HP:</b> <?= $no_hp ?></p>
            <p><b>Alamat:</b> <?= $alamat ?></p>
            <p><b>Kota:</b> <?= $kota ?></p>
            <p><b>Jenis Kelamin:</b> <?= $jk ?></p>
            <p><b>Status:</b> <?= $status ?></p>
            <p><b>Hobi:</b> <?= $hobi_output ?></p>
            <p><b>Email:</b> <?= $email ?></p>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
