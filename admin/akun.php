<?php
session_start();
require 'assets/func/function.php';
ceklogin();
$page = "akun";
if(isset($_GET['act'])){
	if($_GET['act'] == "logout"){
		session_start();
		session_destroy();
		session_unset();
		header('location:../index.php');
	}else if($_GET['act'] == "hapus"){
		$idDel = $_SESSION['userid'];
		dbAct("DELETE from akun WHERE id='$idDel'", "pengiriman.php");
	}
}else{
require 'header.php';
$id = $_SESSION['userid'];
if(isset($_GET['warn'])){
    echo "<script>alert(Akun dengan Username $username sudah ada! Harap gunakan username lain.);</script>";
}

if(isset($_POST['btnSimpanAkun'])){
    $namal = $_POST['namal'];
    $namap = $_POST['namap'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $pass = passCreator($_POST['pass']);
    $pass_hash = passCreator($pass, "hash");
    $queryEdittProfil = "UPDATE akun SET username='$username', pass='$pass', pass_hash='$pass_hash', namal='$namal', namap='$namap', nohp='$nohp', alamat='$alamat' WHERE id='$id'";
    $queryCek = selectData("SELECT COUNT(username) AS countun FROM akun WHERE username='$username' and id!='$id'");
    $dataCek = mysqli_fetch_assoc($queryCek);
    if($dataCek['countun'] == "0"){
        dbAct($queryEdittProfil);
        unset($_SESSION['nama']);
        $_SESSION['nama'] = $namap;
        dbAct("UPDATE barang SET akun='$namap' WHERE userid='$id'", "akun.php");
    }else{
        echo "<script>alert('Username $username sudah ada! Harap gunakan key lain.');</script>";
    }
}

$data = mysqli_fetch_assoc(selectData("SELECT username, pass, namal, namap, alamat, nohp, status FROM akun WHERE id='$id'")); ?>
<script> var page = "<?=$page?>"; </script>
<body id="page-top">
    <?php require 'topnav.php'; ?>
    <div id="wrapper"><div class="d-flex flex-column" id="content-wrapper">
    	<div id="content"><div class="container-fluid mb-4">
    		<div class="d-sm-flex justify-content-between align-items-center mb-4 mt-4"><h3 class="text-dark mb-0">Edit Akun</h3></div>
    		<div class="row"><div class="col mb-4"><div class="row"><div class="col mb-4"><div class="card"><div style="flex: 1 1 auto; min-height: 1px; padding: 1.25rem;">

<div class="row mt-4">
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 text-center align-self-start mb-4"><i class="fa fa-user-circle-o" style="font-size: 150px;"></i><p class="mt-4 text-center"><small><i class="fa fa-info-circle"></i><i> Klik pada teks untuk mulai mengedit</i></small></p></div>
    <div class="col mb-4">
        <form method="post">
            <div class="form-row"><div class="col"><h4>Informasi Pribadi</h4></div>
            </div>
            <div class="mb-4 ml-2">
                <div class="form-row">
                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 d-lg-flex align-self-start align-items-lg-center"><input type="text" class="form-control border-0" value="Nama Lengkap" disabled style="background-color: rgb(255,255,255);" /><span class="mr-0">:</span></div>
                    <div class="col align-self-start mb-2">
                        <input type="text" class="inputEA form-control border-0" name="namal" value="<?=$data['namal']?>" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4 d-lg-flex align-self-start align-items-lg-center"><input type="text" class="form-control border-0" value="Nama Panggilan" disabled style="background-color: rgb(255,255,255);" /><span class="mr-0">:</span></div>
                    <div class="col align-self-start mb-2">
                        <input type="text" class="inputEA form-control border-0" name="namap" value="<?=$data['namap']?>" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4 d-lg-flex align-self-start align-items-lg-center"><input type="text" class="form-control border-0" value="Nomor Handphone" disabled style="background-color: rgb(255,255,255);" /><span class="mr-0">:</span></div>
                    <div class="col align-self-start mb-2">
                        <input type="text" class="inputEA form-control border-0" name="nohp" value="<?=$data['nohp']?>" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4 d-lg-flex align-self-start align-items-lg-center"><input type="text" class="form-control border-0" value="Alamat" disabled style="background-color: rgb(255,255,255);" /><span class="mr-0">:</span></div>
                    <div class="col align-self-start">
                        <textarea class="inputEA form-control d-lg-flex align-items-start align-items-lg-start border-0" rows="2" name="alamat"><?=$data['alamat']?></textarea>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <h3>Informasi Akun</h3>
                </div>
            </div>
            <div class="mb-4 ml-2">
                <div class="form-row">
                    <div class="col-4 d-lg-flex align-self-start align-items-lg-center"><input type="text" class="form-control border-0" value="Username" disabled style="background-color: rgb(255,255,255);" /><span class="mr-0">:</span></div>
                    <div class="col align-self-start mb-2">
                        <input type="text" class="inputEA form-control border-0" name="username" value="<?=$data['username']?>" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4 d-lg-flex align-self-start align-items-lg-center"><input type="text" class="inputEA form-control border-0" value="Password" disabled style="background-color: rgb(255,255,255);" /><span class="mr-0">:</span></div>
                    <div class="col align-self-start mb-2">
                        <div id="show-hide-password" class="input-group col-6">
                            <input type="password" class="inputEA form-control" name="pass" value="<?=$data['pass']?>" />
                            <div class="input-group-addon"><button class="btn btn-link text-black-50" type="button" style="background-color: #ffffff;"><i class="fa fa-eye-slash" aria-hidden="true"></i></button></div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4 d-lg-flex align-self-start align-items-lg-center"><input type="text" class="form-control border-0" value="Status" disabled style="background-color: rgb(255,255,255);" /><span class="mr-0">:</span></div>
                    <div class="col align-self-start mb-2">
                        <input type="text" class="inputEA form-control border-0" value="<?=$data['status']?>" disabled style="background-color: rgb(255,255,255);" />
                    </div>
                </div>
            </div>
            <div id="btnEditAkun" class="d-none justify-content-end justify-content-lg-end mb-4 mr-4"><input type="submit" class="btn btn-outline-primary mr-2" name="btnSimpanAkun" value="Simpan" /><button class="btn btn-link text-secondary mr-4" type="button" onclick="window.history.back()">Batal</button></div>
        </form>
    </div>
</div>

			</div></div></div></div></div></div>
        </div></div>
	<?php require 'footer.php'; ?>
	</div></div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
<?php }