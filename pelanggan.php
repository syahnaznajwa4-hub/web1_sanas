<?php
include 'koneksi.php';

$query = "SELECT p.id_pelanggan, p.nama_pelanggan, jp.jenis, p.alamat, p.no_handphone 
          FROM pelanggan AS p 
          INNER JOIN jenis_pelanggan AS jp ON p.id_jenis = jp.id_jenis 
          ORDER BY p.id_pelanggan ASC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pelanggan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 6px 12px; text-decoration: none; border-radius: 4px; color: white; font-size: 14px; }
        .btn-tambah { background-color: #28a745; }
        .btn-edit { background-color: #ffc107; color: black; }
        .btn-hapus { background-color: #dc3545; }
    </style>
</head>
<body>

    <h2>Daftar Pelanggan</h2>
    <a href="tambah_pelanggan.php" class="btn btn-tambah">+ Tambah Pelanggan Baru</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>Jenis Pelanggan</th>
                <th>Alamat</th>
                <th>No Handphone</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $row['id_pelanggan']; ?></td>
                <td><?= htmlspecialchars($row['nama_pelanggan']); ?></td>
                <td><?= htmlspecialchars($row['jenis']); ?></td>
                <td><?= htmlspecialchars($row['alamat']); ?></td>
                <td><?= htmlspecialchars($row['no_handphone']); ?></td>
                <td>
                    <a href="edit_pelanggan.php?id=<?= $row['id_pelanggan']; ?>" class="btn btn-edit">Edit</a>
                    <a href="hapus_pelanggan.php?id=<?= $row['id_pelanggan']; ?>" class="btn btn-hapus" onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>