<?php

function insert(){
	require 'admin/assets/func/koneksi.php';

	$pass = mysqli_real_escape_string($con, "13061998");
	$passhash = password_hash($pass, PASSWORD_DEFAULT);

	$exc = mysqli_query($con, "INSERT INTO akun (username, pass, pass_hash, namal, namap, alamat, nohp, status) VALUES ('initial.sa', '$pass', '$passhash', 'Muhammad Sabri', 'Sabri', 'BTN Samata Indah Kab. Gowa', '085144392944', 'admin')");
	if(!$exc){return false;}
	else{return true;}
}

function login($username, $pass){
	require 'admin/assets/func/koneksi.php';

	$result = mysqli_query($con, "SELECT id, pass_hash, namap, status FROM akun WHERE username='$username' AND aktif='1'");
	if(mysqli_num_rows($result) === 1){
		$data = mysqli_fetch_assoc($result);
		if(password_verify($pass, $data['pass_hash'])){
			$_SESSION['login'] = true;
			$_SESSION['userid'] = $data['id'];
			$_SESSION['nama'] = $data['namap'];
			$_SESSION['status'] = $data['status'];

			header('location:admin');
		}
		else{
			echo "<script>
					gagalLogin('$username');
				</script>";
		}
	}else{
		echo "<script>
				gagalLogin('');
			</script>";
	}
}

function selectData($query){
	require 'admin/assets/func/koneksi.php';
	return mysqli_query($con, $query);
}

function dbAct($query, $url=""){
	require 'admin/assets/func/koneksi.php';
	$exc = mysqli_query($con, $query);
	if(!$exc){
		echo "<script>alert('Gagal terhubung ke Database! Periksa konfigurasi database dan struktur direktori Web anda');</script>";
	}
	if($url != ""){ header("location:$url"); }
}