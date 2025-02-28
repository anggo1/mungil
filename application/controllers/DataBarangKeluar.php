<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataBarangKeluar extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('calendar');
        $this->load->helper('terbilang');
		
		$this->load->model(array('Mod_data_penjualan'));
        $this->load->model(array('Mod_userlevel'));
		$this->load->helper('tgl_indo_helper');
		$this->load->model('Mod_aplikasi');
	}


	public function index() {
		$data['page'] = "Laporan";
		$data['judul'] = "Rekapitulasi Barang Keluar";
		$data['deskripsi'] = "Barang Keluar";

		$this->template->load('layoutbackend', 'laporan/bperiode', $data);
			
	    }
	public function list_keluar() {

        $date = $this->input->get('date1', TRUE);
        $date2 = $this->input->get('date2', TRUE);
		$tgl1 = explode('-',$date);	
		$tgl2 = explode('-',$date2);		
		$ttmp1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."";
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
		
    	    $data['dataHarian'] = $this->Mod_data_penjualan->cari_keluar($ttmp1,$ttmp2); 

			$this->load->view('laporan/rperiode_data', $data);
			
	    }
	}