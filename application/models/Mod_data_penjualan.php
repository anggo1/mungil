<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_data_penjualan extends CI_Model {
	
	public function select_list_absen() {
		$sql = " SELECT pegawai.departement AS departement,pegawai.nama_depan AS nama, userinfo.badgenumber AS nip,checkinout.userid, checkinout.checktime AS datelog,checkinout.checktype AS type FROM pegawai, userinfo, checkinout WHERE checkinout.userid = userinfo.userid AND checkinout.checktime BETWEEN  '2019-02-10' AND '2019-02-15' AND pegawai.departement='1'";
		
		$data = $this->db->query($sql);

		return $data->result();
	}
	public function cari_periode($date =null,$date2=null)
	{
		$this->db->select('tbl_penjualan.*', FALSE);
        $this->db->select('tbl_detail_penjualan.*', FALSE);
        $this->db->select('tbl_barang.*', FALSE);
        $this->db->from('tbl_penjualan');
        $this->db->join('tbl_detail_penjualan', 'tbl_detail_penjualan.id_penjualan = tbl_penjualan.id_penjualan', 'right');
        $this->db->join('tbl_barang', 'tbl_barang.kode_barang = tbl_detail_penjualan.kode_barang', 'right');
		$this->db->where('tbl_penjualan.tgl_buat BETWEEN "'.date($date).'"AND"'.date($date2).'"');
        $query_result = $this->db->get();
		return $data = $query_result->result();
	}
    public function cari_barang($date =null,$date2=null)
	{
		$this->db->select('tbl_barang_keluar.*', FALSE);
        $this->db->select('tbl_barang.*', FALSE);
        $this->db->from('tbl_barang_keluar');
        $this->db->join('tbl_barang', 'tbl_barang.kode_barang = tbl_barang_keluar.kode_barang', 'right');
		$this->db->where('tbl_barang_keluar.tgl_keluar BETWEEN "'.date($date).'"AND"'.date($date2).'"');
        $query_result = $this->db->get();
		return $data = $query_result->result();
	}
    public function cari_barang_masuk($date =null,$date2=null)
	{
		$this->db->select('tbl_invoice.no_invoice,tbl_invoice.kode_barang,tbl_invoice.jumlah,tbl_invoice.tgl_expired,tbl_invoice.keterangan,tbl_invoice.pengguna,tbl_invoice.tgl_input', FALSE);
        $this->db->select('tbl_barang.nama_barang', FALSE);
        $this->db->select('tbl_supplier.*', FALSE);
        $this->db->from('tbl_invoice');
        $this->db->join('tbl_barang', 'tbl_barang.kode_barang = tbl_invoice.kode_barang', 'LEFT');
        $this->db->join('tbl_supplier', 'tbl_supplier.id_supplier = tbl_invoice.id_supplier', 'LEFT');
		$this->db->where('tbl_invoice.tgl_input BETWEEN "'.date($date).'"AND"'.date($date2).'"');
		$this->db->order_by("id_inv", "DESC"); 
        $query_result = $this->db->get();
		return $data = $query_result->result();
	}
     public function cari_promo($date =null,$date2=null)
	{
		$this->db->select('tbl_promo.*', FALSE);
        $this->db->select('tbl_barang.*', FALSE);
        $this->db->from('tbl_promo');
        $this->db->join('tbl_barang', 'tbl_barang.kode_barang = tbl_promo.kode_barang', 'right');
		$this->db->where('tbl_promo.tgl_promo BETWEEN "'.date($date).'"AND"'.date($date2).'"');
		//$this->db->group_by('tbl_barang.kode_barang'); 
        $query_result = $this->db->get();
		return $data = $query_result->result();
	}
    public function deletePromo($id) {
		$sql = "DELETE FROM tbl_promo WHERE id_promo='{$id}'";
		$this->db->query($sql);
        

		return $this->db->affected_rows();
	}
     public function rekap_supplier($datasup=null,$date =null,$date2=null)
	{
		$this->db->select('tbl_supplier.nama_supplier', FALSE);
        $this->db->select('tbl_invoice.no_invoice,tbl_invoice.kode_barang,tbl_invoice.tgl_expired,tbl_invoice.jumlah,tbl_invoice.pengguna,tbl_invoice.tgl_input', FALSE);
        $this->db->select('tbl_barang.nama_barang', FALSE);
        $this->db->from('tbl_supplier');
        $this->db->join('tbl_invoice', 'tbl_invoice.id_supplier = tbl_supplier.id_supplier', 'right');
        $this->db->join('tbl_barang', 'tbl_barang.kode_barang = tbl_invoice.kode_barang', 'right');
		$this->db->where('tbl_supplier.id_supplier',$datasup);
		$this->db->where('tbl_invoice.tgl_input BETWEEN "'.date($date).' 00:00:00 "AND"'.date($date2).' 23:59:00"');
		$this->db->order_by("id_inv", "ASC"); 
        $query_result = $this->db->get();
		return $data = $query_result->result();
	}
    public function selectSupplier() {
		$sql = "SELECT * FROM tbl_supplier ";

		$data = $this->db->query($sql);
		
		return $data->result();
	}
	 public function cari_konsumen($date =null,$date2=null)
	{
		 $sql = " SELECT tbl_konsumen.id_konsumen AS idkons,
		 		tbl_konsumen.nama_konsumen AS nama_konsumen,
		 		tbl_konsumen.no_telp AS no_telp,
				tbl_konsumen.alamat AS alamat, 
				COUNT(tbl_penjualan.id_konsumen) AS total_transaksi, 
				SUM(tbl_penjualan.total)AS jml_transaksi 
		 		FROM tbl_konsumen RIGHT JOIN tbl_penjualan ON tbl_penjualan.id_konsumen = tbl_konsumen.id_konsumen
		 		WHERE tbl_penjualan.tgl_buat BETWEEN '{$date}'AND'{$date2}' GROUP BY tbl_penjualan.id_konsumen ORDER BY COUNT(*) DESC";
		
		$data = $this->db->query($sql);

		return $data->result();
	}
	public function cari_setoran($date =null,$date2=null)
	{
		$this->db->select('log_setor.*', FALSE);
        $this->db->select('data_setor.*', FALSE);
		$this->db->select('sum(data_setor.jumlah) total');
        $this->db->select('no_stt.*', FALSE);
        $this->db->from('log_setor');
        $this->db->join('data_setor', 'data_setor.id_setor = log_setor.id_setor', 'left');
        $this->db->join('no_stt', 'no_stt.no_stt = data_setor.no_stt', 'left');
		//$this->db->select_sum('jumlah','Total');	
		//$this->db->where('data_setor', 'data_setor.id_setor = log_setor.id_setor');
		$this->db->where('log_setor.tgl_setor BETWEEN "'.date($date).'"AND"'.date($date2).'"');
		$this->db->group_by('log_setor.id_setor'); 
        $query_result = $this->db->get();
		return $data = $query_result->result();
		
	}
	
	public function selectDevice() {
		$sql = "SELECT * FROM iclock ";

		$data = $this->db->query($sql);
		
		return $data->result();
	}
	public function select_by_idposisi($id) {
		$sql = "SELECT * FROM posisi WHERE id_posisi = '{$id}'";

		$data = $this->db->query($sql);
		return $data->row();
	}
	public function lihat_absen($departement){
    $sql = " SELECT pegawai.departement AS departement,pegawai.nama_depan AS nama, userinfo.badgenumber AS nip,checkinout.userid, checkinout.checktime AS datelog,checkinout.checktype AS type FROM pegawai, userinfo, checkinout WHERE checkinout.userid = userinfo.userid AND pegawai.departement='{$departement}'";
		
		$data = $this->db->query($sql);

		return $data->result();
  }
	
	public function cari_absen($departement = null,$date =null,$date2=null)
	{
		//$this->db->select('pegawai.*', FALSE);
        //$this->db->select('userinfo.*', FALSE);
        //$this->db->select('checkinout.*', FALSE);
        //$this->db->select('departement.*', FALSE);
        //$this->db->from('pegawai');
        //$this->db->join('departement', 'departement.id_departement = pegawai.departement', 'left');
        //$this->db->join('userinfo', 'userinfo.badgenumber = pegawai.nip', 'left');
        //$this->db->join('checkinout', 'checkinout.userid = userinfo.userid', 'left');
        //$this->db->where('pegawai.departement',$departement);
		//$this->db->where('checkinout.checktime BETWEEN "'.date($date).'"AND"'.date($date2).'"');
        //$query_result = $this->db->get();
		//return $data = $query_result->result();
		

		$data = $this->db->query("SELECT pegawai.nip,pegawai.nama_depan,pegawai.departement,userinfo.userid,userinfo.defaultdeptid,userinfo.badgenumber,checkinout.userid,checkinout.checktime,checkinout.checktype,departement.departement
		FROM pegawai 
		LEFT JOIN userinfo ON userinfo.badgenumber=pegawai.nip
		LEFT JOIN departement ON departement.id_departement=pegawai.departement
		LEFT JOIN checkinout ON checkinout.userid=userinfo.userid
		WHERE pegawai.departement='".$departement."' AND checkinout.checktime BETWEEN  '".date($date)." 00:00:00' AND '".date($date2)." 23:59:59' ORDER BY nip, checktime ASC");
		
		return $data->result();
	}
	
	public function cari_absen_tempat($penempatan = null,$date =null,$date2=null)
	{

		$data = $this->db->query("SELECT pegawai.nip,pegawai.nama_depan,pegawai.penempatan,userinfo.userid,userinfo.defaultdeptid,userinfo.badgenumber,checkinout.userid,checkinout.checktime,checkinout.checktype,penempatan.penempatan
		FROM pegawai 
		LEFT JOIN userinfo ON userinfo.badgenumber=pegawai.nip
		LEFT JOIN penempatan ON penempatan.id_penempatan=pegawai.penempatan
		LEFT JOIN checkinout ON checkinout.userid=userinfo.userid
		WHERE pegawai.penempatan='".$penempatan."' AND checkinout.checktime BETWEEN  '".date($date)." 00:00:00' AND '".date($date2)." 23:59:59' ORDER BY nip, checktime ASC");

		return $data->result();
	}
	public function rekap_lokasi($penempatan = null,$date =null,$date2=null)
	{
		$this->db->select('pegawai.*', FALSE);
        $this->db->select('userinfo.*', FALSE);
        $this->db->select('checkinout.*', FALSE);
        $this->db->select('penempatan.*', FALSE);
		//$this->db->select_sum("IF(checkinout.checktype='0', 1, 0)","masuk");	
		//$this->db->select_sum("IF(checkinout.checktype='1', 1, 0)","pulang");	
        $this->db->from('pegawai');
        $this->db->join('userinfo', 'userinfo.badgenumber = pegawai.nip', 'left');
        $this->db->join('penempatan', 'penempatan.id_penempatan = pegawai.penempatan', 'left');
        $this->db->join('checkinout', 'checkinout.userid = userinfo.userid', 'left');
		$this->db->where('pegawai.penempatan',$penempatan);
		$this->db->where('checkinout.checktime BETWEEN "'.date($date).' 00:00:00 "AND"'.date($date2).' 23:59:00"');
		$this->db->group_by("nip"); 
		$this->db->order_by("nip", "ASC"); 
        $query_result = $this->db->get();
		
		return $data = $query_result->result();
		
	}
	public function rekap_lokasi_id($Uid = null,$date =null,$date2=null)
	{
        $this->db->select('checkinout.*', FALSE);
        $this->db->from('checkinout');
		$this->db->where('checkinout.userid',$Uid);
		$this->db->where('checkinout.checktime BETWEEN "'.date($date).'"AND"'.date($date2).'"');
		//$this->db->group_by("nip"); 
		//$this->db->order_by("nip", "ASC"); 
        $query_result = $this->db->get();
		
		return $data = $query_result->result();
		
	}
	
	public function cari_absen_pers($nip = null,$date =null,$date2=null)
	{

		$data = $this->db->query("SELECT pegawai.nip,pegawai.nama_depan,userinfo.userid,userinfo.defaultdeptid,userinfo.badgenumber,checkinout.userid,checkinout.checktime,checkinout.checktype
		FROM pegawai 
		LEFT JOIN userinfo ON userinfo.badgenumber=pegawai.nip
		LEFT JOIN checkinout ON checkinout.userid=userinfo.userid
		WHERE pegawai.nip='".$nip."' AND checkinout.checktime BETWEEN  '".date($date)." 00:00:00' AND '".date($date2)." 23:59:59'ORDER BY nip, checktime ASC");

		return $data->result();
	}
	
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */