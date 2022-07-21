<?php
session_start();

require 'assets/func/function.php';
ceklogin();

$page = 'index';

if(isset($_POST['setTimer'])){
    $setTimer = $_POST['timer'];
    dbAct("UPDATE backup SET waktu='$setTimer' WHERE id='1'", $url="index.php");
}
require 'header.php';
?>
<script> var page = "<?=$page?>"; </script>
<body id="page-top">
    <?php require 'topnav.php'; ?>
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4 mt-4">
                        <h3 class="text-dark mb-0">Dashboard</h3>
                    </div>
                    <div class="row">
                        <div class="col mb-4">
                            <div class="card shadow border-left-primary py-2 mb-4">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                            <div class="text-dark font-weight-bold h5 mb-0"><span>Hai <?=$_SESSION['nama']?>! Selamat Datang di Panel Admin Kasuari Cargo</span></div>
                                        </div>
                                        <div class="col-auto"><i class="far fa-smile fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php cekTglBackup(); ?>
                    <div class="row">
                        <div class="col-lg-7 col-xl-8">
                            <div class="card shadow mb-4">
                                <div class="card-body bg-success text-white">
                                    <h1 class="m-0">Sekarang Hari <?=hari()?></h1>
                                    <h4 class="text-gray-300">Tanggal <?=tgl()?></h4>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary font-weight-bold m-0">Daftar Pengiriman Barang</h6><button class="btn border-circle dashboard-btn" type="button"><i class="fa fa-caret-down"></i></button></div>
                                <div class="card-body">
                                    <blockquote class="blockquote">
                                        <p class="mb-0">Masuk ke halaman Daftar Pengiriman Barang untuk menambah, mengedit, dan menghapus data.</p>
                                        <footer class="blockquote-footer"><a class="text-success" href="pengiriman.php">Daftar Pengiriman Barang</a></footer>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h2><a class="btn btn-block bg-warning text-white" href="akun.php"><i class="fa fa-lock"></i><strong>&nbsp;EDIT AKUN SAYA</strong></a></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-xl-4">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary font-weight-bold m-0">Grafik Pengiriman Rute&nbsp;<i class="fa fa-arrows-h"></i> Timika</h6><button class="btn border-circle dashboard-btn" type="button"><i class="fa fa-caret-down"></i></button></div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <?=grafikKirim()?>
                                    </div>
                                    <div
                                        class="text-center small mt-4"><span class="mr-2"><i class="fas fa-circle text-primary"></i>&nbsp;Makassar</span><span class="mr-2"><i class="fas fa-circle text-success"></i>&nbsp;Jakarta</span><span class="mr-2"><i class="fas fa-circle text-info"></i>&nbsp;Surabaya</span>
                                        <span
                                            class="mr-2"><i class="fas fa-circle text-warning"></i>&nbsp;Malang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col mb-4">
                        <div class="card shadow">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-primary font-weight-bold m-0">Manajemen Akun</h6><button class="btn border-circle dashboard-btn" type="button"><i class="fa fa-caret-down"></i></button></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-lg-6">
                                        <p class="text-justify">Lihat siapa saja yang bisa masuk ke Panel Admin. Jika Akun dinonaktifkan maka Akun User tersebut tidak akan dapat digunakan sampai Akun tersebut diaktifkan kembali oleh Administrator.&nbsp;<a class="text-primary cur-pointer"
                                                data-toggle="modal" data-target="#hakakses">Pelajari Hak Akses Akun lebih lanjut.</a></p>
                                        <div>
                                            <div class="modal fade" role="dialog" tabindex="-1" id="hakakses">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><strong>Hak Akses Akun&nbsp;<i class="fa fa-info-circle"></i></strong></h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                                        <div
                                                            class="modal-body">
                                                            <p class="text-body text-justify" style="padding: 15px;padding-top: 0;">Dalam sistem terdapat satu akun Administrator. Akun Administrator adalah akun yang memegang kendali penuh atas website anda. Administrator dapat menambahkan, mengedit, hingga menghapus Akun User
                                                                lain. Dengan menggunakan Akun User biasa, anda hanya diberi akses untuk mengedit atau menghapus Akun anda sendiri. Untuk Data Pengiriman, Akun User biasa tidak dapat menghapus data yang telah
                                                                diinput</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $tipeAkun = $_SESSION['status']; ?>
                                    <a class="btn btn-block bg-primary text-white mb-4" href="akun_manage.php" onclick="return linkAdmin('<?=$tipeAkun?>', 'Manajemen Akun')"><strong>MASUK KE MANAJEMEN AKUN</strong></a></div>
                                <div class="col col-lg-6">
                                    <ul class="list-group">
                                    <?php $queryListAkun = selectData("SELECT namal, aktif FROM akun");
                                    while($listAkun = mysqli_fetch_assoc($queryListAkun)){ ?>
                                        <li class="list-group-item">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <h6 class="mb-0"><strong><?=$listAkun['namal']?></strong></h6>
                                                <?php if($listAkun['aktif'] == '1'){ ?>
                                                    <span class="text-xs text-success">AKTIF</span></div>
                                                <?php }else{ ?>
                                                    <span class="text-xs text-danger">TIDAK AKTIF</span></div>
                                                <?php } ?>
                                                <div class="col-auto"><i class="fa fa-user-circle-o"></i></div>
                                            </div>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
    </div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>
</html>