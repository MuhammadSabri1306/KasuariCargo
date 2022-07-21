<?php
session_start();

require 'assets/func/function.php';
ceklogin();

if(isset($_GET['q'])){
    $key = $_GET['q'];
    $keyArr = explode("_", $key);
    if($keyArr[0] == "user"){
        $key = $keyArr[1];
        $keyquery = selectData("SELECT id, tgl, kota, karung, nama, nohp, jmlpaket, berat, ket, akun FROM barang WHERE userid='$key' ORDER BY tgl DESC");
    }else if($keyArr[0] == "tgl"){
        $keyquery = selectData("SELECT DISTINCT tgl, kota, karung FROM barang ORDER BY tgl DESC");
    }else{
        $keyquery = selectData("SELECT id, tgl, kota, karung, nama, nohp, jmlpaket, berat, ket, akun FROM barang WHERE tgl LIKE '$key%' OR kota LIKE '$key%' OR karung LIKE '$key%' OR nama LIKE '$key%' OR nohp LIKE '$key%' OR jmlpaket LIKE '$key%' OR berat LIKE '$key%' OR ket LIKE '$key%' OR akun LIKE '$key%' ORDER BY tgl DESC");
    }
$page = "datafilter";

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
require 'header.php';
?>

<body id="page-top">
    <?php require 'topnav.php';
    require 'docpanel.php';?>
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
<?php if(mysqli_num_rows($keyquery)>0){ ?>

<script> document.getElementsByName("search")[0].value = "<?=$key?>"; </script>
<a class="btn-sm mb-4 ml-4 text-secondary" href="pengiriman.php">Kembali ke Menu Utama</a>
    <?php
    $no=1;
    if($keyArr[0] == "tgl"){
        echo "<div class='mt-2 mb-4'>";
        while($keydata = mysqli_fetch_assoc($keyquery))
        {
            $filterTgl = $keydata['kota']."_".$keydata['tgl']."_".$keydata['karung'] ?>
            <div class="row">
                <div class="col mb-2">
                    <a class="btn-sm text-secondary" href="pengiriman.php?filter=<?=$filterTgl?>"><strong>
                        <?php echo $no.". ".$keydata['tgl'].", ".$keydata['kota']." Karung ".$keydata['karung']; ?>
                    </strong></a>
                </div>
            </div>
        <?php $no++; }
    echo "</div>"; }else{ ?>
<div class="table-responsive"><form method="post">
    <table class="table mt-4">
        <thead>
            <tr>
            <?php if($keyArr[0] == "tgl"){ ?>
                <th>No</th><th>Tanggal</th><th>Kota</th><th>Karung</th>
            <?php }else{ ?>
                <th><input id="checkAll" class="check" type="checkbox"></th><th>No</th>
                <th>Tanggal</th><th>Kota</th><th>Karung</th>
                <th>Nama Penerima</th><th>No. HP</th><th>Jumlah Paket</th><th>Berat (kg)</th><th>Ket</th><th>Diinput oleh</th>
            <?php } ?>
            </tr>
        </thead>
        <tbody>
        <?php while($keydata = mysqli_fetch_assoc($keyquery)){ ?>
            <tr>
                <td><input class="check" type="checkbox" name="id[]" value="<?=$keydata['id']?>"></td>
                <td><?=$no?></td>
                <td><?=$keydata['tgl']?></td>
                <td><?=$keydata['kota']?></td>
                <td><?=$keydata['karung']?></td>
                <td><?=$keydata['nama']?></td>
                <td><?=$keydata['nohp']?></td>
                <td><?=$keydata['jmlpaket']?></td>
                <td><?=$keydata['berat']?></td>
                <td><?=$keydata['ket']?></td>
                <td><?=$keydata['akun']?></td>
            </tr>
        <?php $no++;
        } ?>
        </tbody>
    </table>
    <input id="hapusData" type="submit" onclick='return askDel("data")' name="hapusData" value="hapus" style="display: none;">
</form></div>
<?php }}else{ echo "<h1 class='ml-4 mt-4 mr-4 mb-4'>Tidak ditemukan data yang dicari!!</h1>"; }?>

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
</body>
</html>

<?php }else if(isset($_GET['print'])){ 
$page = "printpage";
$print = explode("_", $_GET['print']);
$printKota = $print[0];
$printTgl = $print[1];
$printKarung = $print[2];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>KASUARI CARGO</title>
    <link rel="icon" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
    <script> var page = "<?=$page?>"; </script>
    <style type="text/css" media="print">
        @page { size: landscape; }
    </style>
</head>
<body>
    <header>
        <img src="../assets/img/headerprint.png" style="max-width: 100%;" class="mb-4"></header>
    <main>
        
        <div class="row justify-content-start justify-content-sm-start mt-4">
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 align-self-center text-center mb-4">
                <strong><?=$printKota?> <i class="fa fa-long-arrow-right"></i> Timika</strong>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 align-self-center text-center mb-4">
                <strong>Tanggal <?=$printTgl?></strong>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 align-self-center text-center mb-4">
                <strong>Karung <?=$printKarung?></strong>
            </div>
        </div>


        <div style="padding: 0 60px;"><div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th><th>Nama Penerima</th><th>No. HP</th><th>Jumlah Paket</th><th>Berat (kg)</th><th>Ket</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = selectData("SELECT nama, nohp, jmlpaket, berat, ket FROM barang WHERE kota='$printKota' AND tgl='$printTgl' AND karung='$printKarung'");
                $no = 1;
                while($data = mysqli_fetch_assoc($query)){ ?>
                    <tr>
                        <td><?=$no?></td>
                        <td><?=$data['nama']?></td>
                        <td><?=$data['nohp']?></td>
                        <td><?=$data['jmlpaket']?></td>
                        <td><?=$data['berat']?></td>
                        <td><?=$data['ket']?></td>
                    </tr>
                <?php $no++; } ?>
                </tbody>
            </table>
        </div></div>


    </main>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
<script> window.print(); </script>
<?php }else if(isset($_GET['backup'])){
$filename = "Kasuari-".date("y-m-d");
$tgl = date("Y-m-d");
dbAct("UPDATE backup SET namefile='$filename', tgl='$tgl' WHERE id='1'");
header("Conten-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$filename.xls");
$queryBackup = selectData("SELECT * FROM barang"); ?>
<table>
    <thead>
        <tr>
            <th>id</th><th>tgl</th><th>kota</th><th>karung</th><th>nama</th><th>nohp</th><th>jmlpaket</th><th>berat</th><th>ket</th><th>akun</th><th>userid</th>
        </tr>
    </thead>
    <tbody>
    <?php while($dataBackup = mysqli_fetch_array($queryBackup)){ ?>
        <tr>
            <td><?=$dataBackup[0]?></td>
            <td><?=$dataBackup[1]?></td>
            <td><?=$dataBackup[2]?></td>
            <td><?=$dataBackup[3]?></td>
            <td><?=$dataBackup[4]?></td>
            <td><?=$dataBackup[5]?></td>
            <td><?=$dataBackup[6]?></td>
            <td><?=$dataBackup[7]?></td>
            <td><?=$dataBackup[8]?></td>
            <td><?=$dataBackup[9]?></td>
            <td><?=$dataBackup[10]?></td>
        </tr> <?php } ?>
    </tbody>
</table>
<?php }else{ header("location:pengiriman.php"); } ?>