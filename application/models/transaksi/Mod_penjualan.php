<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_penjualan extends CI_Model {
	var $table = "tbl_konsumen";
	var $column_order = array(null, 'id_konsumen', 'nama','no_telp','alamat'); //set column field database for datatable orderable
	var $column_search = array('nama_konsumen','no_telp','alamat'); //set column field database for datatable searchable
	var $order = array('id_konsumen' => 'desc'); // default order

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column_search as $item) // loop column
		{
			if($_POST['search']['value'])
			{
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if(isset($_POST['order']))
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
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

public function select_by_pengiriman($id) {
		$sql = "SELECT *FROM data_pengiriman WHERE id_kirim='{$id}' ";

		$data = $this->db->query($sql);

		return $data->result();
	}
    public function select_by_id($id) {
        $sql = "SELECT * FROM tbl_penjualan
                LEFT JOIN tbl_konsumen ON tbl_konsumen.id_konsumen=tbl_penjualan.id_konsumen 
                LEFT JOIN tbl_detail_penjualan ON tbl_detail_penjualan.id_penjualan=tbl_penjualan.id_penjualan 
                WHERE tbl_penjualan.id_penjualan='{$id}' ";
		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_penjualan() {
        $date= date("Y-m-d");
		$sql = "SELECT tbl_penjualan.id_penjualan AS id_penjualan
				,tbl_penjualan.total AS total_harganya
				,tbl_penjualan.pembayaran AS pembayaran
				,tbl_penjualan.diskon AS diskon
				,tbl_penjualan.jumlah_diskon AS jumlah_diskon
				,tbl_penjualan.tgl_buat AS tgl_buat
				,tbl_penjualan.jam_transaksi AS jam_transaksi
				,tbl_penjualan.pembuat AS pembuat
				,tbl_konsumen.nama_konsumen AS nama_konsumen,
				SUM(tbl_detail_penjualan.total_harga)AS harusnya,
				tbl_detail_penjualan.jumlah AS jumlahnya,
				SUM(tbl_barang.harga_beli)AS modal
				FROM tbl_penjualan
				LEFT JOIN tbl_konsumen ON tbl_konsumen.id_konsumen=tbl_penjualan.id_konsumen
				LEFT JOIN tbl_detail_penjualan ON tbl_detail_penjualan.id_penjualan=tbl_penjualan.id_penjualan
                LEFT JOIN tbl_barang ON tbl_barang.kode_barang=tbl_detail_penjualan.kode_barang
				WHERE tgl_buat='$date' AND total !=0
				GROUP BY tbl_penjualan.id_penjualan ORDER BY tbl_penjualan.jam_transaksi DESC";

		$data = $this->db->query($sql);

		return $data->result();
	}
    public function select_penjualan_id($dateid) {
        $date= date("Y-m-d");
		$sql = "SELECT tbl_penjualan.id_penjualan AS id_penjualan
				,tbl_penjualan.total AS total_harganya
				,tbl_penjualan.pembayaran AS pembayaran
				,tbl_penjualan.diskon AS diskon
				,tbl_penjualan.jumlah_diskon AS jumlah_diskon
				,tbl_penjualan.tgl_buat AS tgl_buat
				,tbl_penjualan.jam_transaksi AS jam_transaksi
				,tbl_penjualan.pembuat AS pembuat
				,tbl_konsumen.nama_konsumen AS nama_konsumen,
				SUM(tbl_detail_penjualan.total_harga)AS harusnya,
				tbl_detail_penjualan.jumlah AS jumlahnya,
				SUM(tbl_barang.harga_beli)AS modal
				FROM tbl_penjualan
				LEFT JOIN tbl_konsumen ON tbl_konsumen.id_konsumen=tbl_penjualan.id_konsumen
				LEFT JOIN tbl_detail_penjualan ON tbl_detail_penjualan.id_penjualan=tbl_penjualan.id_penjualan
                LEFT JOIN tbl_barang ON tbl_barang.kode_barang=tbl_detail_penjualan.kode_barang
				WHERE tgl_buat='$dateid' AND total !=0
				GROUP BY tbl_penjualan.id_penjualan ORDER BY tbl_penjualan.jam_transaksi DESC";

		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_bayar() {
        $date= date("Y-m-d");
		$sql = "SELECT 
		SUM(CASE
        WHEN pembayaran = 'cash' THEN sisa_bayar 
		END) cash,
    	SUM(CASE
        WHEN pembayaran = 'transfer' THEN sisa_bayar 
    	END) transfer,
    	SUM(CASE
		WHEN pembayaran = 'debit' THEN sisa_bayar 
    	END) debit
    		FROM
    		tbl_penjualan WHERE tgl_buat='$date'";

		$data = $this->db->query($sql);

		return $data->result();
	}
    public function select_by_sum($id) {
        //sum(jumlah) as total_jumlah, 
        //sum(potongan) as total_potongan 
        $sql = "SELECT tbl_penjualan.jumlah_diskon AS jml_diskon,tbl_penjualan.pembayaran AS bayar,tbl_penjualan.diskon AS pot_diskon,tbl_penjualan.pembayaran AS pembayaran,
        sum(total_harga)as total_harganya,sum(jumlah) as total_jumlah FROM tbl_detail_penjualan
        INNER JOIN tbl_penjualan USING (id_penjualan)
        WHERE id_penjualan='{$id}' ";
		$data = $this->db->query($sql);

		return $data->result();
	}
     public function select_by_detail($id) {
        $sql = "SELECT * FROM tbl_detail_penjualan WHERE id_penjualan='{$id}' ";

		$data = $this->db->query($sql);

		return $data->result();
	}
	public function cari_riwayat_konsumen($id) {
		$sql = "SELECT *
				FROM tbl_penjualan
				LEFT JOIN data_selesai_kirim ON data_selesai_kirim.id_konsumen=data_pengiriman.id_konsumen
				LEFT JOIN data_konsumen ON data_konsumen.id_konsumen=data_pengiriman.id_konsumen
				LEFT JOIN   pangkalan ON pangkalan.pangkalan=data_pengiriman.asal WHERE data_pengiriman.id_konsumen = '{$id}' ORDER BY data_pengiriman.id_konsumen DESC LIMIT 1";

		$data = $this->db->query($sql);
		return $data->result();
		//return $data->row();
	}
	public function cari_nama_konsumen($id) {
		$sql = "SELECT * FROM data_konsumen WHERE nama like '%{$id}%' OR no_telp like '%{$id}%'";

		$data = $this->db->query($sql);
		return $data->result();
		//return $data->row();
	}
	public function select_wilayah() {
		$sql = " SELECT * FROM pangkalan";

		$data = $this->db->query($sql);

		return $data->result();
	}
    public function select_konsumen() {
		$sql = " SELECT * FROM tbl_konsumen";

		$data = $this->db->query($sql);

		return $data->result();
	}
    public function select_jual($id) {
		$sql = "SELECT * FROM tbl_detail_penjualan WHERE id_penjualan ='{$id}'";

		$data = $this->db->query($sql);
		return $data->result();
		//return $data->row();
	}
    public function insertjual($kodeBaru,$data) {
        $date= date("Y-m-d");
		$potongan = '';
				$ci = get_instance();
				$q_stok= "SELECT stok AS stok_akhir, harga_eceran AS harganya, nama_barang,id_satuan
				FROM tbl_barang 
				WHERE kode_barang = '" .$data['kode_barang'] ."'";
				$data_stok = $ci->db->query($q_stok)->row_array();
				$stok_akhir= $data_stok['stok_akhir'];
				$kurang=$data['jml_barang'];
				$harga=$data_stok['harganya'];
				$nama_barang=$data_stok['nama_barang'];
				$satuan=$data_stok['id_satuan'];
				$total_stok= $stok_akhir-$kurang;
		
        
				//Cek Promo
				//$harga  =$data['harga'];

				$ci_promo = get_instance();
				$q_promo= "SELECT * FROM tbl_promo WHERE kode_barang = '" .$data['kode_barang'] ."' AND tgl_promo='$date'";
				$d_promo = $ci_promo->db->query($q_promo)->row_array();
				if(!empty($d_promo)){
				$bentuk_promo=$d_promo['promo'];
				$nilai_promo=$d_promo['jml_promo'];

				if($bentuk_promo =='P'){			
					$harga  = $data_stok['harganya']-($data_stok['harganya'] * $nilai_promo/100);  
					$potongan = $data_stok['harganya'] * $nilai_promo/100;
					//$potongan = $nilai_promo;
				 }

				if($bentuk_promo =='R'){
					$potongan = $nilai_promo;
					$harga  = $data_stok['harganya'] - $nilai_promo;
				}
				}
		$sql_barang = "UPDATE tbl_barang SET stok='$total_stok'	WHERE kode_barang='" .$data['kode_barang'] ."'";
		$this->db->query($sql_barang);
        $status='';
        $harga_final='';
		
        if(!empty($nilai_promo)){
            $harga_final=$harga*$data['jml_barang'];
			$barangnya	=$nama_barang.'(Event Promo)';
			$status	='EP';
        }else{
			$harga_final=$harga*$data['jml_barang'];
			$barangnya	=$nama_barang;
			$status	='';
		}
		$sql = "INSERT INTO tbl_detail_penjualan SET
        id_detail       ='',
        id_penjualan    ='$kodeBaru',
        kode_barang     ='".$data['kode_barang']."',
        nama_barang     ='$barangnya',
        satuan          ='$satuan',
        harga_dasar     ='".$data_stok['harganya']."',
        harga           ='$harga',
        jumlah          ='".$data['jml_barang']."',
        potongan   		='$potongan',
        total_harga     ='$harga_final',
        status     		='$status'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	public function select_detail($id) {
        $sql = "SELECT * FROM tbl_detail_penjualan WHERE id_detail='{$id}' ";

		$data = $this->db->query($sql);

		return $data->result();
	}
    
    public function select_isi($id) {
		$sql = "SELECT SUM(jumlah) as total_jumlah,SUM(total_harga) AS total_harganya FROM tbl_detail_penjualan WHERE id_penjualan ='{$id}'";

		$data = $this->db->query($sql);
		return $data;
		//return $data->row();
	}
    public function select_harga() {
		$sql = " SELECT tbl_barang.kode_barang,tbl_barang.nama_barang,tbl_barang.stok,tbl_barang.harga_eceran,
		tbl_barang.id_satuan,tbl_barang.id_supplier, 
        tbl_satuan.nama_satuan,tbl_supplier.nama_supplier FROM tbl_barang
                    LEFT JOIN tbl_satuan ON tbl_satuan.id_satuan=tbl_barang.id_satuan
                    LEFT JOIN tbl_supplier ON tbl_supplier.id_supplier=tbl_barang.id_supplier";

		$data = $this->db->query($sql);

		return $data->result();
	}
	public function select_harga2($kode) {
        $sql = "SELECT tbl_barang.kode_barang,tbl_barang.nama_barang,tbl_barang.stok,tbl_barang.harga_eceran,
		tbl_barang.id_satuan,tbl_barang.id_supplier, 
        tbl_satuan.nama_satuan,tbl_supplier.nama_supplier FROM tbl_barang
                    LEFT JOIN tbl_satuan ON tbl_satuan.id_satuan=tbl_barang.id_satuan
                    LEFT JOIN tbl_supplier ON tbl_supplier.id_supplier=tbl_barang.id_supplier WHERE kode_barang='{$kode}'";
        $data = $this->db->query($sql);
		return $data;
			
		//$sql = "SELECT * FROM tbl_pasien WHERE no_rekamedis = '{$no_rekamedis}'";
		

		//$data = $this->db->query($sql);
		//return $data->result();
		//return $data->row();
	}
	public function select_sum($sum) {
        $sql = "SELECT sum(total_harga)as total_harganya,
        sum(jumlah) as total_jumlah, 
        sum(potongan) as total_potongan FROM tbl_detail_penjualan
        WHERE id_penjualan='{$sum}'";
        $data = $this->db->query($sql);
		return $data;
			
		//$sql = "SELECT * FROM tbl_pasien WHERE no_rekamedis = '{$no_rekamedis}'";
		

		//$data = $this->db->query($sql);
		//return $data->result();
		//return $data->row();
	}


    public function delete_detail($id) {       
        $ci = get_instance();
		$q_stok= "SELECT tbl_detail_penjualan.kode_barang AS kode, tbl_detail_penjualan.jumlah AS jml,tbl_barang.stok AS stok FROM tbl_detail_penjualan
LEFT JOIN tbl_barang ON tbl_barang.kode_barang=tbl_detail_penjualan.kode_barang
WHERE tbl_detail_penjualan.id_detail='{$id}'";
		$data_stok = $ci->db->query($q_stok)->row_array();
		$kode_barang= $data_stok['kode'];
		$awal=$data_stok['jml'];
		$akhir=$data_stok['stok'];        
        
		$total_stok= $awal+$akhir;
        
        $sql_barang = "UPDATE tbl_barang SET stok='$total_stok'	WHERE kode_barang='$kode_barang'";
		$this->db->query($sql_barang);
        
		$sql = "DELETE FROM tbl_detail_penjualan WHERE id_detail='{$id}'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	public function delete_penjualan($id) {       
        $ci = get_instance();
		$q_stok= "SELECT tbl_detail_penjualan.kode_barang AS kode, tbl_detail_penjualan.jumlah AS jml,tbl_barang.stok AS stok FROM tbl_detail_penjualan
LEFT JOIN tbl_barang ON tbl_barang.kode_barang=tbl_detail_penjualan.kode_barang
WHERE tbl_detail_penjualan.id_penjualan='{$id}'";
		$data_stok = $ci->db->query($q_stok)->row_array();
		$kode_barang= $data_stok['kode'];
		$awal=$data_stok['jml'];
		$akhir=$data_stok['stok'];        
        
		$total_stok= $awal+$akhir;
        
        $sql_barang = "UPDATE tbl_barang SET stok='$total_stok'	WHERE kode_barang='$kode_barang'";
		$this->db->query($sql_barang);
        
		$sql_detail = "DELETE FROM tbl_detail_penjualan WHERE id_penjualan='{$id}'";
		$this->db->query($sql_detail);
		$sql = "DELETE FROM tbl_penjualan WHERE id_penjualan='{$id}'";
		$this->db->query($sql);

		return $this->db->affected_rows();
	}
    
	public function total_rows() {
		$data = $this->db->get("data_pengiriman WHERE kirim = 'N'");
		return $data->num_rows();
}
    //Setoran
    public function select_selesai() {
		$sql = "SELECT data_pengiriman.id_kirim,data_pengiriman.tgl_buat,
                data_pengiriman.nama, data_pengiriman.penerima,
                data_pengiriman.tlp_penerima,data_pengiriman.tujuan,data_pengiriman.pembuat,
                no_stt.no_stt, data_selesai_kirim.ptd,
                data_selesai_kirim.total_biaya,data_selesai_kirim.fee_driver,
                data_selesai_kirim.fee_agen_1,data_selesai_kirim.fee_agen_2,
                data_selesai_kirim.beaToDoor,data_selesai_kirim.nama_barang,
                data_selesai_kirim.id_she
                FROM data_pengiriman
                LEFT JOIN no_stt ON no_stt.id_kirim = data_pengiriman.id_kirim
                LEFT JOIN data_selesai_kirim ON data_selesai_kirim.id_kirim = data_pengiriman.id_kirim
                WHERE data_pengiriman.setor='N' AND data_pengiriman.kirim ='Y'";

		$data = $this->db->query($sql);

		return $data->result();
	}
    public function batal_kirim($id) {
		$sql = "DELETE FROM no_stt WHERE id_kirim='{$id}'";
		$this->db->query($sql);
        $sql1 = "DELETE FROM data_selesai_kirim WHERE id_kirim='{$id}'";
		$this->db->query($sql1);
        $sql2 = "UPDATE data_pengiriman SET kirim ='N' WHERE id_kirim='{$id}'";
		$this->db->query($sql2);
        

		return $this->db->affected_rows();
	}
    public function insertData_detail($data) {
    $datenow= date("Y-m-d");
        $ptd1           = $data['ptd1'];
		$todoor       = $data['beTD'];
		$total_biaya  = $data['total_biaya'];
		$fee_agen     = $data['fee_agen'];
		$fee_driver   = $data['fee_driver'];
		$id_kiriman   = $data['id_kiriman'];
		$stt_brow_kirim   = $data['stt_brow_kirim'];
		$no_sttnye_brow   = $data['no_sttnye_brow'];
		$id_she       = $data['id_she'];
	    $total_potongan_fee	 = $fee_agen + $fee_driver;
        
        $jml_setor= ($total_biaya - $total_potongan_fee) + $todoor ;
	   if($ptd1=='Y'){ $jml_setor= $total_biaya - $total_potongan_fee ;}    
        
		$sql = "INSERT INTO data_setor SET
        id_setoran  ='',
        id_setor    ='$id_kiriman',
        no_stt      ='$no_sttnye_brow',
        jumlah      ='$jml_setor'";
        $this->db->query($sql);
        
        $sql1 = "UPDATE data_pengiriman SET
        setor  ='Y' WHERE id_kirim ='$no_sttnye_brow'";
        $this->db->query($sql1);
        
        $sql2 = "UPDATE data_selesai_kirim SET
        setor       ='Y',
        id_setor    ='$id_kiriman',
        tgl_setor   ='$datenow',
        jml_setor  = '$jml_setor' WHERE id_she ='$id_she'";
        $this->db->query($sql2);

		return $this->db->affected_rows();
	}
     public function updateKirim($data) {
         
			 $bentuk_diskon='';
        if(!empty($data['diskon'])&& $data['diskon']=='Y'){ 
			$diskon='%';
			$bentuk_diskon=$data['potongan'].$diskon;
			$bayar=$data['total_harganya']-$data['total_potongan'];
		}if(!empty($data['diskon'])&& $data['diskon']=='N'){
			$bentuk_diskon='(Rp)';
			$bayar=$data['total_harganya']-$data['total_potongan'];
		}else{
		 $bayar=$data['total_harganya'];
			
		}
		
        $sql1 = "UPDATE tbl_penjualan SET
        pembayaran  	='" .$data['pembayaran'] ."',
        diskon  		='$bentuk_diskon',
        jumlah_diskon  	='" .$data['total_potongan'] ."',       
        total  			='" .$data['total_harganya'] ."',       
        sisa_bayar  	='$bayar',       
        jumlah_bayar  	='" .$data['jumlah_bayar'] ."',       
        kembalian  		='" .$data['kembalian'] ."'        
        WHERE id_penjualan ='" .$data['kode_t'] ."'";
        $this->db->query($sql1);
		return $this->db->affected_rows();
	}
    public function updateDetail($data) {
        $date= date("Y-m-d");
		$ci = get_instance();
        
		$q_stok= "SELECT stok as stok_akhir FROM tbl_barang WHERE kode_barang = '" .$data['kode_barang'] ."'";
		$data_stok = $ci->db->query($q_stok)->row_array();
		$stok_akhir= $data_stok['stok_akhir'];
		$kurang=$data['jml_barang'];
		$total_stok= $stok_akhir-$kurang;
		
		$sql_barang = "UPDATE tbl_barang SET stok='$total_stok'	WHERE kode_barang='" .$data['kode_barang'] ."'";
		$this->db->query($sql_barang);
        
        $total_harga=$data['harga']*$data['jml_barang'];  
		$sql = "UPDATE tbl_detail_penjualan SET
        jumlah   ='".$data['jml_barang']."',
        total_harga ='$total_harga' WHERE id_detail='" .$data['id_detail'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */