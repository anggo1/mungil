<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('calendar');
        $this->load->helper('terbilang');
		
		$this->load->model(array('Mod_barang'));
        $this->load->model(array('Mod_userlevel'));
		$this->load->helper('tgl_indo_helper');
		$this->load->model('Mod_aplikasi');
	}


	public function index() {
		$data['data'] = $this->Mod_barang->select_barang();
		$data['dataSat']        = $this->Mod_barang->select_satuan();
		$data['dataSup']        = $this->Mod_barang->select_supplier();

		$data['page'] 		= "Barang";
		$data['judul'] 		= "Daftar Barang";
		$data['deskripsi'] 	= "Data Barang";

		$data['modal_tambah_barang'] = show_my_modal('master_data/modals/modal_tambah_barang', 'tambah-barang', $data, ' modal-lg');

		$this->template->load('layoutbackend', 'master_data/barang', $data);
	}
	public function ajax_list()
    {
        $link=$this->uri->segment(1);
        $idlevel = $this->session->userdata['id_level'];
        $get_id = $this->Mod_barang->get_by_nama($link);
        foreach ($get_id as $idnye){
            $row1 = array();
            $row1[] = $idnye->id_submenu;
            $id_sub=$idnye->id_submenu;
        }
        $viewLevel = $this->Mod_barang->select_by_level($idlevel, $id_sub);

        foreach ($viewLevel as $pel1) {
            $row1 = array();
            $row1[] = $pel1->id_submenu;
            $data1[] = $row1;

            $list = $this->Mod_barang->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $p) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $p->kode_barang;
                $row[] = $p->nama_barang;
                $row[] = $p->id_satuan;                
                $row[] = $p->id_supplier;
                $row[] = number_format($p->harga_eceran);    
                $row[] = $p->stok;
                if($pel1->edit_level=="Y"){
                    $edit='                    
                    <button class="btn btn-sm btn-outline-success update-dataBarang" title="Edit" data-id="'.$p->kode_barang.'"><i class="fa fa-edit"></i>
                    </button>';
                }                
                if($pel1->delete_level=="Y"){
                    $delete='
                    <button class="btn btn-sm btn-outline-danger delete-barang" title="Delete" data-toggle="modal" data-target="#konfirmasiHapus" data-id="'.$p->kode_barang.'">
                    <i class="fa fa-trash"></i></button>';
                }
                if($pel1->upload_level=="Y"){
                    $upload='
                    <button class="btn btn-sm btn-outline-info update-stokBarang" title="Edit" data-id="'.$p->kode_barang.'"><i class="fa fa-random"></i>
                    </button>
                    ';
                }
                if($pel1->delete_level=="N"){
                    $delete='';
                }
                if($pel1->edit_level=="N"){
                    $edit='';
                }
                if($pel1->upload_level=="N"){
                    $upload='';
                }
                $akses_system=$edit.$delete.$upload;
                $row[] = $akses_system;
                $data[] = $row;
            }
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Mod_barang->count_all(),
            "recordsFiltered" => $this->Mod_barang->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
     public function showList() {
		$data['data'] = $this->Mod_barang->select_barang();
		$this->load->view('master_data/list_barang', $data);
	}
	public function prosesTbarang() {
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->Mod_barang->insertBarang($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_ok_msg('Success', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Filed !', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}
	public function updateBarang() {

		$id 				= trim($_POST['id']);
		$data['userdata'] 	= $this->userdata;
		$data['dataSat']        = $this->Mod_barang->select_satuan();
		$data['dataSup']        = $this->Mod_barang->select_supplier();
		$data['dataBarang'] = $this->Mod_barang->select_id_barang($id);

		echo show_my_modal('master_data/modals/modal_tambah_barang', 'update-barang', $data, ' modal-lg');
	}
	public function updatestokBarang() {

		$id 				= trim($_POST['id']);
		$data['dataSat']        = $this->Mod_barang->select_satuan();
		$data['dataSup']        = $this->Mod_barang->select_supplier();
		$data['dataBarang'] = $this->Mod_barang->select_id_barang($id);

		echo show_my_modal('master_data/modals/modal_update_barang', 'update-stokbarang', $data, ' modal-lg');
	}

	public function prosesUbarang() {
		
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->Mod_barang->updateBarang($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_ok_msg('Success', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_del_msg('Filed!', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}
	public function prosesSbarang() {
		
		$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->Mod_barang->updateStokBarang($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_ok_msg('Success', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_del_msg('Filed!', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function deleteBarang() {
		$id = $_POST['id'];
		$result = $this->Mod_barang->deleteBarang($id);
		
		if ($result > 0) {
			echo show_del_msg('Deleted', '20px');
		} else {
			echo show_err_msg('Failed!', '20px');
		}
	}
	/*Satuan*/
    public function showSat() {
		$data['data'] = $this->Mod_barang->select_satuan();
		$this->load->view('admin/master_data/sat_data', $data);
	}
	public function Satuan() {
		$data['userdata'] = $this->userdata;
		//$data['dataSatuan'] = $this->Mod_barang->select_satuan();

		$data['page'] = "Satuan";
		$data['judul'] = "Satuan Barang";
		$data['deskripsi'] = "Satuan Barang";

		$data['modal_tambah_satuan'] = show_my_modal('admin/master_data/modals/modal_tambah_satuan', 'tambah-satuan', $data);

		$this->template->views('admin/master_data/satuan', $data);
	}
	public function prosesTsatuan() {
		$this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->Mod_barang->insertSatuan($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_ok_msg('Success', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Filed !', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}
	public function updateSatuan() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['dataSatuan'] = $this->Mod_barang->select_id_satuan($id);

		echo show_my_modal('admin/master_data/modals/modal_tambah_satuan', 'update-satuan', $data);
	}

	public function prosesUsatuan() {
		
		$this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->Mod_barang->updateSatuan($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Success', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Filed!', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	/*endsatuan*/
}