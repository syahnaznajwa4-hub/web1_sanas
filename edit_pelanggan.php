<?php
include 'koneksi.php';

$id = $_GET['id'];
$pelanggan_query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id'");
$data = mysqli_fetch_assoc($pelanggan_query);

$jenis_query = mysqli_query($koneksi, "SELECT * FROM jenis_pelanggan ORDER BY jenis ASC");

if (isset($_POST['update'])) {
    $id_jenis       = $_POST['id_jenis'];
    $nama_pelanggan = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
    $alamat         = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_handphone   = mysqli_real_escape_string($koneksi, $_POST['no_handphone']);

    $sql = "UPDATE pelanggan SET 
            id_jenis = '$id_jenis', 
            nama_pelanggan = '$nama_pelanggan', 
            alamat = '$alamat', 
            no_handphone = '$no_handphone' 
            WHERE id_pelanggan = '$id'";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: pelanggan.php");
        exit;
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pelanggan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        form { max-width: 400px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 15px; padding: 10px 15px; background: #007bff; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h2>Edit Data Pelanggan</h2>
    <form method="POST" action="">
        <label>Jenis Pelanggan</label>
        <select name="id_jenis" required>
            <?php while ($jp = mysqli_fetch_assoc($jenis_query)) : ?>
                <option value="<?= $jp['id_jenis']; ?>" <?= ($jp['id_jenis'] == $data['id_jenis']) ? 'selected' : ''; ?>>
                    <?= $jp['jenis']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Nama Pelanggan</label>
        <input type="text" name="nama_pelanggan" value="<?= htmlspecialchars($data['nama_pelanggan']); ?>" required>

        <label>Alamat</label>
        <textarea name="alamat" rows="3" required><?= htmlspecialchars($data['alamat']); ?></textarea>

        <label>No Handphone</label>
        <input type="text" name="no_handphone" value="<?= htmlspecialchars($data['no_handphone']); ?>" required>

        <button type="submit" name="update">Update Pelanggan</button>
        <a href="pelanggan.php" style="margin-left: 10px;">Batal</a>
    </form>

</body>
</html>