<?php
header('Content-Type: application/json');
require_once('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    //$pass = password_hash("$password", PASSWORD_DEFAULT);
    // echo $pass;
    $perintah = "SELECT * FROM users WHERE email='$email'";
    $eksekusi = mysqli_query($con, $perintah);
	$query = mysqli_fetch_object($eksekusi);
	if($query){
		$pas = $query->password;
		if (password_verify($password, $pas)) {
			$response = [];

			$cari_user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND id_level = '2'"));

			if (!empty($cari_user)) {
				unset($cari_user['password']);
				$response["kode"] = 1;
				$response["pesan"] = "Login Berhasil";
				$response["data"] = $cari_user;
			} else {
				$response["kode"] = 2;
				$response["pesan"] = "Login Gagal";
			}
		} else {       
			$response["kode"] = 3;
			$response["pesan"] = "Password Salah";
		}
	}else{
		$response["kode"] = 4;
		$response["pesan"] = "Email Tidak Ditemukan";
	}
} else {
	$response = [];
	$response["kode"] = 5;
	$response["pesan"] = "Jaringan Bermasalah";
}
mysqli_close($con);
echo json_encode($response);
