<?php
include_once('koneksi.php');
$id = $_POST['id'];

$sql = mysqli_query($con, "SELECT * from detail_order WHERE id = '$id'");

if(mysqli_num_rows($sql) > 0){
	$res = array();
	while($a = mysqli_fetch_array($sql)){
	
		$b['harga'] = $a['harga'];
		$b['jml_barang'] = $a['jml_barang'];
		array_push($res, $b);
	}
	echo strip_tags(json_encode($res));
	
} else {
    $response["message"] = "tidak ada data";
    echo json_encode($res);
}

?>