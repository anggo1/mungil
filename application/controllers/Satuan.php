<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('calendar');
        $this->load->helper('terbilang');
		
		$this->load->model(array('Mod_satuan'));
        $this->load->model(array('Mod_userlevel'));
		$this->load->helper('tgl_indo_helper');
		$this->load->model('Mod_aplikasi');
	}


    public function index()
	{
		$data['dataSatuan'] = $this->Mod_satuan->select_satuan();

		$data['page'] = "Satuan";
		$data['judul'] = "Satuan Barang";
		$data['deskripsi'] = "Satuan Barang";

		$data['modal_tambah_satuan'] = show_my_modal('master_data/modals/modal_tambah_satuan', 'tambah-satuan', $data);

		$this->template->load('layoutbackend', 'master_data/satuan', $data);
	}
    public function showSat() {
		$data['data'] = $this->Mod_satuan->select_satuan();
		$this->load->view('master_data/sat_data', $data);
	}
	public function prosesTsatuan() {
		$this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->Mod_satuan->insertSatuan($data);

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
		$id 				= trim($_POST['id']);
		$data['dataSatuan'] = $this->Mod_satuan->select_id_satuan($id);

		echo show_my_modal('master_data/modals/modal_tambah_satuan', 'update-satuan', $data);
	}

	public function prosesUsatuan() {
		
		$this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->Mod_satuan->updateSatuan($data);

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
	public function deleteSatuan() {
		$id = $_POST['id'];
		$result = $this->Mod_barang->deleteSatuan($id);
		
		if ($result > 0) {
			echo show_del_msg('Deleted', '20px');
		} else {
			echo show_err_msg('Failed!', '20px');
		}
	}
	/*endsatuan*/
}