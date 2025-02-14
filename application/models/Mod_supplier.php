<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_supplier extends CI_Model
{
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
   
	public function get_by_nama($link)
    {
        $this->db->select('id_submenu');
        $this->db->from('tbl_submenu');
        $this->db->where('link', $link);
        $query = $this->db->get();
        return $query->result();
    }
    function select_by_level($idlevel, $id_sub)
    {
        $this->db->select('*');
        $this->db->from('tbl_akses_submenu');
        //$this->db->join('tbl_akses_submenu','tbl_akses_submenu.id_submenu=tbl_akses_menu.id_menu','inner');
        $this->db->where('tbl_akses_submenu.id_level=',$idlevel);
        $this->db->where('tbl_akses_submenu.id_submenu=',$id_sub);
        $data = $this->db->get();
        return $data->result();
    }
	function get_all_supplier(){
		$hsl=$this->db->query("select * from tbl_supplier");
		return $hsl;
	}
	function get_supplier_by_id($supplier){
		$hsl=$this->db->query("select * from tbl_supplier where id_supplier='$supplier'");
		return $hsl;
	}
	public function select_supplier() {
		$sql = " SELECT * FROM tbl_supplier";

		$data = $this->db->query($sql);

		return $data->result();
	}
    public function insertSupplier($data) {
		$sql = "INSERT INTO tbl_supplier VALUES
		('','".$data['nama_supplier']."','".$data['telp']."','".$data['alamat']."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
    public function select_id_supplier($id) {
		$sql = "SELECT * FROM tbl_supplier WHERE id_supplier='{$id}' ";

		$data = $this->db->query($sql);

		return $data->result();
	}
    	public function updateSupplier($data) {
		$sql = "UPDATE tbl_supplier SET nama_supplier='" .$data['nama_supplier'] ."',
        telp='" .$data['telp'] ."',
        alamat='" .$data['alamat'] ."'
        WHERE id_supplier='" .$data['id_supplier'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	 public function deleteSup($id) {
		$sql = "DELETE FROM tbl_supplier WHERE id_supplier='{$id}'";
		$this->db->query($sql);
        

		return $this->db->affected_rows();
	}
	//end satuan
}