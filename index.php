<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data KRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Data KRS</h2>
    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Data</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Mata Kuliah</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = "SELECT krs.id, m.nama AS nama_mhs, mk.nama AS nama_mk, mk.jumlah_sks 
                      FROM krs 
                      JOIN mahasiswa m ON krs.mahasiswa_npm = m.npm 
                      JOIN matakuliah mk ON krs.matakuliah_kodemk = mk.kodemk
                      ORDER BY krs.id ASC";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>$no</td>
                        <td>{$row['nama_mhs']}</td>
                        <td>{$row['nama_mk']}</td>
                        <td><span class='text-danger fw-bold'>{$row['nama_mhs']}</span> Mengambil Mata Kuliah <span class='text-danger fw-bold'>{$row['nama_mk']}</span> ({$row['jumlah_sks']} SKS)</td>
                        <td>
                            <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='hapus.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                        </td>
                      </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>
