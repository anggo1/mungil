<?php
if(isset($_GET['id_penjualan'])){
	require_once "conn.php";
	include "conn.php";
		require_once "validate.php";
		$data=array();
		$ids = validate($_GET['id_penjualan']);
			$ida = explode('=',$ids);		
			$id = $ida[0];
	
	$query = mysqli_query($conn, "SELECT a.id_penjualan AS id_penjualan,
	a.nama_barang,
	a.harga_dasar,
	a.satuan,
	a.jumlah,
	a.potongan,
	a.total_harga,
	b.jumlah_diskon,
	b.diskon,
	b.pembayaran,
	sum(total_harga)as total_harganya,sum(jumlah) as total_jumlah 
	FROM tbl_detail_penjualan AS a
	INNER JOIN tbl_penjualan AS b USING (id_penjualan)
	WHERE a.id_penjualan = '".$id."'");
	$cek=mysqli_num_rows($query);
	
		if($cek > 0){
		$data=array();  
			foreach ($query as $query):$data=array('id_penjualan'		=>$query['id_penjualan'],
												   'nama_barang'			=>$query['nama_barang'],
												   'harga_dasar'			=>$query['harga_dasar'],
												   'satuan'		=>$query['satuan'],
												   'jumlah'	=>$query['jumlah'],
												   'potongan'		=>$query['potongan'],
												   'total_harga'	=>$query['total_harga'],
												   'jumlah_diskon'	=>$query['jumlah_diskon'],
												   'diskon'		=>$query['diskon'],
												   'pembayaran'		=>$query['pembayaran'],
												   'total_harganya'		=>$query['total_harganya'],
												   'total_jumlah'	=>$query['total_jumlah']
												  );
		endforeach;
	
		echo json_encode($data);
		} else {
			echo "Salah";
		}
	}
?>
<?php 

if(isset($_GET['id_penjualan1'])){
require_once "conn.php";
include "conn.php";
require_once "validate.php";
$data=array();
$ids = validate($_GET['id_penjualan1']);
	$ida = explode('=',$ids);		
	$id = $ida[0];

$result = array();	
$no = 1;
$result['data'] = array();
$select= "SELECT a.id_penjualan AS id_penjualan,
a.nama_barang,
a.harga_dasar,
a.satuan,
a.jumlah,
a.potongan,
a.total_harga,
b.jumlah_diskon,
b.diskon,
b.pembayaran
FROM tbl_detail_penjualan AS a
INNER JOIN tbl_penjualan AS b USING (id_penjualan)
WHERE a.id_penjualan = '".$id."'";
$responce = mysqli_query($conn,$select);

while($row = mysqli_fetch_array($responce))
		{
			$index['id_penjualan']    = $row['0'];
			$index['nama_barang']      = $row['1'];
			$index['harga_dasar']   = $row['2'];
			$index['satuan']   = $row['3'];
			$index['jumlah']   = $row['4'];
			$index['potongan'] = $row['5'];
			$index['total_harga'] = $row['6'];
			$index['jumlah_diskon'] = $row['7'];
			$index['diskon'] = $row['8'];
			$index['pembayaran'] = $row['9'];
			array_push($result['data'], $index);
	}
		
		echo json_encode($result);
}else {
        echo "Salah";
    }
?>