<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_promo extends CI_Model {
	var $table = "tbl_konsumen";
	var $column_order = array(null, 'id_konsumen', 'nama','no_telp','alamat'); //set column field database for datatable orderable
	var $column_search = array('nama_konsumen','no_telp','alamat'); //set column field database for datatable searchable
	var $order = array('id_konsumen' => 'desc'); // default order

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column_search as $item) // loop column
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

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
 public function insertPromo($data) {
	 	$today= date("Y-m-d");
		$awal = $data['tgl_awal'];
		$akhir = $data['tgl_akhir'];
		$tgl_1 = explode('-',$awal);
		$tgl_awal = $tgl_1[2]."-".$tgl_1[1]."-".$tgl_1[0]."";
		$tgl_2 = explode('-',$akhir);
		$tgl_akhir = $tgl_2[2]."-".$tgl_2[1]."-".$tgl_2[0]."";
	 
	 $awal_p	=$data['tgl_awal'];
				$akhir_p	=$data['tgl_akhir'];
				$tgl_3	=explode('-',$awal_p);
				$tgl_generate1 = $tgl_3[2]."-".$tgl_3[1]."-".$tgl_3[0]."";
				$tgl_4	=explode('-',$akhir_p);
				$tgl_generate2 = $tgl_4[2]."-".$tgl_4[1]."-".$tgl_4[0]."";
	 
	 	while (strtotime($tgl_generate1) <= strtotime($tgl_generate2)) {
		$sql = "INSERT INTO tbl_promo SET
		id_promo	='',
		kode_barang	='".$data['kode_barang']."',
		tgl_awal	='$tgl_awal',
		tgl_akhir	='$tgl_akhir',
		tgl_promo	='$tgl_generate1',
		promo		='".$data['promo']."',
		jml_promo	='".$data['jml_promo']."',
		tgl_input	='$today',
		keterangan	='".$data['keterangan']."'";
		$this->db->query($sql);

		 $tgl_generate1 = date ("Y-m-d", strtotime("+1 day", strtotime($tgl_generate1)));//looping tambah 1 date
						}

		return $this->db->affected_rows();
	}
    public function delete_detail($id) {       
        $ci = get_instance();
		$q_stok= "SELECT tbl_detail_penjualan.kode_barang AS kode, tbl_detail_penjualan.jumlah AS jml,tbl_barang.stok AS stok FROM tbl_detail_penjualan
LEFT JOIN tbl_barang ON tbl_barang.kode_barang=tbl_detail_penjualan.kode_barang
WHERE tbl_detail_penjualan.id_detail='{$id}'";
		$data_stok = $ci->db->query($q_stok)->row_array();
		$kode_barang= $data_stok['kode'];
		$awal=$data_stok['jml'];
		$akhir=$data_stok['stok'];        
        
		$total_stok= $awal+$akhir;
        
        $sql_barang = "UPDATE tbl_barang SET stok='$total_stok'	WHERE kode_barang='$kode_barang'";
		$this->db->query($sql_barang);
        
		$sql = "DELETE FROM tbl_detail_penjualan WHERE id_detail='{$id}'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	public function delete_penjualan($id) {       
        $ci = get_instance();
		$q_stok= "SELECT tbl_detail_penjualan.kode_barang AS kode, tbl_detail_penjualan.jumlah AS jml,tbl_barang.stok AS stok FROM tbl_detail_penjualan
LEFT JOIN tbl_barang ON tbl_barang.kode_barang=tbl_detail_penjualan.kode_barang
WHERE tbl_detail_penjualan.id_penjualan='{$id}'";
		$data_stok = $ci->db->query($q_stok)->row_array();
		$kode_barang= $data_stok['kode'];
		$awal=$data_stok['jml'];
		$akhir=$data_stok['stok'];        
        
		$total_stok= $awal+$akhir;
        
        $sql_barang = "UPDATE tbl_barang SET stok='$total_stok'	WHERE kode_barang='$kode_barang'";
		$this->db->query($sql_barang);
        
		$sql_detail = "DELETE FROM tbl_detail_penjualan WHERE id_penjualan='{$id}'";
		$this->db->query($sql_detail);
		$sql = "DELETE FROM tbl_penjualan WHERE id_penjualan='{$id}'";
		$this->db->query($sql);

		return $this->db->affected_rows();
	}
    
	public function total_rows() {
		$data = $this->db->get("data_pengiriman WHERE kirim = 'N'");
		return $data->num_rows();
	}
}