<?php

function ceklogin(){
	if(!isset($_SESSION['login'])){
		header('location:../index.php');
	}
}

function hari(){
	switch(date("l")){
		case 'Sunday': return "Minggu"; break;
		case 'Monday': return "Senin"; break;
		case 'Tuesday': return "Selasa"; break;
		case 'Wednesday': return "Rabu"; break;
		case 'Thursday': return "Kamis"; break;
		case 'Friday': return "Jumat"; break;
		case 'Saturday': return "Sabtu"; break;
	}
}

function tgl(){
	$tgl = date("d");
	$thn = date("Y");
	switch(date("m")){
		case '01': $bln = "Januari"; break;
		case '02': $bln = "Februari"; break;
		case '03': $bln = "Maret"; break;
		case '04': $bln = "April"; break;
		case '05': $bln = "Mei"; break;
		case '06': $bln = "Juni"; break;
		case '07': $bln = "Juli"; break;
		case '08': $bln = "Agustus"; break;
		case '09': $bln = "September"; break;
		case '10': $bln = "Oktober"; break;
		case '11': $bln = "November"; break;
		case '12': $bln = "Desember"; break;
		default: $bln = "Januari"; break;
	}
	return $tgl." ".$bln." ".$thn;
}

function grafikKirim(){
	$makassar = "";
	$jakarta = "";
	$surabaya = "";
	$malang = "";
	$query = selectData("SELECT kota, count(*) AS jumlah FROM barang GROUP BY kota");
	while($kota = mysqli_fetch_assoc($query)){
		if($kota['kota'] == "Makassar" || $kota['kota'] == "makassar"){
			$makassar = $kota['jumlah'];
		}else if($kota['kota'] == "Jakarta" || $kota['kota'] == "jakarta"){
			$jakarta = $kota['jumlah'];
		}else if($kota['kota'] == "Surabaya" || $kota['kota'] == "surabaya"){
			$surabaya = $kota['jumlah'];
		}else if($kota['kota'] == "Malang" || $kota['kota'] == "malang"){
			$malang = $kota['jumlah'];
		}
	}
	if($makassar == ""){ $makassar = 0; }
	if($jakarta == ""){ $jakarta = 0; }
	if($surabaya == ""){ $surabaya = 0; }
	if($malang == ""){ $malang = 0; }
	// $makassar = 50;
	// $jakarta = 30;
	// $surabaya = 15;
	// $malang = 7;

	return "<canvas data-bs-chart='{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Makassar&quot;,&quot;Jakarta&quot;,&quot;Surabaya&quot;,&quot;Malang&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Kota&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#1cc88a&quot;,&quot;#36b9cc&quot;,&quot;#f6c23e&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;".$makassar."&quot;,&quot;".$jakarta."&quot;,&quot;".$surabaya."&quot;,&quot;".$malang."&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{}}}'></canvas>";
}

function idCreator(){
	$kar = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	$karArray = str_split($kar);
	$kode = '';
	for($i=0; $i<8; $i++){
		$randItem = array_rand($karArray);
		$kode .= $karArray[$randItem];
	}

	return date("y").date("m").date("d").$kode;
}

function dbAct($query, $url=""){
	require 'koneksi.php';
	$exc = mysqli_query($con, $query);
	if(!$exc){
		echo "<script>alert('Gagal terhubung ke Database! Periksa konfigurasi database dan struktur direktori Web anda');</script>";
	}
	if($url != ""){ header("location:$url"); }
}

function selectData($query){
	require 'koneksi.php';
	return mysqli_query($con, $query);
}

function filterQuery($tgl, $kota, $karung){
	if($tgl && $kota && $karung){
		return "WHERE tgl='$tgl' AND kota='$kota' AND karung='$karung'";
	}else if($tgl && $kota && !$karung){
		return "WHERE tgl='$tgl' AND kota='$kota''";
	}else if($tgl && !$kota && $karung){
		return "WHERE tgl='$tgl' AND karung='$karung'";
	}else if(!$tgl && $kota && $karung){
		return "WHERE kota='$kota' AND karung='$karung'";
	}else if($tgl && !$kota && !$karung){
		return "WHERE tgl='$tgl'";
	}else if(!$tgl && $kota && !$karung){
		return "WHERE kota='$kota'";
	}else if(!$tgl && !$kota && $karung){
		return "WHERE karung='$karung'";
	}else{
		return "";
	}
}

function passCreator($pass, $tipe="normal"){
	require 'koneksi.php';
	if($tipe == "normal"){
		return mysqli_real_escape_string($con, $pass);
	}
	else{
		return password_hash($pass, PASSWORD_DEFAULT);
	}
}

function cekTglBackup(){
	$query = selectData("SELECT tgl, waktu FROM backup");
	$tglBackup = mysqli_fetch_array($query);
	$x = date_create($tglBackup[0]);
	$y = date_create(date("Y-m-d"));
	$cekTglBackup = date_diff($x, $y);
	if ($cekTglBackup->format("%d") > $tglBackup[1]){ ?>
<div class="row"><div class="col-sm-5 col-lg-5 col-xl-4">&nbsp;</div><div class="col col-lg-7 col-xl-8">
	<div class="card shadow mb-4"><div class="card-header d-flex justify-content-between align-items-center">
		<h6 class="text-primary font-weight-bold m-0">Backup Database Anda!</h6><button class="btn border-circle dashboard-btn" type="button"><i class="fa fa-caret-down"></i></button>
	</div><div class="card-body"><div class="row"><div class="col-3 text-center"><i class="fa fa-exclamation-triangle backup"></i></div><div class="col mr-4"><p class="text-justify">Backup database perlu dilakukan untuk mencegah anda kehilangan data yang penting. <a class="text-success" href="datafilter.php?backup=0">Backup Database Saya</a></p>

	<?php if($_SESSION['status'] == "admin"){ ?>
			<p>Ingin mengubah waktu <strong>Pengingat Backup</strong> ?</p>
			<a class="text-primary cur-pointer" data-toggle="modal" data-target="#settimer">Set Timer Backup</a>
<?php } ?> 
</div></div>
<div id="settimer" role="dialog" tabindex="-1" class="modal fade" aria-labelledby="lblSetTimer" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><form method="post"><div class="modal-header"><h4 id="lblSetTimer" class="modal-title">Set Timer Backup</h4></div>
	<div class="modal-body"><div class="input-group mb-4"><div class="input-group-prepend"><span class="input-group-text">Timer (Hari)</span></div>
	<input name="timer" type="text" class="form-control" placeholder="Masukkan angka" value="<?=$tglBackup[1]?>" />
</div></div>
<div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Kembali</button><button class="btn btn-primary" type="submit" name="setTimer">OK!</button></div></form></div></div></div>
</div></div></div></div>
<?php }
}