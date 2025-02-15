<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('calendar');
        $this->load->helper('terbilang');
		
		$this->load->model(array('transaksi/Mod_promo'));
		$this->load->model(array('Mod_supplier'));
        $this->load->model(array('Mod_userlevel'));
		$this->load->model(array('transaksi/Mod_penjualan'));
		$this->load->helper('tgl_indo_helper');
		$this->load->model('Mod_aplikasi');
	}

	public function index() {
		$data['dataBrg'] = $this->Mod_penjualan->select_harga();
		$data['dataSup']        = $this->Mod_supplier->select_supplier();
		//$data['dPenjualan'] = $this->M_masterdata->select_penjualan();
		//$data['dataDokter'] = $this->M_pendaftaran->select_dokter();
		//$data['dataDiagnosa'] = $this->M_mastermedis->select_diagnosa();
		//$data['dataFinger'] = $this->M_pendaftaran->get_data_absen();
		//$data['dataSatuan'] = $this->M_masterdata->select_satuan();

		$data['page'] = "Promo";
		$data['judul'] = "Barang Promo";
		$data['deskripsi'] = "Data Promo / Diskon";
		$data['modal_cari_barang'] = show_my_modal('transaksi/modals/modal_cari_barang', 'cari-barang', $data, ' modal-md');

		$this->template->load('layoutbackend', 'transaksi/promo', $data);
		
	}
		
	public function cari_barang() {
	$id=$_GET['kode_barang'];
	{
		$data['dataNama'] 	= $this->M_invoice->cari_detail_barang($id);
		$this->load->view('transaksi/cari_barang/barang', $data);
	}
}


    public function prosesPromo() {
		
		$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'trim|required');
				
					
		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->Mod_promo->insertPromo($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_ok_msg('Barang Promo Telah diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Failed! ', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}
		echo json_encode($out);
	}
    public function Out() {
		$data['userdata'] = $this->userdata;
		$data['dataBrg'] = $this->M_transaksi->select_harga();
		$data['dataSup']        = $this->M_masterdata->select_supplier();
		//$data['dPenjualan'] = $this->M_masterdata->select_penjualan();
		//$data['dataDokter'] = $this->M_pendaftaran->select_dokter();
		//$data['dataDiagnosa'] = $this->M_mastermedis->select_diagnosa();
		//$data['dataFinger'] = $this->M_pendaftaran->get_data_absen();
		//$data['dataSatuan'] = $this->M_masterdata->select_satuan();

		$data['page'] = "Transaksi";
		$data['judul'] = "Barang Keluar";
		$data['deskripsi'] = "Data Barang Keluar";
		$data['modal_cari_barang'] = show_my_modal('transaksi/modals/modal_cari_barang', 'cari-barang', $data, ' modal-md');

		$this->template->views('transaksi/invoice_out', $data);
		
	}
     public function prosesKeluar() {
		$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_invoice->outBarang($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_ok_msg('Success', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Failed! ', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}
    public function list_keluar() {
		$id 				= $_GET['datakode'];
		$data['dataKeluar'] = $this->M_invoice->select_keluar($id);
		$this->load->view('transaksi/list_keluar', $data);
	}

    public function tampilDetail() {
		$id 				= $_GET['next_proses'];
		$data['dataDetail'] = $this->M_transaksi->select_kirim($id);
		$this->load->view('transaksi/data_pengiriman', $data);
	}
	public function cari_asal() {
	$id=$_GET['kode_asal'];
		$cari	= $this->M_transaksi->select_asal($id)->result();
        echo json_encode($cari);
	}
	public function cari_tujuan() {
	$id=$_GET['kode_tujuan'];
		$cari	= $this->M_transaksi->select_tujuan($id)->result();
        echo json_encode($cari);
	}
    public function deleteDetail() {
		$id = $_POST['id'];
		$result = $this->M_transaksi->delete_detail($id);

		if ($result > 0) {
			//$out['datakode']=$kodeBaru;
            $out['status'] = '';
			$out['msg'] = show_del_msg('Deleted', '20px');
			} else {
			$out['status'] = '';
			$out['msg'] = show_err_msg('Filed !', '20px');
			}
		echo json_encode($out);
	}
	public function cetak() {
		$id 				= $_POST['id'];
		$data['userdata'] 	= $this->userdata;
		$data['dataKirim'] = $this->M_transaksi->select_by_id($id);
		$data['detailKirim'] = $this->M_transaksi->select_by_detail($id);
		$data['detailSum'] = $this->M_transaksi->select_by_sum($id);

		echo show_my_print('transaksi/modals/modal_cetak_ttb', 'cetak-ttb', $data, ' modal-xl');
	}
}