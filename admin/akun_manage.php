<?php
session_start();

require 'assets/func/function.php';
ceklogin();
if($_SESSION['status'] != "admin"){
	echo "<script> window.history.back(); </script>";
}else{

if(isset($_GET['toggle0'])){
	$toggleId = $_GET['toggle0'];
	$toggle = dbAct("UPDATE akun SET aktif='0' WHERE id='$toggleId'");
	header("location:akun_manage.php");
}else if(isset($_GET['toggle1'])){
	$toggleId = $_GET['toggle1'];
	$toggle = dbAct("UPDATE akun SET aktif='1' WHERE id='$toggleId'");
	header("location:akun_manage.php");
}else{
require 'header.php';
$page = "akun";

if(isset($_POST['simpanAkun'])){
	$namal = $_POST['formNamal'];
    $namap = $_POST['formNamap'];
    $nohp = $_POST['formNohp'];
    $alamat = $_POST['formAlamat'];
    $username = $_POST['formUsername'];
    $pass = passCreator($_POST['formPass']);
    $pass_hash = passCreator($pass, "hash");

    dbAct("INSERT INTO akun(username, pass, pass_hash, namal, namap, nohp, alamat, status, aktif) VALUES ('$username', '$pass', '$pass_hash', '$namal', '$namap', '$nohp', '$alamat', 'user', '1')", "akun_manage.php");
}
?>
<script> var page = "<?=$page?>"; </script>
<body id="page-top">
    <?php require 'topnav.php'; ?>
    <div id="wrapper"><div class="d-flex flex-column" id="content-wrapper"><div id="content"><div class="container-fluid">
    	<div class="d-sm-flex justify-content-between align-items-center mb-4 mt-4">
    		<h3 class="text-dark mb-0">Manajemen Akun</h3>
    	</div>
    	<div class="row"><div class="col mb-4"><div class="row"><div class="col mb-4"><div class="card">
    		<div class="card-header bg-light"><ul class="nav nav-tabs card-header-tabs"><li class="nav-item ml-auto">
    			<a class="nav-link active" href="#"><h5>Daftar Akun</h5></a>
    		</li></ul></div>
    		<div class="card-body">

<!-- button modal tambah dan pass -->
<div class="row"><div class="col ml-4 mb-4">
	<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#formTbh"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Buat Akun</button>
	<button type="button" class="btn btn-sm btn-light border" data-toggle="modal" data-target="#modalpass"><i class="fas fa-key fa-sm text-black-50"></i> Password</button>
</div></div>

<!-- modal tambah -->
<div class="modal fade" id="formTbh" tabindex="-1" role="dialog" aria-labelledby="tbhAkun" aria-hidden="true"><div class="modal-dialog" role="document">
	<div class="modal-content"><form method="post">
		<div class="modal-header"><h4 class="modal-title" id="tbhAkun">Form Buat Akun</h4></div>
		<div class="modal-body" style="padding: 1rem 2rem;">
			<div class="form-group">
				<label for="formNamal" class="col-form-label">Nama Lengkap</label>
				<input type="text" class="form-control" id="formNamal" name="formNamal">
			</div>
			<div class="form-group">
				<label for="formNamap" class="col-form-label">Nama Panggilan</label>
				<input type="text" class="form-control" id="formNamap" name="formNamap">
			</div>
			<div class="form-group">
				<label for="formNohp" class="col-form-label">No. Handphone</label>
				<input type="text" class="form-control" id="formNohp" name="formNohp">
			</div>
			<div class="form-group">
				<label for="formAlamat" class="col-form-label">Alamat</label>
				<textarea class="form-control" id="formAlamat" name="formAlamat" rows="2"></textarea>
			</div>
			<div class="form-group">
				<label for="formUsername" class="col-form-label">Username</label>
				<input type="text" class="form-control" id="formUsername" name="formUsername" placeholder="Klik Generate">
			</div>
			<div class="form-group">
				<label for="formPass" class="col-form-label">Password</label>
				<input type="text" class="form-control" id="formPass" name="formPass" placeholder="Klik Generate">
			</div>

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-light" data-dismiss="modal">Kembali</button>
			<input type="submit" class="btn btn-primary" name="simpanAkun" value="Buat">
		</div>
	</form></div>
</div></div>

<!-- modal pass -->
<div class="modal fade" id="modalpass" tabindex="-1" role="dialog" aria-labelledby="passAkun" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content">
	<div class="modal-header"><h4 class="modal-title" id="passAkun">Password Akun</h4></div>
	<div class="modal-body" style="padding: 1rem 2rem;">
		<div class="table-responsive"><table class="table">
			<thead><tr>
				<th>No</th><th>Username</th><th>Password</th>
			</tr></thead>
			<tbody><form>
			<?php $no = 1;
			$query1 = selectData("SELECT username, pass FROM akun");
			while($data1 = mysqli_fetch_assoc($query1)){ ?>
				<tr>
					<td><?=$no?></td>
					<td><input type="text" class="form-control border-0" value="<?=$data1['username']?>" disabled style="background-color: #ffffff;" /></td>
					<td><div id="passField" class="input-group">
						<input type="password" class="form-control" value="<?=$data1['pass']?>" />
						<div class="input-group-addon"><button class="passBtn btn btn-link text-black-50" type="button" style="background-color: #ffffff;"><i class="fa fa-eye-slash" aria-hidden="true"></i></button></div>
                    </div></td>
				</tr>
			<?php $no++; } ?>
			</form></tbody>
		</table></div>
	</div>
	<div class="modal-footer"><button type="button" class="btn btn-light" data-dismiss="modal">Kembali</button></div>
</div></div></div>

<!-- tabel daftar akun -->
<div class="table-responsive"><table class="table">
	<thead><tr>
		<th>No</th><th>Username</th><th>Nama</th><th>Nama Lengkap</th><th>Alamat</th><th>No. Hp</th><th>Status</th><th></th>
	</tr></thead>
	<tbody>
	<?php
	$query = selectData("SELECT id, username, namal, namap, alamat, nohp, status, aktif FROM akun");
	$no = 1;
	while($data = mysqli_fetch_assoc($query)){ ?>
		<tr>
			<td><?=$no?></td><td><?=$data['username']?></td><td><?=$data['namap']?></td><td><?=$data['namal']?></td>
			<td><?=$data['alamat']?></td><td><?=$data['nohp']?></td><td><?=$data['status']?></td>
			<td>
			<?php
			if($_SESSION['status'] == "admin"){
				if($data['status'] != "admin"){
					if($data['aktif'] == 1){
						echo "<a class='btn btn-success border btn-sm d-sm-inline-block' role='button' href='akun_manage.php?toggle0=".$data['id']."'>Aktif</a>";
					}else{
						echo "<a class='btn btn-light btn-sm d-sm-inline-block' role='button' href='akun_manage.php?toggle1=".$data['id']."'>Mati</a>";
					} ?>
					<a class="btn btn-danger btn-sm d-sm-inline-block ml-2" role="button" href="hapus.php?user=<?=$data['id']?>" onclick="return askDel('akun')">Hapus</a>
			<?php }}else{
				if($data['aktif'] == 1){
					echo "<a class='btn btn-success border btn-sm d-sm-inline-block' role='button' href='#'>Aktif</a>";
				}else{
					echo "<a class='btn btn-light btn-sm d-sm-inline-block' role='button' href='#'>Mati</a>";
				}
			} ?>
			</td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table></div></div>
<?php } ?>
    	</div></div></div></div></div>
    </div></div><?php require 'footer.php'; ?></div></div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html> <?php }