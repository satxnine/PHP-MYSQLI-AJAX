<?php

session_start();
include '../config/koneksi.php';

if (!$_SESSION['id_user']) {
    echo '<script>
    alert("anda mesti login dulu");
    window.location.href = "index.php";
    </script>
    ';
}
// jika tombol simpan/add di klik
if (isset($_POST['addSiswa'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nis = $_POST['nis'];
    $alamat = $_POST['alamat'];
    $q = "INSERT INTO tbl_siswa(nama_lengkap, nis, alamat) VALUES (' $nama_lengkap  ', '  $nis  ', '  $alamat  ')";
    $connection->query($q);
}
//jika tombol hapus di klik
if (isset($_POST['hapusSiswa'])) {
    $id_siswa = $_POST['id_siswa'];
    $q = "DELETE FROM tbl_siswa WHERE id_siswa = '$id_siswa'";
    $connection->query($q);
}
// jika tombol update di klik
if (isset($_POST['update'])) {
    $id_siswa = $_POST['id_siswa'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $nis = $_POST['nis'];
    $alamat = $_POST['alamat'];
    $q = "UPDATE tbl_siswa SET nama_lengkap='$nama_lengkap', nis='$nis', alamat='$alamat' WHERE id_siswa = '$id_siswa'";
    $connection->query($q);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <title>Dashboard</title>
</head>

<body>

    <div class="container" style="margin-top: 50px">
        <div class="row">

            <?php include '../assets/menu.php';
            // echo $_SERVER['SERVER_NAME'];
            ?>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <label>SISWA</label>
                        Selamat Datang <?php echo $_SESSION['nama_lengkap'] ?>
                        <br>
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalAdd">+ tambah data</button>
                        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">Tambah Data</div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input type="text" placeholder="isikan nama anda" name="nama_lengkap" id="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>NIS</label>
                                                <input type="text" placeholder="isikan nama NIS" name="nis" id="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input type="text" placeholder="isikan alamat" name="alamat" id="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <button name="addSiswa" type="submit" class="form-control btn btn-success">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>nama lengkap</th>
                                    <th>nis</th>
                                    <th>alamat</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $q = "SELECT * FROM tbl_siswa";
                                $r = $connection->query($q);
                                while ($d = mysqli_fetch_object($r)) { ?>
                                    <tr>
                                        <td><?= $no;
                                            $no++; ?></td>
                                        <td>
                                            <?= $d->nama_lengkap ?>
                                        </td>
                                        <td>
                                            <?= $d->nis ?>
                                        </td>
                                        <td>
                                            <?= $d->alamat ?>
                                        </td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="id_siswa" value="<?= $d->id_siswa ?>">
                                                <button name="hapusSiswa" class="btn btn-danger">hapus
                                            </form>
                                        </td>

                                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#modalUpdate<?= $d->id_siswa ?>">edit</button>
                                            <div class="modal fade" id="modalUpdate<?= $d->id_siswa ?>">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">Edit Data</div>
                                                            <div class="modal-body">
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="id_siswa" value="<?= $d->id_siswa ?>">
                                                                    <div class="form-group">
                                                                        <label>Nama Lengkap</label>
                                                                        <input type="text" value="<?= $d->nama_lengkap ?>" placeholder="isikan nama anda" name="nama_lengkap" id="" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>NIS</label>
                                                                        <input type="text" value="<?= $d->nis ?>" placeholder="isikan nama NIS" name="nis" id="" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Alamat</label>
                                                                        <input type="text" value="<?= $d->alamat ?>" placeholder="isikan alamat" name="alamat" id="" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button name="update" type="submit" class="form-control btn btn-primary">Update</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>