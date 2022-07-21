<?php
require 'assets/func/function.php';
ceklogin();
if($_SESSION['status'] == "user"){
	header("location:index.php");
}else{
	if(isset($_GET['data'])){
		$query = "DELETE from barang WHERE id IN ".$_GET['data'];
		dbAct($query, "pengiriman.php");
	}else if(isset($_GET['user'])){
		$query = "DELETE FROM akun WHERE id='".$_GET['user']."'";
		dbAct($query, "akun_manage.php");
	}else if(isset($_GET['kosong'])){
		if($_GET['kosong'] == '0'){
			echo "<script>
					if(confirm('Data yang dihapus tidak akan dapat digunakan lagi. Lanjutkan?')){
						document.location.href = 'hapus.php?kosong=1';
					}
					else{
						document.history.back();
					}
				</script>";
		}else if($_GET['kosong'] == '1'){
			$query = "TRUNCATE TABLE barang";
			dbAct($query, "index.php");
		}
	}
}