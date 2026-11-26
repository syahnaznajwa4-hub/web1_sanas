<?php
include 'koneksi.php';

$jenis_query = mysqli_query($koneksi, "SELECT * FROM jenis_pelanggan ORDER BY jenis ASC");

if (isset($_POST['simpan'])) {
    $id_jenis      = $_POST['id_jenis'];
    $nama_pelanggan = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
    $alamat        = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_handphone  = mysqli_real_escape_string($koneksi, $_POST['no_handphone']);

    $sql = "INSERT INTO pelanggan (id_jenis, nama_pelanggan, alamat, no_handphone) 
            VALUES ('$id_jenis', '$nama_pelanggan', '$alamat', '$no_handphone')";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: pelanggan.php");
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelanggan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        form { max-width: 400px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 15px; padding: 10px 15px; background: #28a745; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Tambah Data Pelanggan</h2>
    <form method="POST" action="">
        <label>Jenis Pelanggan</label>
        <select name="id_jenis" required>
            <option value="">-- Pilih Jenis Pelanggan --</option>
            <?php while ($jp = mysqli_fetch_assoc($jenis_query)) : ?>
                <option value="<?= $jp['id_jenis']; ?>"><?= $jp['jenis']; ?></option>
            <?php endwhile; ?>
        </select>

        <label>Nama Pelanggan</label>
        <input type="text" name="nama_pelanggan" required>

        <label>Alamat</label>
        <textarea name="alamat" rows="3" required></textarea>

        <label>No Handphone</label>
        <input type="text" name="no_handphone" required>

        <button type="submit" name="simpan">Simpan Pelanggan</button>
        <a href="pelanggan.php" style="margin-left: 10px;">Batal</a>
    </form>

</body>
</html>