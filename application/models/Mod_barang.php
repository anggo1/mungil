<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_barang extends CI_Model
{
    var $table = 'tbl_barang';
    var $column_search = array('a.kode_barang','a.nama_barang','a.id_satuan','a.id_supplier','a.harga_eceran','a.stok');
    var $column_order = array('null','a.kode_barang','a.nama_barang','a.id_satuan','a.id_supplier','a.harga_eceran','a.stok');
    var $order = array('kode_barang' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    private function _get_datatables_query($term = '')
    {

        $this->db->select('a.*');
        $this->db->from('tbl_barang as a');
        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_query($term);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_query($term);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {

        $this->db->from('tbl_barang as a');
        //$this->db->join('tbl_menu as b','a.id_menu=b.id_menu');
        return $this->db->count_all_results();
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
	public function select_satuan() {
		$sql = " SELECT * FROM tbl_satuan";

		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_supplier() {
		$sql = " SELECT * FROM tbl_supplier";

		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_barang() {
		$sql = " SELECT * FROM tbl_barang 
        LEFT JOIN tbl_supplier ON tbl_supplier.id_supplier=tbl_barang.id_supplier order by kode_barang desc";

		$data = $this->db->query($sql);

		return $data->result();  
	}
    public function select_id_barang($id) {
		$sql = "SELECT * FROM tbl_barang 
        LEFT JOIN tbl_supplier ON tbl_supplier.id_supplier=tbl_barang.id_supplier
		WHERE kode_barang='{$id}' ";

		$data = $this->db->query($sql);

		return $data->result();
	}
	    public function insertBarang($data) {
		$sql = "INSERT INTO tbl_barang SET
		kode_barang	='".$data['kode_barang']."',
		nama_barang	='".$data['nama_barang']."',
		id_satuan	='".$data['id_satuan']."',
		jml_satuan	='".$data['jml_satuan']."',
		id_supplier	='".$data['id_supplier']."',
		ket			='".$data['ket']."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
    	public function updateBarang($data) {
		$sql = "UPDATE tbl_barang SET 
        nama_barang='" .$data['nama_barang'] ."',
        id_satuan='" .$data['id_satuan'] ."',
        jml_satuan='" .$data['jml_satuan'] ."',
        id_supplier='" .$data['id_supplier'] ."',
        ket='" .$data['ket'] ."'
        WHERE kode_barang='" .$data['kode_barang'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}	
		public function updateStokBarang($data) {			
		$today= date("Y-m-d");
		
		$sql = "UPDATE tbl_barang SET 
        harga_beli		='" .$data['harga_beli'] ."',
        harga_eceran	='" .$data['harga_eceran'] ."'
        WHERE kode_barang='" .$data['kode_barang'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
     public function deleteBarang($id) {
		$sql = "DELETE FROM tbl_barang WHERE kode_barang='{$id}'";
		$this->db->query($sql);
        

		return $this->db->affected_rows();
	}
	//end Barang

}