<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('calendar');
        $this->load->helper('terbilang');
		
		$this->load->model(array('Mod_supplier'));
        $this->load->model(array('Mod_userlevel'));
		$this->load->helper('tgl_indo_helper');
		$this->load->model('Mod_aplikasi');
	}

	public function index() {
		$data['page'] = "Supplier";
		$data['judul'] = "Data Supplier";
		$data['deskripsi'] = "Supplier";

		$data['modal_tambah_supplier'] = show_my_modal('master_data/modals/modal_tambah_supplier', 'tambah-supplier', $data);

		$this->template->load('layoutbackend', 'master_data/supplier', $data);
	}

    public function showSup() {
		$data['data'] = $this->Mod_supplier->select_supplier();
		$this->load->view('master_data/sup_data', $data);
	}
	public function prosesTsupplier() {
		$this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->Mod_supplier->insertSupplier($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Success', '20px');
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
	public function updateSupplier() {
		$id 				= trim($_POST['id']);
		$data['dataSupplier'] = $this->Mod_supplier->select_id_supplier($id);

		echo show_my_modal('master_data/modals/modal_tambah_supplier', 'update-supplier', $data);
	}

	public function prosesUsupplier() {
		
		$this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->Mod_supplier->updateSupplier($data);

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
	public function deleteSup() {
		$id = $_POST['id'];
		$result = $this->Mod_supplier->deleteSup($id);
		
		if ($result > 0) {
			echo show_ok_msg('Deleted', '20px');
		} else {
			echo show_del_msg('Failed!', '20px');
		}
	}

	/*endsatuan*/
}