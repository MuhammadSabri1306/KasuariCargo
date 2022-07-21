<?php
session_start();

require 'assets/func/function.php';
ceklogin();

$page = "pengiriman";

require 'header.php';

if(isset($_POST['hapusData'])){
    $idDelData = $_POST['id'];
    $idDel = "(";
    for($x = 0; $x < count($_POST['id']); $x++){
        $idDel .= "'".$_POST['id'][$x]."'";
        if($x+1 != count($_POST['id'])){
            $idDel .= ", ";
        }
    }
    $idDel .= ")";
    header("location:hapus.php?data=$idDel");
}
?>

<body id="page-top">
    <?php require 'topnav.php';
    require 'docpanel.php'; ?>
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4 mt-4">
                        <h3 class="text-dark mb-0">Data Pengiriman</h3>
                    </div>
                    <div class="row">
                        <div class="col mb-4">

                            <!-- tabel data -->
                            <div class="row">
                                <div class="col mb-4">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <ul class="nav nav-tabs card-header-tabs">
                                                <li class="nav-item ml-auto">
                                                    <a class="nav-link active" href="#">
                                                        <h5>Tabel Data Pengiriman Barang</h5>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
<!-- =========================================================== -->
<script> var page = "<?=$page?>"; </script>
<?php
$setdata = selectData("SELECT tgl, kota, karung FROM barang WHERE tgl IN (SELECT MAX(tgl) FROM barang) LIMIT 1");
$dataset = mysqli_fetch_assoc($setdata);
if(count($dataset) > 0){
    $valueKota = "value='".$dataset['kota']."'";
    $valueTgl = "value='".$dataset['tgl']."'";
    $valueKarung = "value='".$dataset['karung']."'";
    if(isset($_POST['filter'])){
        $valueKota = "value='".$_POST['kota']."'";
        $valueTgl = "value='".$_POST['tgl']."'";
        $valueKarung = "value='".$_POST['karung']."'";
    }
?>
<form class="form-inline" method="post">
    <div class="input-group input-group-sm mb-4 mr-2">
        <div class="input-group-prepend"><span class="input-group-text">Kota</span></div>
        <input type="text" id="kota" class="form-control col-md-8" name="kota" <?=$valueKota?> />
    </div>
    <div class="input-group input-group-sm mb-4 mr-2">
        <div class="input-group-prepend"><span class="input-group-text">Tgl</span></div>
        <input type="text" id="tgl" class="form-control col-md-8" name="tgl" <?=$valueTgl?> />
    </div>
    <div class="input-group input-group-sm mb-4">
        <div class="input-group-prepend"><span class="input-group-text">Karung</span></div>
        <input type="text" id="karung" class="form-control col-md-4" name="karung" <?=$valueKarung?> />
    </div>
    <input type="submit" class="btn btn-primary mb-4 mr-2" name="filter" value="Tampilkan" />
    <div class='d-none d-sm-block mb-4' style="width: 0; border-right: 1px solid #e3e6f0; height: 2.375rem; margin: auto 1rem;"></div>
    <a class="btn-sm mb-4 text-secondary" href="datafilter.php?q=tgl">Lihat list Tanggal Pengiriman</a>
    <!-- <input id="print" type="submit" name="print" value="PRINT" style="display: none;"> -->
</form>
<div class="table-responsive"><form method="post">
    <table class="table">
        <thead>
            <tr>
                <th><input id="checkAll" class="check" type="checkbox"></th>
                <th>No</th><th>Nama Penerima</th><th>No. HP</th><th>Jumlah Paket</th><th>Berat (kg)</th><th>Ket</th><th>Diinput oleh</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $no = 0;
    $filterOn = false;
    if(isset($_POST['filter'])){
        $filterOn = true;
        $filterQuery = filterQuery($_POST['tgl'], $_POST['kota'], $_POST['karung']);
        $query1 = selectData("SELECT id, nama, nohp, jmlpaket, berat, ket, akun FROM barang ".$filterQuery);
    }
    if(isset($_GET['filter'])){
        $filterOn = true;
        $filterQuery = explode("_", $_GET['filter']);
        $filterTgl = $filterQuery[1];
        $filterKota = $filterQuery[0];
        $filterKarung = $filterQuery[2];
        $query1 = selectData("SELECT id, nama, nohp, jmlpaket, berat, ket, akun FROM barang WHERE tgl='$filterTgl' AND kota='$filterKota' AND karung='$filterKarung' "); ?>
    <?php }
    if($filterOn){
        while($data1 = mysqli_fetch_assoc($query1)){ ?>
            <tr>
                <td><input class="check" type="checkbox" name="id[]" value="<?=$data1['id']?>"></td>
                <td><?=$no+1?></td>
                <td><?=$data1['nama']?></td>
                <td><?=$data1['nohp']?></td>
                <td><?=$data1['jmlpaket']?></td>
                <td><?=$data1['berat']?></td>
                <td><?=$data1['ket']?></td>
                <td><?=$data1['akun']?></td>
            </tr>
            <?php $no++;
        }
    }else{
        $kota = $dataset['kota'];
        $tgl = $dataset['tgl'];
        $karung = $dataset['karung'];
        $query = selectData("SELECT id, nama, nohp, jmlpaket, berat, ket, akun FROM barang WHERE kota='$kota' AND tgl='$tgl' AND karung='$karung' ORDER BY nama");
        while($data = mysqli_fetch_assoc($query)){ ?>
            <tr>
                <td><input class="check" type="checkbox" name="id[]" value="<?=$data['id']?>"></td>
                <td><?=$no+1?></td>
                <td><?=$data['nama']?></td>
                <td><?=$data['nohp']?></td>
                <td><?=$data['jmlpaket']?></td>
                <td><?=$data['berat']?></td>
                <td><?=$data['ket']?></td>
                <td><?=$data['akun']?></td>
            </tr>
        <?php $no++; }} ?>
        </tbody>
    </table>
    <input id="hapusData" type="submit" onclick='return askDel("data")' name="hapusData" value="hapus" style="display: none;">
</form></div>
<?php }else{ echo "<h1 class='ml-4 mt-4 mr-4 mb-4'>Data Pengiriman Barang kosong!!</h1>"; }?>

<!-- =========================================================== -->
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
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.js"></script>
<?php if(isset($_GET['filter'])){ ?>
    <script>getFilterData("<?=$filterKota?>", "<?=$filterTgl?>", "<?=$filterKarung?>");</script>
<?php }?>
</body>

</html>