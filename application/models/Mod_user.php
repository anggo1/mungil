<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_user extends CI_Model {

	var $table = 'tbl_user';
	var $column_order = array('username','full_name','id_level','image','is_active');
	var $column_search = array('username','full_name','id_level','is_active'); 
	var $order = array('id_user' => 'desc'); // default order 

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

 private function _get_datatables_query()
    {
    	$this->db->select('a.*,b.nama_level');
    	$this->db->join('tbl_userlevel b', 'a.id_level=b.id_level');
        $this->db->from('tbl_user a');
        $this->db->where('a.id_level !=',1);

        $i = 0;
    
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
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
        
        $this->db->from('tbl_user');
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
    function view_user($id)
    {   
        $this->db->where('id_user',$id);
        return $this->db->get('tbl_user');
    }

    function getAll()
    {   
        $this->db->select('a.*,b.nama_level');
        $this->db->join('tbl_userlevel b', 'a.id_level = b.id_level');
        $this->db->order_by('a.id_user desc');
        return $this->db->get('tbl_user a');
    }

    function cekUsername($username)
    {
        $this->db->where("username",$username);
        return $this->db->get("tbl_user");
    }

    function insertUser($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function getUser($id)
    {   
        $this->db->where("id_user", $id);
        return $this->db->get("tbl_user a")->row();
    }

    function updateUser($id, $data)
    {
        $this->db->where('id_user', $id);
		$this->db->update('tbl_user', $data);
    }
    

    function deleteUsers($id, $table)
    {
        $this->db->where('id_user', $id);
        $this->db->delete($table);
    }

    function userlevel()
    {
       return $this->db->order_by('id_level ASC')
                        ->get_where('tbl_userlevel','id_level != 1')
                        ->result();
    }
    function userlokasi()
    {
       return $this->db->order_by('id_kota ASC')
                        ->get('tbl_kota')
                        ->result();
    }

    function getImage($id)
    {
        $this->db->select('image');
        $this->db->from('tbl_user');
        $this->db->where('id_user', $id);
        return $this->db->get();
    }
    
    function reset_pass($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('tbl_user', $data);
    }
}