<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('calendar');
        $this->load->helper('terbilang');
		
		$this->load->model(array('transaksi/Mod_penjualan'));
        $this->load->model(array('Mod_userlevel'));
		$this->load->helper('tgl_indo_helper');
		$this->load->model('Mod_aplikasi');
	}

	public function index() {
		$data['dataBrg'] = $this->Mod_penjualan->select_harga();
		//$data['dataNama'] = $this->Mod_penjualan->select_konsumen();

		$data['page'] 		= "Transaksi";
		$data['judul'] 		= "Penjualan";
		$data['deskripsi'] 	= "Penjualan Barang";
		$data['modal_cari_barang'] = show_my_modal('transaksi/modals/modal_cari_barang', 'cari-barang', $data, ' modal-lg');

		$this->template->load('layoutbackend', 'transaksi/penjualan', $data);
	}

	public function updateDetailPenjualan()
	{
        $id = $_POST['id'];
        $jml_part = $_POST['jml_part'];
        $hrg_part = $_POST['hrg_part'];
		$data['dataPo'] = $this->Mod_penjualan->update_detailPenjualan($id,$jml_part,$hrg_part);
		//$this->load->view('body_repair/detail_estimasi', $data);
	}
public function cari_harga() {	
	$kode=$_GET['kode'];
	
		$cari	= $this->Mod_penjualan->select_harga2($kode)->result();
        echo json_encode($cari);
	
}
    public function isi_harga() {	
	$id=$_GET['kode'];
	
		$cari	= $this->Mod_penjualan->select_isi($id)->result();
        echo json_encode($cari);
	
} public function isi_harga2($kode) {	
	$id=$_GET['kode'];
	
		$cari	= $this->Mod_penjualan->select_isi($id)->result();
        echo json_encode($cari);
	
}
    
	public function prosesTtransaksi() {  
	
	date_default_timezone_set('Asia/Jakarta'); 
    $date= date("Ymd");
    $ci = get_instance();
    $query = "SELECT max(id_penjualan) as maxKode FROM tbl_penjualan WHERE id_penjualan LIKE '%$date%'";
    $data = $ci->db->query($query)->row_array();
	$noOrder = $data['maxKode'];
	$noUrut = (int) substr($noOrder, 10, 3);
	$noUrut++;
	$char = "KM";
	$tahun=substr($date, 0, 4);
	$bulan=substr($date, 4, 2);
	$tgl=substr($date, 6, 2);
	$kodeExtract  = $char .$tahun .$bulan .$tgl . sprintf("%03s", $noUrut);
        
    //$data['dataDaftar'] 	= $this->Mod_penjualan->noDaftar();
	$this->form_validation->set_rules('nama', 'Pengirim', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {        
        $result=$this->input->post('data_pengiriman');
		$tgl_buat= date("Y-m-d");
		$tgl2 = explode('-',$tgl_buat);
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";		
		$sekarang = date('Y/m/d');
		$jam	= date('H:i:s');

			$kodeBaru = '';
		if(empty($data['next_proses'])){
			$kodeBaru = $kodeExtract;
			
			$data2 = array(
				'id_penjualan'  =>$kodeBaru,
				'tgl_buat'  =>$ttmp2,
				'jam_transaksi'  =>$jam,
				'nama_konsumen'      =>$data['nama'],
				'pembuat'     =>$data['pembuat'],
				'status'     =>'N'              
				);
	
            $data['dataPengiriman'] = $this->db->insert('tbl_penjualan',$data2);   
			$data['dataPengiriman'] =  $this->Mod_penjualan->insertjual($kodeBaru,$data);
		}
		if(!empty($data['next_proses'])){
			$kodeBaru = $data['next_proses'];
			$data['dataPengiriman'] =  $this->Mod_penjualan->insertjual($kodeBaru,$data);
		}

        if ($data['dataPengiriman'] == true) {
	        $out['datakode']=$kodeBaru;
		    $out['status'] = '';
			$out['msg'] = show_ok_msg('Data Penjualan Baru', '20px');
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
	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_kota->delete($id);
		if ($result > 0) {
            
	        $out['datakode']=$kodeBaru;
			$out['msg'] = show_succ_msg('Data Kota Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Kota Gagal dihapus', '20px');
		}
	}

    public function prosesJual() {
		$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'trim|required');
		$this->form_validation->set_rules('jml_barang', 'Jumlah Barang', 'trim|required');
		$date= date("Ymd");
		$ci = get_instance();
		$query = "SELECT max(id_penjualan) as maxKode FROM tbl_penjualan WHERE id_penjualan LIKE '%$date%'";
		$data = $ci->db->query($query)->row_array();
		$noOrder = $data['maxKode'];
		$noUrut = (int) substr($noOrder, 10, 3);
		$noUrut++;
		$char = "KM";
		$tahun=substr($date, 0, 4);
		$bulan=substr($date, 4, 2);
		$tgl=substr($date, 6, 2);
		$kodeBaru  = $char .$tahun .$bulan .$tgl . sprintf("%03s", $noUrut);

		$ci = get_instance();
		$q_stok= "SELECT stok as stok_akhir FROM tbl_barang WHERE kode_barang = '" .$_POST['kode_barang'] ."'";
		$data_stok = $ci->db->query($q_stok)->row_array();
		$stok_akhir= $data_stok['stok_akhir'];
		$kurang=$_POST['jml_barang'];
		$hasil=$stok_akhir-$kurang;
		if($hasil < 0){
            
		//$this->session->set_flashdata('konfirmasiKosong', show_my_confirm('konfirmasiKosong'));
		}

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->Mod_penjualan->insertjual($data);

			if ($result > 0) {
                $out['datakode'] =$data['next_proses'];
				$out['status'] = '';
				$out['msg'] = show_ok_msg('Data Telah ditambahkan', '20px');
			} else {
                $out['datakode'] =$data['next_proses'];
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Gagal ditambahkan', '20px');
			}
		} else {
            $out['datakode'] =$kodeBaru;
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}
	public function cari_sum() {	
	$kode=$_GET['kode'];
	
		$sum	= $this->Mod_penjualan->select_sum($kode)->result();
        echo json_encode($sum);
	
}
	public function update_detail() {

		$id 				= trim($_POST['id']);
		$data['userdata'] 	= $this->userdata;
		$data['dataDetail'] = $this->Mod_penjualan->select_detail($id);
		//$data['dataPromo'] = $this->Mod_penjualan->cari_promo($id);

		echo show_my_modal('transaksi/modals/modal_edit_detail', 'edit-detail', $data, ' modal-sm');
	}
    public function proses_edit() {
		
		$this->form_validation->set_rules('id_detail', 'Tidak Ada Barang', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->Mod_penjualan->updateDetail($data);

			if ($result > 0) {
                $out['datakode'] =trim($_POST['id_penjualan']);
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
    
    public function tampilDetail() {
		$id 				= $_GET['next_proses'];
		$data['dataDetail'] = $this->Mod_penjualan->select_jual($id);
		$this->load->view('transaksi/data_penjualan', $data);

	}
	
	public function dataPenjualan() {
		$data['userdata'] = $this->userdata;
		//$data['dataPenjualan'] = $this->Mod_penjualan->select_penjualan();
		$data['dataBayar'] = $this->Mod_penjualan->select_bayar();
		$data['page'] = "Transaksi";
		$data['judul'] = "Data Penjualan";
		$data['deskripsi'] = "Data Penjualan Harian";

		$this->template->views('transaksi/data_penjualan/data_penjualan', $data);
		echo show_my_modal('transaksi/modals/modal_cetak_harian', 'modal-harian', $data, ' modal-sm');
	}
    public function list_penjualan() {
        $dateid 				= $_GET['date1'];
		$tgl2 = explode('-',$dateid);
		$ttmp2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
		$data['dataPenjualan'] = $this->Mod_penjualan->select_penjualan_id($ttmp2);
		$this->load->view('transaksi/data_penjualan/list_penjualan', $data);
	}
    public function cetakHarian() {
		$data['userdata'] = $this->userdata;
		$dateid = $_POST['date1'];
		$tgl2   = explode('-',$dateid);
		$ttmp2  = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]."";
		$data['dataPenjualan'] = $this->Mod_penjualan->select_penjualan_id($ttmp2);

		echo show_my_modal('transaksi/modals/modal_cetak_harian', 'modal-harian', $data, ' modal-sm');
	}
    public function export_penjualan() {
		$data['userdata'] = $this->userdata;
		$data['dataPenjualan'] = $this->Mod_penjualan->select_penjualan();
		$data['dataBayar'] = $this->Mod_penjualan->select_bayar();
		$this->load->view('transaksi/data_penjualan/export_data_penjualan', $data);
		
	}
	
    public function deleteDetail() {
		$id = $_POST['id'];
		$result = $this->Mod_penjualan->delete_detail($id);

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
	public function deletePenjualan() {
		$id = $_POST['id'];
		$result = $this->Mod_penjualan->delete_penjualan($id);

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
		$id 				= $_POST['kode_t'];
        $this->form_validation->set_rules('kode_t', 'Tidak Ada Barang', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->Mod_penjualan->updateKirim($data);	
	
		$data['dataKirim'] = $this->Mod_penjualan->select_by_id($id);
		$data['detailKirim'] = $this->Mod_penjualan->select_by_detail($id);
		$data['detailSum'] = $this->Mod_penjualan->select_by_sum($id);

		echo show_my_print('transaksi/modals/modal_cetak_penjualan', 'cetak-ttb', $data, ' modal-sm');
	}
    }
    public function cetak_ulang() {
		$id 				= $_POST['id'];
		$data['dataKirim'] = $this->Mod_penjualan->select_by_id($id);
		$data['detailKirim'] = $this->Mod_penjualan->select_by_detail($id);
		$data['detailSum'] = $this->Mod_penjualan->select_by_sum($id);

		echo show_my_print('transaksi/modals/modal_cetak_penjualan', 'cetak-ttb', $data, ' modal-sm');
	}
    
    public function prosesDsetor() {
     
        $id_kiriman = $this->input->post('id_kiriman');
	       $this->form_validation->set_rules('ptd1', 'Keterangan', 'trim|required');
        
		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->Mod_penjualan->insertData_detail($data);

			if ($result > 0) {
	            $out['datasetor']=$id_kiriman;
				$out['status'] = '';
				$out['msg'] = show_ok_msg('Success!', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_del_msg('Data Pengiriman Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}
   
    public function cetak_setor() {
		$id 				= $_POST['id'];
		$data['userdata'] 	= $this->userdata;
		$data['dataKirim'] = $this->Mod_penjualan->select_setor_id($id);

		echo show_my_print('transaksi/modals/modal_cetak_setor', 'cetak-setoran', $data, ' modal-xl');
	}
}