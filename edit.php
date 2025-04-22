<?php include 'db.php';
$id = $_GET['id'];
$krs = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM krs WHERE id=$id"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data KRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Edit Data KRS</h2>

    <form method="POST">
        <div class="mb-3">
            <label>Mahasiswa</label>
            <select name="npm" class="form-control" required>
                <?php
                $mhsList = mysqli_query($conn, "SELECT * FROM mahasiswa");
                while ($mhs = mysqli_fetch_assoc($mhsList)) {
                    $selected = ($mhs['npm'] == $krs['mahasiswa_npm']) ? 'selected' : '';
                    echo "<option value='{$mhs['npm']}' $selected>{$mhs['npm']} - {$mhs['nama']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Mata Kuliah</label>
            <select name="kodemk" class="form-control" required>
                <?php
                $mkList = mysqli_query($conn, "SELECT * FROM matakuliah");
                while ($mk = mysqli_fetch_assoc($mkList)) {
                    $selected = ($mk['kodemk'] == $krs['matakuliah_kodemk']) ? 'selected' : '';
                    echo "<option value='{$mk['kodemk']}' $selected>{$mk['kodemk']} - {$mk['nama']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>

    <?php
    if (isset($_POST['update'])) {
        $npm = $_POST['npm'];
        $kodemk = $_POST['kodemk'];

        mysqli_query($conn, "UPDATE krs SET mahasiswa_npm='$npm', matakuliah_kodemk='$kodemk' WHERE id=$id");
        echo "<script>('Data berhasil diperbarui!'); window.location='index.php';</script>";
    }
    ?>
</body>
</html>