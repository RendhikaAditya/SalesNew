<?php
require_once('koneksi.php');

$id_order = $_POST['id_order'];

$cek = mysqli_query($con, "SELECT * FROM `costumer` JOIN `order` ON `costumer`.id_costumer = `order`.id_costumer WHERE id_order='$id_order'");

$response = array();
if (mysqli_num_rows($cek) > 0) {

        while ($x = mysqli_fetch_array($cek)) {
            $h['id_costumer']=$x['id_costumer'];
            $h['nama_costumer'] = $x['nama_costumer'];
			$h['alamat_costumer'] = $x['alamat_costumer'];
			
            array_push($response, $h);
        }
        echo strip_tags(json_encode($response));
    
}
