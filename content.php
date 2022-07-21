<?php
require 'function.php';

if(isset($_GET['print'])){
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
    <link rel="icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <style type="text/css" media="print">
        @page { size: landscape; }
    </style>
</head>
<body style="height: unset;">
    <header>
        <img src="assets/img/headerprint.png" style="max-width: 100%;" class="mb-4"></header>
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>
</html>
<script> window.print(); </script>
<?php }else{

require 'header.php';
?>
<body>
	<div class="body">
		<nav class="navbar navbar-light navbar-expand-md fixed-top navigation-clean-search">
	        <div class="container"><a class="navbar-brand" href="index.php">KASUARI CARGO</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
	            <div class="collapse navbar-collapse"
	                id="navcol-1">
	                <ul class="nav navbar-nav ml-auto">
	                    <li class="nav-item" role="presentation"><a class="nav-link btnlink" href="index.php">Login User</a></li>
	                    <li class="nav-item" role="presentation">
	                        <form class="form-inline mr-auto" target="_self">
	                            <div class="form-group"><input class="form-control search-field" type="search" id="search-field" name="search" placeholder="Cari .."><button id="btnSearch" class="btn text-white" type="button" style="margin: 0px;padding: 0.455rem 0.75rem;"><i class="fa fa-search"></i></button></div>
	                        </form>
	                    </li>
	                </ul>
	            </div>
	        </div>
	    </nav>

<?php if(isset($_GET['q'])){
	$key = explode("_", $_GET['q']);
	$qTgl = $key[1];
	$qKota = $key[0];
	$qKarung = $key[2]; ?>
<div class="bg-white data-table mr-4 ml-4 mt-4 mb-4">
<script> document.getElementsByClassName("body")[0].style.padding = "100px 0"; </script>
	<div class="row d-flex flex-row-reverse justify-content-start mt-4">
		<div class="col-auto mr-4">
			<a class='btn btn-sm btnlink2 ml-4' target="_blank" rel="noopener noreferrer" href='content.php?print=<?=$qKota?>_<?=$qTgl?>_<?=$qKarung?>' role='button'><i class='fa fa-print fa-sm'></i> Print</a>
			<a class='btn btn-sm btnlink2 ml-4' href='#' onclick="window.history.back();" role='button'><i class='fa fa-mail-reply fa-sm'></i> Kembali</a>
		</div>
	</div>
	<div class="row">
		<div class="col-auto mr-2"><p class="ml-4 mr-4 text-center">Kota <?=$qKota?></p></div>
		<div class="col-auto mr-2"><p class="ml-4 mr-4 text-center">Tanggal <?=$qTgl?></p></div>
		<div class="col-auto"><p class="ml-4 mr-4 text-center">Karung : <?=$qKarung?></p></div>
	</div>
<div class="table-responsive mt-4">
	<table class="table">
        <thead><tr>
        	<th>No</th><th>Nama Penerima</th><th>No. Hp</th><th>Jumlah Paket</th><th>Berat (kg)</th><th>Ket.</th>
        </tr></thead>
        <tbody>
        <?php
        $keyTgl = selectData("SELECT nama, nohp, jmlpaket, berat, ket FROM barang WHERE tgl='$qTgl' AND kota='$qKota' AND karung='$qKarung'");
        $no=1;
		while($cariTgl = mysqli_fetch_assoc($keyTgl)){ ?>
			<tr>
				<td><?=$no?></td><td><?=$cariTgl['nama']?></td><td><?=$cariTgl['nohp']?></td><td><?=$cariTgl['jmlpaket']?></td><td><?=$cariTgl['berat']?></td><td><?=$cariTgl['ket']?></td>
			</tr>
		<?php $no++; } ?>
        </tbody>
    </table>
</div>
</div>

<?php }else{ ?>
<div class="row d-flex flex-row justify-content-center align-items-lg-center" style="margin-right:0;margin-left:0; height:100%;">
<div class="col col-lg-5 col-md-5 col-sm-12 mr-4 ml-4 mb-4 align-self-stretch formBody"><div class="mt-4 mb-4 ml-4 mr-4">
	<form method="post" class="mb-4">
		<p class="text-black-50 text-center">Cari berdasarkan <strong>Nama</strong></p>
		<div class="input-group"><input type="text" class="form-control" name="qNama" />
			<div class="input-group-append"><button class="btn btnprimary" type="submit" name="cariNama">Cari</button></div>
		</div>
	</form>
	<?php if(isset($_POST['cariNama'])){
		$linkNama = $_POST['qNama']; ?>
		<script> document.getElementsByName("qNama")[0].value = "<?=$linkNama?>"; </script>
		<?php $keyNama = selectData("SELECT DISTINCT tgl, kota, karung FROM barang WHERE nama LIKE '$linkNama%' ORDER BY tgl DESC");
		if(mysqli_num_rows($keyNama) > 0){ ?>
			<p class="text-black-50 text-center">Nama "<?=$linkNama?>" muncul pada <strong>Tabel</strong> berikut.</p><ol>
			<?php while($cariNama = mysqli_fetch_assoc($keyNama)){ ?>
				<li><a class="mainlink text-black-50" href="content.php?q=<?=$cariNama['kota']?>_<?=$cariNama['tgl']?>_<?=$cariNama['karung']?>">Kota <?=$cariNama['kota'].", ".$cariNama['tgl']." karung ke-".$cariNama['karung']?></a></li>

			<?php } echo "</ol>";
		}else{ ?><p class="text-black-50 text-center">Tidak ditemukan data terkait <strong><?=$linkNama?></strong></p> <?php }
	} else if(isset($_GET['qNama'])){
		$linkNama = $_GET['qNama']; ?>
		<script> document.getElementsByName("qNama")[0].value = "<?=$linkNama?>"; </script>
		<?php $keyNama = selectData("SELECT DISTINCT tgl, kota, karung FROM barang WHERE nama LIKE '$linkNama%' ORDER BY tgl DESC");
		if(mysqli_num_rows($keyNama) > 0){ ?>
			<p class="text-black-50 text-center">Nama "<?=$linkNama?>" muncul pada <strong>Tabel</strong> berikut.</p><ol>
			<?php while($cariNama = mysqli_fetch_assoc($keyNama)){ ?>
				<li><a class="mainlink text-black-50" href="content.php?q=<?=$cariNama['kota']?>_<?=$cariNama['tgl']?>_<?=$cariNama['karung']?>">Kota <?=$cariNama['kota'].", ".$cariNama['tgl']." karung ke-".$cariNama['karung']?></a></li>

			<?php } echo "</ol>";
		}else{ ?><p class="text-black-50 text-center">Tidak ditemukan data terkait <strong><?=$linkNama?></strong></p> <?php }
	} ?>
</div></div>
<div class="col col-lg-6 col-md-6 col-sm-6 mr-4 ml-4 mb-4 formBody"><div class="mt-4 mb-4 ml-4 mr-4">
		<div id="formTgl1" class="formTgl"><form method="post">
			<p class="text-black-50 text-center">Cari berdasarkan <strong>Tabel</strong></p>
			<div class="input-group mb-4">
				<div class="input-group-prepend"><span class="input-group-text">Kota</span></div><input id="qKota" type="text" class="form-control" name="qKota" />
			</div>
			<div class="input-group mb-4">
				<div class="input-group-prepend"><span class="input-group-text">Tanggal</span></div><input id="qTgl" class="form-control" type="date" name="qTgl" />
			</div>
			<div class="form-row">
				<div class="col-8">
					<div class="input-group">
						<div class="input-group-prepend"><span class="input-group-text">Karung</span></div><input id="qKarung" type="text" class="form-control" name="qKarung" />
					</div>
				</div>
				<div class="col-4 text-right"><button type="button" class="btn btnprimary" name="cariTgl" onclick="cariTglSub();">Cari</button></div>
			</div></form>
			<button class="toggleFormTgl btn btnlink">Lihat list Tanggal Pengiriman</button>
		</div>
		<div id="formTgl2" class="formTgl hideForm">
			<p class="text-black-50 text-center"><strong>List Tanggal Pengiriman Barang</strong></p><ol>
			<?php $queryList = selectData("SELECT DISTINCT tgl, kota, karung FROM barang ORDER BY tgl DESC");
			while($dataList = mysqli_fetch_assoc($queryList)){ ?>
				<li><a class="mainlink text-black-50" href="content.php?q=<?=$dataList['kota']?>_<?=$dataList['tgl']?>_<?=$dataList['karung']?>">Kota <?=$dataList['kota'].", ".$dataList['tgl']." karung ke-".$dataList['karung']?></a></li>
			<?php } echo "</ol>"; ?>
			<button class="toggleFormTgl btn btnlink">Kembali</button>
		</div>
</div></div>
</div>
<?php } ?>

	</div>
	<footer class="bg-white sticky-footer mt-4"><div class="container my-auto">
		<div class="text-center my-auto copyright"><span>Copyright © Kasuari Cargo 2020</span></div></div>
	</footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>
</html>
<?php } ?>