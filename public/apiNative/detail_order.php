<?php
include_once('koneksi.php');
$id_order = $_POST['id_order'];

$sql = mysqli_query($con, "SELECT * from detail_order JOIN barang 
ON barang.id_barang = detail_order.id_barang 
WHERE id_order = '$id_order'");

if(mysqli_num_rows($sql) > 0){
	$res = array();
	while($a = mysqli_fetch_array($sql)){
		$b['id'] = $a['id'];
		$b['nama_barang'] = $a['nama_barang'];
		$b['harga'] = $a['harga'];
		$b['jml_barang'] = $a['jml_barang'];
		$b['status'] = $a['status'];
		$b['foto_barang'] = $a['foto_barang'];
		array_push($res, $b);
	}
	echo strip_tags(json_encode($res));
	
} else {
    $response["message"] = "tidak ada data";
    echo json_encode($res);
}

?>