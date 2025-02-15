<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_barang_masuk extends CI_Model {	
	

	public function select_penjualan() {
		$sql = "SELECT * FROM tbl_transaksi";

		$data = $this->db->query($sql);
		return $data->result();
	}
	public function cari_detail_barang($id) {
		$sql = "SELECT *
				FROM tbl_barang
				LEFT JOIN tbl_satuan ON tbl_satuan.id_satuan=tbl_barang.id_satuan
				LEFT JOIN tbl_supplier ON tbl_supplier.id_supplier=tbl_barang.id_supplier
				WHERE kode_barang = '{$id}' ORDER BY kode_barang DESC LIMIT 1";

		$data = $this->db->query($sql);
		return $data->result();
		//return $data->row();
	}
 public function insertBarang($data) {
	 	$today= date("Y-m-d");
		$date2 = $data['tgl_expired'];
		$tgl2 = explode('-',$date2);
		$texpired = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
	 	$ci = get_instance();
	 	$q_stok= "SELECT stok as stok_akhir FROM tbl_barang WHERE kode_barang = '".$data['kode_barang']."'";
		$data_stok = $ci->db->query($q_stok)->row_array();
		$stok_akhir= $data_stok['stok_akhir'];
		$total_stok= $stok_akhir+$data['jumlah'];
	 
		$sql1 = "UPDATE tbl_barang SET 
        tgl_expired		='$texpired',
        stok			='$total_stok'
        WHERE kode_barang='" .$data['kode_barang'] ."'";
		$this->db->query($sql1);
	 
		$sql = "INSERT INTO tbl_invoice VALUES
		('','".$data['no_invoice']."',
		'".$data['id_supplier']."',
		'".$data['kode_barang']."',
		'$texpired',
		'".$data['jumlah']."',
		'".$data['keterangan']."',
		'".$data['pembuat']."',
		'$today')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
    public function outBarang($data) {
	 	$today= date("Y-m-d");
	 	$ci = get_instance();
	 	$q_stok= "SELECT stok as stok_akhir FROM tbl_barang WHERE kode_barang = '".$data['kode_barang']."'";
		$data_stok = $ci->db->query($q_stok)->row_array();
		$stok_akhir= $data_stok['stok_akhir'];
		$total_stok= $stok_akhir-$data['jumlah'];
	 
		$sql1 = "UPDATE tbl_barang SET 
        stok			='$total_stok'
        WHERE kode_barang='" .$data['kode_barang'] ."'";
		$this->db->query($sql1);
	 
		$sql = "INSERT INTO tbl_barang_keluar VALUES
		('',
		'".$data['kode_barang']."',
		'$today',
		'".$data['jumlah']."',
		'".$data['keterangan']."',
		'".$data['pembuat']."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
    public function select_detail($id) {
        $sql = "SELECT * FROM tbl_detail_penjualan WHERE id_detail='{$id}' ";

		$data = $this->db->query($sql);

		return $data->result();
	}
    public function select_keluar($id) {
        $sql = "SELECT * FROM tbl_barang_keluar WHERE kode_keluar='{$id}' ";

		$data = $this->db->query($sql);

		return $data->result();
	}
	public function delete_d($id) {
		$sql = "DELETE FROM tbl_riwayat_diagnosa WHERE id='{$id}'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	public function delete_t($id) {
		$sql = "DELETE FROM tbl_riwayat_tindakan WHERE id='{$id}'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	public function delete_o($id) {
		$sql = "DELETE FROM tbl_riwayat_operasi WHERE id='{$id}'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	public function delete_ob($id) {
		$ci1 = get_instance();
		$q_k= "SELECT kode_obat as kode, jumlah as jumlah FROM tbl_riwayat_obat WHERE id = '{$id}'";
		$data_k = $ci1->db->query($q_k)->row_array();
		$kode= $data_k['kode'];
		$jumlah= $data_k['jumlah'];
		
		$ci = get_instance();
		$q_stok= "SELECT stok as stok_akhir FROM tbl_obat WHERE kode_obat = '$kode'";
		$data_stok = $ci->db->query($q_stok)->row_array();
		$stok_akhir= $data_stok['stok_akhir'];
		$total_stok= $stok_akhir+$jumlah;
		
		$sql_obat = "UPDATE tbl_obat SET stok='$total_stok'	WHERE kode_obat='$kode'";
		$this->db->query($sql_obat);
		
		$sql = "DELETE FROM tbl_riwayat_obat WHERE id='{$id}'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	public function cari_pendaftaran($id) {
		$sql = "SELECT * FROM tbl_pendaftaran LEFT JOIN tbl_pasien ON tbl_pasien.no_rekamedis=tbl_pendaftaran.no_rekamedis LEFT JOIN tbl_dokter ON tbl_dokter.kode_dokter=tbl_pendaftaran.kd_dokter LEFT JOIN tbl_poli ON tbl_poli.id_poli=tbl_pendaftaran.id_poli WHERE no_rawat LIKE '%{$id}%' AND status='N'";

		$data = $this->db->query($sql);
		return $data->result();
		//return $data->row();
	}
	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	function noDaftar(){
	$date= date("Y-m-d");
    $ci = get_instance();
    $query = "SELECT max(no_rawat) as maxKode FROM tbl_pendaftaran";
    $data = $ci->db->query($query)->row_array();
	$noOrder = $data['maxKode'];
	$noUrut = (int) substr($noOrder, 9, 3);
	$noUrut++;
	$char = "PS";
	$tahun=substr($date, 0, 4);
	$bulan=substr($date, 5, 2);
	$kodeBaru  = $char .$tahun .$bulan . sprintf("%03s", $noUrut);
		
    return $kodeBaru;
}
    
	public function insertOperasi($data){
		$sql1 = "UPDATE tbl_pendaftaran SET status	='Y' WHERE no_rawat='" .$data['no_rawat'] ."'";
		$this->db->query($sql1);
		$sql2 = "UPDATE tbl_rekamedis_pasien SET 
					kode_operasi	='" .$data['kode_operasi'] ."',
					ket_operasi='" .$data['keterangan'] ."' WHERE no_rawat='" .$data['no_rawat'] ."'";
		$this->db->query($sql2);
		$sql = "INSERT INTO tbl_riwayat_operasi VALUES
		('','" .$data['no_rawat'] ."',
		'" .$data['no_rekamedis'] ."',
		'" .$data['kode_operasi'] ."',
		'" .$data['keterangan'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	

	
}
/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */