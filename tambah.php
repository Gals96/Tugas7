<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Tambah Data KRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h2 class="mb-4">Tambah Data KRS</h2>

    <form method="POST">
        <div class="mb-3">
            <label>Mahasiswa</label>
            <select name="npm" class="form-control" id="pilihMahasiswa">
                <option value="">-- Pilih Mahasiswa --</option>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM mahasiswa");
                while ($mhs = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$mhs['npm']}'>{$mhs['npm']} - {$mhs['nama']}</option>";
                }
                ?>
                <option value="manual">-- Input Manual --</option>
            </select>
        </div>

        <div id="inputManualMahasiswa" style="display:none;">
            <div class="mb-3">
                <label>NPM Mahasiswa</label>
                <input type="text" name="npm_manual" class="form-control" placeholder="Masukkan NPM">
            </div>
            <div class="mb-3">
                <label>Nama Mahasiswa</label>
                <input type="text" name="nama_mhs" class="form-control" placeholder="Masukkan Nama Lengkap">
            </div>
        </div>

        <div class="mb-3">
            <label>Mata Kuliah</label>
            <select name="kodemk" class="form-control" id="pilihMatakuliah">
                <option value="">-- Pilih Mata Kuliah --</option>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM matakuliah");
                while ($mk = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$mk['kodemk']}'>{$mk['kodemk']} - {$mk['nama']}</option>";
                }
                ?>
                <option value="manual">-- Input Manual --</option>
            </select>
        </div>

        <div id="inputManualMatakuliah" style="display:none;">
            <div class="mb-3">
                <label>Kode Mata Kuliah</label>
                <input type="text" name="kodemk_manual" class="form-control" placeholder="Masukkan Kode MK">
            </div>
            <div class="mb-3">
                <label>Nama Mata Kuliah</label>
                <input type="text" name="nama_mk" class="form-control" placeholder="Masukkan Nama MK">
            </div>
            <div class="mb-3">
                <label>Jumlah SKS</label>
                <input type="number" name="jumlah_sks" class="form-control" placeholder="Masukkan Jumlah SKS">
            </div>
        </div>

        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $npm = '';
        $kodemk = '';
        
        if (isset($_POST['npm']) && $_POST['npm'] == 'manual') {
            $npm_manual = isset($_POST['npm_manual']) ? $_POST['npm_manual'] : '';
            $nama_mhs = isset($_POST['nama_mhs']) ? $_POST['nama_mhs'] : '';
            
            if (!empty($npm_manual) && !empty($nama_mhs)) {
                $cek_npm = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE npm='$npm_manual'");
                if (mysqli_num_rows($cek_npm) == 0) {
                    mysqli_query($conn, "INSERT INTO mahasiswa (npm, nama) VALUES ('$npm_manual', '$nama_mhs')");
                }
                
                $npm = $npm_manual;
            }
        } elseif (isset($_POST['npm']) && $_POST['npm'] != '') {
            $npm = $_POST['npm'];
        }
        
        if (isset($_POST['kodemk']) && $_POST['kodemk'] == 'manual') {
            $kodemk_manual = isset($_POST['kodemk_manual']) ? $_POST['kodemk_manual'] : '';
            $nama_mk = isset($_POST['nama_mk']) ? $_POST['nama_mk'] : '';
            $jumlah_sks = isset($_POST['jumlah_sks']) ? $_POST['jumlah_sks'] : 0;
            
            if (!empty($kodemk_manual) && !empty($nama_mk)) {
                $cek_kodemk = mysqli_query($conn, "SELECT * FROM matakuliah WHERE kodemk='$kodemk_manual'");
                if (mysqli_num_rows($cek_kodemk) == 0) {
                    mysqli_query($conn, "INSERT INTO matakuliah (kodemk, nama, jumlah_sks) VALUES ('$kodemk_manual', '$nama_mk', '$jumlah_sks')");
                }
                
                $kodemk = $kodemk_manual;
            }
        } elseif (isset($_POST['kodemk']) && $_POST['kodemk'] != '') {
            $kodemk = $_POST['kodemk'];
        }
        
        if (!empty($npm) && !empty($kodemk)) {
            $insert = mysqli_query($conn, "INSERT INTO krs (mahasiswa_npm, matakuliah_kodemk) VALUES ('$npm', '$kodemk')");
            if ($insert) {
                echo "<div class='alert alert-success mt-3'>Data berhasil ditambahkan!</div>";
                echo "<script>setTimeout(function(){ window.location='index.php'; }, 1500);</script>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Gagal menyimpan data: " . mysqli_error($conn) . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger mt-3'>Data mahasiswa dan mata kuliah harus diisi!</div>";
        }
    }
    ?>

    <script>
        document.getElementById('pilihMahasiswa').addEventListener('change', function() {
            if (this.value === 'manual') {
                document.getElementById('inputManualMahasiswa').style.display = 'block';
            } else {
                document.getElementById('inputManualMahasiswa').style.display = 'none';
            }
        });
        
        document.getElementById('pilihMatakuliah').addEventListener('change', function() {
            if (this.value === 'manual') {
                document.getElementById('inputManualMatakuliah').style.display = 'block';
            } else {
                document.getElementById('inputManualMatakuliah').style.display = 'none';
            }
        });
    </script>
</body>
</html>