<?php
require_once('koneksi.php');

$query = mysqli_query($con, "SELECT * FROM `order` JOIN `costumer` ON `order`.id_costumer = `costumer`.id_costumer ORDER BY `order`.`id` DESC");

if (mysqli_num_rows($query) > 0) {
    $response = array();
    while ($x = mysqli_fetch_array($query)) {

        $id_order = $x['id_order'];
        $h['id_order'] = $x['id_order'];
        $h['nama_costumer'] = $x['nama_costumer'];
        $h['total_harga'] = $x['total_harga'];
		$h['bentuk_pembayaran'] = $x['bentuk_pembayaran'];
		$h['tgl_order'] = $x['tgl_order'];
        $item = mysqli_query($con, "SELECT * FROM `detail_order` JOIN `order` ON `order`.id_order = `detail_order`.id_order WHERE `order`.id_order = '$id_order'");
        $y = mysqli_fetch_array($item);
        $h['jumlah_item'] = "" . mysqli_num_rows($item);
		$h['status'] = $y['status'];
       
        array_push($response, $h);
    }
    echo strip_tags(json_encode($response));
} else {
    $response["message"] = "tidak ada data";
    echo json_encode($response);
}
