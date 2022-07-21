<?php
if(!isset($dpCari)){ $dpCari = true; }

$dpDivider = "<div class='d-none d-block topbar-divider' style='margin-right: calc(1rem - 12px);'></div>";
$dpInput = "<a class='btn btn-success btn-sm d-sm-inline-block doc-panel' role='button' href='input_pengiriman.php'><i class='fas fa-plus-circle fa-sm text-white-50'></i> Input</a>";
$dpPrint = "<button class='btn btn-info btn-sm d-sm-inline-block doc-panel' onclick='printData()' role='button'><i class='fas fa-print fa-sm text-white-50'></i> Print</button>";
$dpEdit = "<button class='btn btn-purple btn-sm d-sm-inline-block doc-panel' role='button' onclick='askEdit()'><i class='fas fa-edit fa-sm text-white-50'></i> Edit</button>";
$dpHapus = "";
if($_SESSION['status'] == "admin"){
	$dpHapus = "<button class='btn btn-warning btn-sm d-sm-inline-block doc-panel' role='button' onclick='return askDelData()'><i class='fas fa-trash fa-sm text-white-50'></i> Hapus</button>";
}
$dpSimpanInput = "<button id='btnSimpanData' class='btn btn-success btn-sm d-sm-inline-block doc-panel' role='button' onclick='return cekFormInputData()'><i class='fas fa-plus-circle fa-sm text-white-50'></i> Simpan</button>";
$dpSimpanEdit = "<button id='btnSimpanData' class='btn btn-success btn-sm d-sm-inline-block doc-panel' role='button' onclick='editData()'><i class='fas fa-plus-circle fa-sm text-white-50'></i> Simpan</button>";
$dpBuang = "<a id='btnBuangData' class='btn btn-warning btn-sm d-sm-inline-block doc-panel' role='button' href='pengiriman.php' onclick='return buangInputData()'><i class='fas fa-trash fa-sm text-white-50'></i> Keluar</a>";
if($_SESSION['status'] == "admin"){
	$dpDB = "<div class='d-flex justify-content-center'>
			<a class='docHover btn btn-info btn-sm d-sm-inline-block d-flex flex-row align-items-center' href='#' role='button' id='dataBase' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-database fa-sm text-white-50'></i><span style='margin-left: 3px; margin-right: 3px;'>Database</span><i class='fas fa-caret-down fa-sm text-white'></i></a>
			<div class='position-absolute docdropdown flex-column'>
				<a class='btn btn-purple btn-sm btn-block' href='datafilter.php?backup=0'><i class='fas fa-archive fa-sm text-white-50'></i> Backup Database</a>
				<a class='btn btn-danger btn-sm btn-block text-white' href='hapus.php?kosong=0'><i class='fas fa-warning fa-sm text-white-50'></i> Kosongkan Data</a>
			</div></div>";
}else{
	$dpDB = "<a class='btn btn-info btn-sm d-sm-inline-block doc-panel' role='button' href='datafilter.php?backup=0'><i class='fas fa-archive fa-sm text-white-50'></i> Backup Database</a>";
}

if(isset($_POST['btnSearch'])){ header("location:datafilter.php?q=".$_POST['search']); }
?>

<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar sticky-top">
	<div id="docpanel" class="container-fluid" style="overflow-x: auto; overflow-y: hidden;">
			<form method="post" class="form-inline d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
				<div class="input-group">
					<input class="bg-light form-control border-0 small" type="text" name="search" placeholder="Cari data ..." <?php if($dpCari === false){ echo "disabled='true'"; }?> />
					<div class="input-group-append"><button class="btn btn-primary py-0" type="submit" name="btnSearch" <?php if($dpCari === false){ echo "disabled='true'"; }?>><i class="fas fa-search"></i></button></div>
				</div>
			</form>

		<?php
		if ($page == 'pengiriman'){ echo $dpPrint.$dpDivider.$dpInput.$dpEdit.$dpHapus.$dpDivider.$dpDB; }
		else if ($page == 'pengiriman-modInput'){ echo $dpSimpanInput.$dpDivider.$dpBuang; }
		else if ($page == 'pengiriman-modEdit'){ echo $dpSimpanEdit.$dpDivider.$dpBuang; }
		else if ($page == 'datafilter'){ echo $dpInput.$dpEdit.$dpHapus.$dpDivider.$dpDB; }
		?>
	</div>
</nav>