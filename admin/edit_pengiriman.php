<?php
session_start();

require 'assets/func/function.php';
ceklogin();

if(!isset($_GET['id'])){ header("location:pengiriman.php"); }
$dpCari = false;
$page = "pengiriman-modEdit";
$id = $_GET['id'];

$data = mysqli_fetch_assoc(selectData("SELECT tgl, kota, karung, nama, nohp, jmlpaket, berat, ket, userid FROM barang WHERE id='$id'"));

if($_SESSION['userid'] != $data['userid']){
    echo "<script>
            alert('Anda hanya boleh mengedit data yang diinput dari Akun anda! Anda akan dialihkan ke halaman data yang diinput dari Akun anda');
            window.location = 'datafilter.php?q=user_".$_SESSION['userid']."';
        </script>";
}else{

if(isset($_POST['btnFormEditData'])){
    $nama = $_POST['nama'];
    $nohp = $_POST['nohp'];
    $jmlpaket = $_POST['jmlpaket'];
    $berat = $_POST['berat'];
    $ket = $_POST['ket'];
    dbAct("UPDATE barang SET nama='$nama', nohp='$nohp', jmlpaket='$jmlpaket', berat='$berat', ket='$ket' WHERE id='$id' ", "pengiriman.php");
}
require 'header.php';
?>
<script> var page = "<?=$page?>"; </script>
<body id="page-top">
<?php require 'topnav.php';
require 'docpanel.php';?>
<div id="wrapper"><div class="d-flex flex-column" id="content-wrapper"><div id="content">
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4 mt-4">
            <h3 class="text-dark mb-0">Data Pengiriman</h3>
        </div>
        <div class="row"><div class="col mb-4"><div class="row"><div class="col mb-4"><div class="card">
            <div class="card-header bg-light">
                <ul class="nav nav-tabs card-header-tabs"><li class="nav-item ml-auto">
                    <a class="nav-link active" href="#"><h5>Edit Data Pengiriman Barang</h5></a>
                </li></ul>
            </div>
            <div class="card-body">


<div class="row d-flex justify-content-center mb-4">
    <div class="col ml-4 mr-4 mt-4"><div class="card border-left-primary"><div class="card-body"><form>
            <label for="kota">Kota</label><input type="text" class="form-control mb-4" id="kota" value="<?=$data['kota']?>" readonly />
            <label for="tgl">Tanggal Pengiriman</label><input type="text" class="form-control mb-4" id="tgl" value="<?=$data['tgl']?>" readonly />
            <label for="karung">Karung</label><input type="text" class="form-control mb-4" id="karung" value="<?=$data['karung']?>" readonly />
    </form></div></div></div>
    <div class="col-8 mt-4 mb-4"><form method="post">
        <label for="nama">Nama Penerima</label>
        <input type="text" class="form-control form-control-sm" id="nama" name="nama" value="<?=$data['nama']?>" />
        <label class="mt-4" for="nohp">Nomor Handphone</label>
        <input type="text" class="form-control form-control-sm" id="nohp" name="nohp" value="<?=$data['nohp']?>" />
        <label class="mt-4" for="jmlpaket">Jumlah Paket</label>
        <input type="text" class="form-control form-control-sm" id="jmlpaket" name="jmlpaket" value="<?=$data['jmlpaket']?>" />
        <label class="mt-4" for="berat">Berat (Kg)</label>
        <input type="text" class="form-control form-control-sm" id="berat" name="berat" value="<?=$data['berat']?>" />
        <label class="mt-4" for="ket">Keterangan</label>
        <input type="text" class="form-control form-control-sm mb-4" id="ket" name="ket" value="<?=$data['ket']?>" />
        <input type="submit" id="btnFormEditData" name="btnFormEditData" value="EDIT" style="display: none">
    </form></div>
</div>


            </div>
        </div></div></div></div></div>
    </div>
</div><?php require 'footer.php'; ?></div></div>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/script.js"></script>
</body>

</html> <?php }