<?php
session_start();
require 'assets/func/function.php';
ceklogin();

require 'header.php';
$dpCari = false;
$page = "pengiriman-modInput";

if(isset($_POST['btnFormSimpanData'])){
    $tgl = $_POST['tgl'];
    $kota = $_POST['kota'];
    $karung = $_POST['karung'];
    $nama = $_POST['nama'];
    if(empty($nama)){
        echo "<script> alert('Terdapat input yang kosong. Hapus baris tabel jika tidak perlu'); </script>";
    }else{
        $nohp = $_POST['nohp'];
        $jmlpaket = $_POST['jmlpaket'];
        $berat = $_POST['berat'];
        $ket = $_POST['ket'];
        $akun = $_SESSION['nama'];
        $jmlrow = count($nama);
        $query = "INSERT INTO barang (id, tgl, kota, karung, nama, nohp, jmlpaket, berat, ket, akun, userid) VALUES ";
        for($x=0; $x<$jmlrow; $x++){
            $id = idCreator();
            $query .= "('$id', '$tgl', '$kota', '$karung', '$nama[$x]', '$nohp[$x]', '$jmlpaket[$x]', '$berat[$x]', '$ket[$x]', '$akun', '".$_SESSION['userid']."')";
            if($x < $jmlrow-1){ $query .= ", "; }
        }
        dbAct($query, "pengiriman.php");
    }
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

<div class="row">
    <div class="col mb-4">
        <div class="card">
            <div class="card-header bg-light">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item ml-auto">
                        <a class="nav-link active" href="#">
                            <h5>Input Data Pengiriman Barang</h5>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">

<!-- modal input data -->
<script> var page = "<?=$page?>"; </script>
<div id="modalBuatTabel" role="dialog" tabindex="-1" class="modal fade show" style="display: block">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User : <?=$_SESSION['nama']?></h4>
            </div>
            <div class="modal-body">
            	<div class="input-group mb-4">
                    <div class="input-group-prepend"><span class="input-group-text">Kota</span></div><input id="inputKota" type="text" class="form-control" /></div>
                <div class="row">
                	<div class="col">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend"><label class="input-group-text" for="tglpengiriman">Tgl</label></div><input id="inputTgl" class="form-control" type="date" /></div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend"><label class="input-group-text" for="karung">Karung</label></div><input type="text" id="inputKarung" class="form-control" placeholder="1, 2, 3, dst .." /></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"><button id="btnBack" class="btn btn-light" type="button" onclick="redirectUrl('pengiriman.php')">Kembali</button><button id="btnBuatTabel" class="btn btn-primary" type="button">Buat Tabel</button></div>
        </div>
    </div>
</div>

<!-- tabel input data -->
<form method="post">
<div class="row">
	<div class="col col-md-6 mb-4 mt-4">
		<div class="input-group col-md-10"><div class="input-group-prepend"><span class="input-group-text">Kota</span></div><input type="text" id="formKota" type="text" class="form-control" name="kota" readonly /></div>
    </div>
    <div class="col col-md-4 mb-4 mt-4">
        <div class="input-group col-md-10"><div class="input-group-prepend"><span class="input-group-text">Tgl</span></div><input type="text" id="formTgl" type="text" class="form-control" name="tgl" readonly /></div>
    </div>
    <div class="col mb-4 mt-4">
    	<div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Karung</span></div><input type="text" id="formKarung" type="text" class="form-control" name="karung" readonly /></div>
    </div>
</div>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr><th>No</th><th>Nama Penerima</th><th>No. HP</th><th>Jumlah Paket</th><th>Berat (kg)</th><th>Ket</th></tr>
		</thead>
		<tbody class="tblInputKirim" id="tblInputKirim">
			<?php for($x=1; $x<=10; $x++){
				if($x==10){ echo "<tr class='rowTarget'>"; }
				else{ echo "<tr>"; } ?>
				<td><?=$x?></td>
				<td><input <?php if($x==1){ echo "id='colTarget'"; } ?> type="text" class="form-control-sm border-0" name="nama[]"/></td>
				<td><input type="text" class="form-control-sm border-0" name="nohp[]"/></td>
				<td><input type="text" class="form-control-sm border-0" name="jmlpaket[]"/></td>
				<td><input type="text" class="form-control-sm border-0" name="berat[]"/></td>
				<td><input type="text" class="form-control-sm border-0" name="ket[]"/></td>
			</tr>
			<?php } ?>
			<tr><td class="text-center" colspan="6">
				<button id="addRow" class="btn btn-light w-25 mr-2" type="button"><i class="fa fa-plus"></i></button><button id="remRow" class="btn btn-light w-25" type="button"><i class="fa fa-minus"></i></button>
			</td></tr>
		</tbody>
	</table>
</div>
<input type="submit" id="btnFormSimpanData" name="btnFormSimpanData" value="INPUT" style="display: none">
</form>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
