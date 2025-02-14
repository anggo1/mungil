<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_satuan extends CI_Model
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
    function get_all_satuan(){
		$hsl=$this->db->query("select * from tbl_satuan");
		return $hsl;
	}
	function get_satuan_by_id($satuan){
		$hsl=$this->db->query("select * from tbl_satuan where id_satuan='$satuan'");
		return $hsl;
	}
    
	public function select_satuan() {
		$sql = " SELECT * FROM tbl_satuan";

		$data = $this->db->query($sql);

		return $data->result();
	}
    public function insertSatuan($data) {
		$sql = "INSERT INTO tbl_satuan VALUES
		('','".$data['nama_satuan']."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
    public function select_id_satuan($id) {
		$sql = "SELECT * FROM tbl_satuan WHERE id_satuan='{$id}' ";

		$data = $this->db->query($sql);

		return $data->result();
	}
    	public function updateSatuan($data) {
		$sql = "UPDATE tbl_satuan SET nama_satuan='" .$data['nama_satuan'] ."' WHERE id_satuan='" .$data['id_satuan'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	//end satuan
}