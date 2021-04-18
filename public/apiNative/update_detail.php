<?php
class emp{}
require_once('koneksi.php');
$kode = $_POST['kode'];
if($kode == 1){
	$id = $_POST['id'];
	$harga = $_POST['harga'];
	$jml_barang = $_POST['jml_barang'];
			
	$sql = "UPDATE `detail_order` SET `harga` = '$harga', `jml_barang` = '$jml_barang' where `id` = '$id'";
			
	if(mysqli_query($con,$sql)){
		$res = new emp();	
		$res->message = "Berhasil Ubah Data";
		$res->status = "1";
		die(json_encode($res));
	}else{
		$res = new emp();	
		$res->message = "gagal";
		$res->status = "0";
		die(json_encode($res));
	}
	mysqli_close($con);
}else if($kode == 2){
	$id_order = $_POST['id_order'];
	$id_costumer = $_POST['id_costumer'];
	$sql = "UPDATE `detail_order` SET `status` = 1 where `id_order` = '$id_order'";
			
	if(mysqli_query($con,$sql)){
	    
		/*$res = new emp();	
		$res->message = "Berhasil Ubah Status";
		$res->status = "1";
		
		$sql = mysqli_query($con, "SELECT `costumer`.id_costumer, `order`.id_order, total_harga
		FROM `order` JOIN `costumer` ON `order`.id_costumer = `costumer`.id_costumer 
		WHERE `costumer`.id_costumer = '$id_costumer'");*/
		
		$sql = mysqli_query($con, "SElECT `costumer`.target_tercapai FROM `costumer` WHERE id_costumer='$id_costumer'");
		$target = mysqli_fetch_array($sql);
		$target_tercapai = $target['target_tercapai'];
		
		$query = mysqli_query($con, "SElECT `order`.total_harga FROM `order` WHERE id_order='$id_order'");
		$t = mysqli_fetch_array($query);
		$total = $t['total_harga'];
		
		$x = $target_tercapai + $total;
			
			/*if ($sql) {
				$tot = 0;
				while ($x = mysqli_fetch_array($sql)) {
					$h['total_harga'] = $x['total_harga'];
					$h['id_order'] = $x['id_order'];	
					$tot = $h['total_harga'] + $tot;
				}
			}*/
			//echo "Total Semua : ". $tot;
			
			$que = "UPDATE `costumer` SET `target_tercapai` = '$x' where `id_costumer` = '$id_costumer'";
			if(mysqli_query($con,$que)){			
				$res = new emp();	
				$res->message = "Sukses Nambah Total";
				$res->status = "1";
				//$res->target_tercapai = $tot;
				die(json_encode($res));
			}else{
				$res = new emp();	
				$res->message = "Gagal Menambah Target Tercapai";
				$res->status = "0";
				die(json_encode($res));
			}
			mysqli_close($con);
	
		die(json_encode($res));
	}else{
		$res = new emp();	
		$res->message = "gagal";
		$res->status = "0";
		die(json_encode($res));
	}
}else if($kode == 3){
	$id_order = $_POST['id_order'];
	$total_harga = $_POST['total_harga'];
	$sql = "UPDATE `order` SET `total_harga` = '$total_harga' where `id_order` = '$id_order'";
			
	if(mysqli_query($con,$sql)){
		$res = new emp();	
		$res->message = "Berhasil Ubah Total harga";
		$res->status = "1";
	
		die(json_encode($res));
	}else{
		$res = new emp();	
		$res->message = "gagal";
		$res->status = "0";
		die(json_encode($res));
	}
}else if ($kode == 4) {
	$id_order = $_POST['id_order'];
	
	$Q = mysqli_query($con, "SELECT `id_costumer` FROM `order` WHERE `id_order`='$id_order'");
	$i = mysqli_fetch_object($Q);
	$id_costumer = $i->id_costumer;
	
// 	echo "id : ".$id_costumer;
// 	exit();
	
	    $sqls = mysqli_query($con, "SElECT `costumer`.target_tercapai FROM `costumer` WHERE id_costumer='$id_costumer'");
		$target = mysqli_fetch_array($sqls);
		$target_tercapai = $target['target_tercapai'];
		
		$querys = mysqli_query($con, "SElECT `order`.total_harga FROM `order` WHERE id_order='$id_order'");
		$t = mysqli_fetch_array($querys);
		$total = $t['total_harga'];
	
	$x = $target_tercapai - $total;
	
	
	$que = mysqli_query($con, "UPDATE `costumer` SET `target_tercapai` = '$x' where `id_costumer` = '$id_costumer'");
	
// 	echo "id : ".$id_costumer."\ntarget : ".$target_tercapai."\ntotal : ".$total."\ntotals : ".$x, "\nkondisia : ".$que;
// 	exit();
	if($que){
        $sql = mysqli_query($con, "DELETE FROM `detail_order` WHERE `id_order` = '$id_order'");
		$query = mysqli_query($con, "DELETE FROM `order` WHERE `id_order` = '$id_order'");
        if ($sql && $query) {
            $response = new emp();
            $response->response = "Berhasil Dihapus";
            $response->kode = 1;
            die(json_encode($response));
        } else {
            $response = new emp();
            $response->response = "Gagal Menghapus";
            $response->kode = 0;
            die(json_encode($response));
        }
	}else{
	    $response = new emp();
        $response->response = "Gagal Update :| ".$id_costumer;
        $response->kode = 0;
        die(json_encode($response));
	}
}
	

?>