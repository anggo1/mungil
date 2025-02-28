<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataPenjualan extends MY_Controller {
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
		$data['judul'] = "Periode Penjualan";
		$data['deskripsi'] = "Pencarian per periode";

		$this->template->load('layoutbackend', 'laporan/rperiode', $data);
			
	    }
	public function list_pertanggal() {

        $date = $this->input->get('date1', TRUE);
        $date2 = $this->input->get('date2', TRUE);
		$tgl1 = explode('-',$date);	
		$tgl2 = explode('-',$date2);		
		$ttmp1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."";
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
		
    	    $data['dataHarian'] = $this->Mod_data_penjualan->cari_periode($ttmp1,$ttmp2); 

			$this->load->view('laporan/rperiode_data', $data);
			
	    }
    //laporan Barang Keluar
	public function Barang_keluar() {

		$data['page'] = "Laporan";
		$data['judul'] = "Rekapitulasi Barang Keluar";
		$data['deskripsi'] = "Barang Keluar";

		$this->template->views('laporan/bperiode', $data);
			
	    }
	public function bPeriode() {

		$data['page'] = "Laporan";
		$data['judul'] = "Rekapitulasi Barang Keluar";
		$data['deskripsi'] = "Barang Keluar";
	
        $date = $this->input->post('date', TRUE);
        $date2 = $this->input->post('date2', TRUE);
		$tgl1 = explode('-',$date);	
		$tgl2 = explode('-',$date2);		
		$ttmp1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."";
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
		
    	    $data['dataBarang'] = $this->M_laporan->cari_barang($ttmp1,$ttmp2); 

		$this->template->views('laporan/bperiode', $data);
			
	    }
    public function exportBarangKeluar() {
      
        $date = $this->input->get('tgl', TRUE);
        $date2 = $this->input->get('tgl2', TRUE);
		$tgl1 = explode('-',$date);	
		$tgl2 = explode('-',$date2);		
		$ttmp1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."";
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
		
    	    $data['dataBarang'] = $this->M_laporan->cari_barang($ttmp1,$ttmp2); 
            $this->load->view('laporan/bperiode_excel', $data);
		 

	}
    //laporan Barang Masuk
	public function Barang_masuk() {
		$data['page'] = "Laporan";
		$data['judul'] = "Rekapitulasi Barang Masuk";
		$data['deskripsi'] = "Barang Masuk";

		$this->template->views('laporan/mperiode', $data);
			
	    }
	public function mPeriode() {
		$data['page'] = "Laporan";
		$data['judul'] = "Rekapitulasi Barang Masuk";
		$data['deskripsi'] = "Barang Masuk";
	
        $date = $this->input->post('date', TRUE);
        $date2 = $this->input->post('date2', TRUE);
		$tgl1 = explode('-',$date);	
		$tgl2 = explode('-',$date2);		
		$ttmp1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."";
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
		
    	    $data['dataBarang'] = $this->M_laporan->cari_barang_masuk($ttmp1,$ttmp2); 

		$this->template->views('laporan/mperiode', $data);
			
	    }
     public function exportBarangMasuk() {
      
        $date = $this->input->get('tgl', TRUE);
        $date2 = $this->input->get('tgl2', TRUE);
		$tgl1 = explode('-',$date);	
		$tgl2 = explode('-',$date2);		
		$ttmp1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."";
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
		
    	    $data['dataBarang'] = $this->M_laporan->cari_barang_masuk($ttmp1,$ttmp2); 
            $this->load->view('laporan/mperiode_excel', $data);
		 

	}
    //laporan Barang Promo
	public function Promo() {

		$data['page'] = "Laporan";
		$data['judul'] = "Rekapitulasi Promo";
		$data['deskripsi'] = "Barang Keluar";

		$this->template->views('laporan/pperiode', $data);
			
	    }
	public function pPromo() {

		$data['page'] = "Laporan";
		$data['judul'] = "Rekapitulasi Promo";
		$data['deskripsi'] = "Barang Promo";
	
        $date = $this->input->post('date', TRUE);
        $date2 = $this->input->post('date2', TRUE);
		$tgl1 = explode('-',$date);	
		$tgl2 = explode('-',$date2);		
		$ttmp1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."";
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
		
    	    $data['dataPromo'] = $this->M_laporan->cari_promo($ttmp1,$ttmp2); 

		$this->template->views('laporan/pperiode', $data);
			
	    }
	public function exportBarangPromo() {
      
        $date = $this->input->get('tgl', TRUE);
        $date2 = $this->input->get('tgl2', TRUE);
		$tgl1 = explode('-',$date);	
		$tgl2 = explode('-',$date2);		
		$ttmp1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."";
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
		
    	    $data['dataPromo'] = $this->M_laporan->cari_promo($ttmp1,$ttmp2);  
            $this->load->view('laporan/pperiode_excel', $data);
		 

	}
    public function deletePromo() {
		$id = $_POST['id'];
		$result = $this->M_laporan->deletePromo($id);
		
		if ($result > 0) {
			echo show_succ_msg('Deleted', '20px');
		} else {
			echo show_err_msg('Failed!', '20px');
		}
	}
	  //laporan Supplier
	public function Supplier() {
		$data['dataCariSupplier'] = $this->M_laporan->selectSupplier();
        
		$data['page'] = "Laporan";
		$data['judul'] = "Rekapitulasi Supplier";
		$data['deskripsi'] = "Data Supplier";
		$data['modal_cari_supplier'] = show_my_modal('laporan/modals/modal_cari_supplier','cari_supplier',$data,'modal-md');
		$this->template->views('laporan/speriode', $data);
			
	    }
	public function sPeriode() {
		$data['dataCariSupplier'] = $this->M_laporan->selectSupplier();

		$data['page'] = "Laporan";
		$data['judul'] = "Rekapitulasi Supplier";
		$data['deskripsi'] = "Data Supplier";
		$data['modal_cari_supplier'] = show_my_modal('laporan/modals/modal_cari_supplier','cari_supplier',$data,'modal-md');
	
        $datasup = $this->input->post('id_supplier', TRUE);
        $date = $this->input->post('date', TRUE);
        $date2 = $this->input->post('date2', TRUE);
		$tgl1 = explode('-',$date);	
		$tgl2 = explode('-',$date2);		
		$ttmp1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."";
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
		$data['dataSupplier'] = $this->M_laporan->rekap_supplier($datasup,$ttmp1,$ttmp2);
		$this->template->views('laporan/speriode', $data);
			
	    }
    public function exportSupplier() {
              
        $datasup = $this->input->get('id', TRUE);
        $date = $this->input->get('tgl', TRUE);
        $date2 = $this->input->get('tgl2', TRUE);
		$tgl1 = explode('-',$date);	
		$tgl2 = explode('-',$date2);		
		$ttmp1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."";
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
		$data['dataSupplier'] = $this->M_laporan->rekap_supplier($datasup,$ttmp1,$ttmp2); 
            $this->load->view('laporan/speriode_excel', $data);
		 

	}
	
	  //laporan Konsumen
	public function Konsumen() {
		$data['page'] = "Laporan";
		$data['judul'] = "Rekapitulasi Konsumen";
		$data['deskripsi'] = "Data Konsumen";

		$this->template->views('laporan/kperiode', $data);
			
	    }
	public function kPeriode() {

		$data['page'] = "Laporan";
		$data['judul'] = "Rekapitulasi Konsumen";
		$data['deskripsi'] = "Data Konsumen";
	
        $date = $this->input->post('date', TRUE);
        $date2 = $this->input->post('date2', TRUE);
		$tgl1 = explode('-',$date);	
		$tgl2 = explode('-',$date2);		
		$ttmp1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."";
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
		
    	    $data['dataKonsumen'] = $this->M_laporan->cari_konsumen($ttmp1,$ttmp2); 

		$this->template->views('laporan/kperiode', $data);
			
	    }
    public function exportKonsumen() {
      
        $datasup = $this->input->get('id', TRUE);
        $date = $this->input->get('tgl', TRUE);
        $date2 = $this->input->get('tgl2', TRUE);
		$tgl1 = explode('-',$date);	
		$tgl2 = explode('-',$date2);		
		$ttmp1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."";
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
    	    $data['dataKonsumen'] = $this->M_laporan->cari_konsumen($ttmp1,$ttmp2);  
            $this->load->view('laporan/kperiode_excel', $data);
		 

	}
	
	
		
	public function personal() {
		$data['dataPegawai'] = $this->M_pegawai->select_all();

		$data['page'] = "Report";
		$data['judul'] = "Report";
		$data['deskripsi'] = "Laporan Perkaryawan";
		$this->template->views('absensi/hpersonal', $data);
	}
	public function ByNip() {
		$data['dataPegawai'] = $this->M_pegawai->select_all();

		$data['page'] = "Report";
		$data['judul'] = "Report";
		$data['deskripsi'] = "Laporan Perkaryawan";
		$nip = $this->input->post('nip', TRUE);
        $date = $this->input->post('date', TRUE);
        $date2 = $this->input->post('date2', TRUE);
		$tgl1 = explode('-',$date);	
		$tgl2 = explode('-',$date2);		
		$ttmp1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."";
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
		
    	    $data['dataAbsen'] = $this->M_absensi->cari_absen_pers($nip,$ttmp1,$ttmp2); 

		$this->template->views('absensi/hpersonal', $data);
	    }
		
	public function device() {
		$data['dataDevice'] = $this->M_absensi->selectDevice();

		$data['page'] = "Absensi";
		$data['judul'] = "Pengaturan/Mesin";
		$data['deskripsi'] = "Pengaturan Mesin";

		$this->template->views('device/home', $data);
		
	}
	
	public function exportPersonal() {
		$nip = $this->input->get('nip', TRUE);
        $date = $this->input->get('tgl1', TRUE);
        $date2 = $this->input->get('tgl2', TRUE);
		$tgl1 = explode('-',$date);	
		$tgl2 = explode('-',$date2);		
		$ttmp1 = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0]."";
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();
    	    $data = $this->M_absensi->cari_absen_pers($nip,$ttmp1,$ttmp2);  
			
		//$data = $this->M_pegawai->select_all_pegawai();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, "NIP");
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, "Nama");
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, "Time Log");
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, "CheckType");
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, "Deskripsi");
		$rowCount++;

		foreach($data as $value){			
			$datetime = new DateTime($value->checktime);
			$date = $datetime->format('d-m-Y H:i:s');
			$status='';
			if($value->checktype=='0') { $status='Masuk'; } else { $status='Pulang';}
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->nip); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->nama_depan); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $date); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->checktype); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $status); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Report Personal.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Report Personal.xlsx', NULL);
	}

}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */