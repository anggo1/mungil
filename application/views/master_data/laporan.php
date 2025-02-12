<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>

</div>
  <?php
$hariini = date('m-y');
$exp_hariini = explode ('-', $hariini);
$bulan_no = $exp_hariini[0];
$tahun_no = $exp_hariini[1];
$tgl_gabung = $bulan_no.$tahun_no;

$row = $this->db->query('SELECT * FROM `laporan_lk` ORDER BY `laporan_lk`.`id` DESC LIMIT 1')->row();
if ($row) {
    $maxid = $row->no_kasus; 
}
//$exp_max = explode ('.', $maxid);
//$max = $exp_max[1];

$ni = substr($maxid,0,4);
$no = substr($maxid,4)+1;

if ($ni==$tgl_gabung){
	$no + 1; }
if ($ni!==$tgl_gabung) {
$no =1 ;}
$nomor_urut = sprintf('%03s', $no);
$urutan = $bulan_no.$tahun_no.$nomor_urut;



?>
<script type="text/javascript">

</script>
  <div class="row">
			<div class="col-md-12">
			 <div class="box box-primary">
                <div class="box-header with-border">
 <h3 class="box-title">Laporan Pengemudi
  </h3></div>
   <div class="box-body">
  <form id="form-tambah-lapor" method="POST">
        <div class="col-md-12" >  <div class="row">
               <div class="form-group"><div class="col-xs-4">
                 <label for="exampleInputPassword1">Jenis</label>
      <select name="jenis" class="form-control select2 col-md-3" required>
        <option value="" selected>Jenis</option>
			   <?php						  
            			foreach ($datakode as $ko) {          ?>
              <option value="<?php echo $ko->id_kode; ?>"><?php echo $ko->kode."&nbsp; |  &nbsp;".$ko->nama_kode; ?></option>
              <?php
            }
            ?>
      </select>
      </div>
      <div class="form-group">  <div class="col-xs-4">
        <label for="NomorKasus">Nomor Laka</label>
                  <input type="text" class="form-control" name="no_kasus"  id="no_kasus" value="<?php echo $urutan ?>" readonly placeholder="No Laka">
                </div>
              
                <div class="form-group"><div class="col-xs-4">
                  <label for="nosurat">Nomor Surat</label>
                  <input type="text" class="form-control" name="no_surat" required id="exampleInputtext1" placeholder="No Surat">
                </div>
                <div class="form-group"><div class="col-xs-4">
                <label for="hari_lapor">Hari Lapor</label>
                  <input type="text" class="form-control" name="hari_lapor" id="hari_lapor" placeholder="Hari">
                </div>
                <div class="form-group"><div class="col-xs-4">
                <label for="tanggal">Tanggal Lapor </label>
                    <i class="fa fa-calendar"></i>
                  <input type="text" class="form-control pull-right" name="tgl_lapor" id="datepicker" placeholder="Tanggal">
                </div>
                <div class="form-group"><div class="col-xs-4">
                  <label for="jam_bap">Jam Lapor</label>

                  <div class="input-group">
                    <input type="text" name="jam_lapor" id="jam_lapor" class="form-control">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  </div>
                 <div class="form-group"><div class="col-xs-4">
                <label for="NoPolisi">No Polisi</label>
                  <input type="text" class="form-control" name="no_pol" id="no_pol" placeholder="No Polisi">
                </div>
                 <div class="form-group"><div class="col-xs-4">
                <label for="no_body">No Body</label>
                  <input type="text" class="form-control" name="no_body" id="no_body" placeholder="No Body">
                </div>
                
                <div class="form-group">  <div class="col-xs-4">
                <label for="petugas">Petugas</label>
                  <input type="text" class="form-control" name="petugas" required id="petugas" placeholder="Petugas">
                </div>
                <div class="form-group"><div class="col-xs-2">
                <label for="nic_sp">NIK Pengemudi</label>
                  <input type="text" class="form-control" name="nic_sp" id="nic_sp1" placeholder="Nic SP" 
                  	onBlur="req_tgl_masuk_sp(this.value,document.getElementById('tgl_masuk_png'),'start');"
					onkeyup="req_nama_sp1(this.value,document.getElementById('nama_sp1'),'start');"
                    onKeyPress="req_tgl_masuk_sp(this.value,document.getElementById('tgl_masuk_png'),'start');"
                    onFocus="req_tgl_masuk_sp(this.value,document.getElementById('tgl_masuk_png'),'start');"
                    onMouseOver="req_tgl_masuk_sp(this.value,document.getElementById('tgl_masuk_png'),'start');" >
                </div>
                 <div class="form-group"><div class="col-xs-4">
                <label for="exampleInputPassword1">Nama Pengemudi</label>
                  <input type="text" class="form-control" name="nama_sp" id="nama_sp1" placeholder="Nama Pengemudi">
                </div>
                
                <div class="form-group">  <div class="col-xs-2">
                <label for="nic_kr">NIK Kernet</label>
                  <input type="text" class="form-control" name="nic_kr" id="nic_kr" placeholder="Nic Kr"
                    onBlur="req_nama_kr(this.value,document.getElementById('nama_kr'),'start');"
					onkeyup="req_nama_kr(this.value,document.getElementById('nama_kr'),'start');" >
                </div>
                <div class="form-group"><div class="col-xs-4">
                <label for="nama_kr">Nama Kernet</label>
                  <input type="text" class="form-control" name="nama_kr" id="nama_kr" placeholder="Nama Kernet">
                </div>
                 <div class="form-group"><div class="col-xs-2">
                <label for="Jml_pp">Jumlah PP</label>
                  <input type="text" class="form-control" name="jml_pp" id="jumlah_pp" placeholder="Jumlah PP">
                </div>
                
                <div class="form-group">  <div class="col-xs-2">
                <label for="berita_dari">Berita Dari ?</label>
                  <input type="text" class="form-control" name="berita_dari" id="berita_dari" placeholder="Berita Dari ?">
                </div>
                </div></div>
                <div class="form-group"><div class="col-xs-2">
                <label for="hari_bap">Hari Kejadian</label>
                  <input type="text" class="form-control" name="hari_bap" id="hari_bap" placeholder="Hari Kejadian ">
                </div>
                
                 <div class="form-group"><div class="col-xs-3">
                    <i class="fa fa-calendar"></i>
                <label for="tgl_bap">Tanggal Kejadian</label>
                  <input type="text" class="form-control pull-right" name="tgl_bap" id="datepicker2" placeholder="Tanggal Kejadian">
                </div>
                
                <div class="form-group"><div class="col-xs-3">
                  <label for="jam_bap">Jam Kejadian</label>

                  <div class="input-group">
                    <input type="text" name="jam_bap" id="jam_lapor" class="form-control">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  </div>
                <div class="form-group"><div class="col-xs-4">
                <label for="tkp_laka">Tempat Kecelakaan</label>
                  <input type="text" class="form-control" name="tkp_laka" id="tkp_laka" placeholder="Tempat Kejadian">
                </div>
                 <div class="form-group"><div class="col-xs-4">
                <label for="wilayah">Wilayah</label>
                  <input type="text" class="form-control" name="wilayah" id="wilayah" placeholder="Wilayah Kecelakaan">
                </div>
                
                <div class="form-group">  <div class="col-xs-4">
                <label for="kendaraan_terlibat">Kendaraan Yang Terlibat</label>
                  <input type="text" class="form-control" name="kendaraan_terlibat" id="kendaraan_terlibat" placeholder="Kendaraan Yang terlibat">
                </div>
                <div class="form-group">  <div class="col-xs-4">
                <label for="keadaan_png">Keadaan PNG</label>
                  <input type="text" class="form-control" name="keadaan_png" id="keadaan_png" placeholder="Keadaan Pengemudi">
                </div>
                <div class="form-group">  <div class="col-xs-4">
                <label for="korban">Korban Manusia</label>
                  <input type="text" class="form-control" name="korban" id="korban" placeholder="Korban Manusia">
                </div>
                <div class="form-group">  <div class="col-xs-4">
                <label for="korban_benda">Korban Benda</label>
                  <input type="text" class="form-control" name="korban_benda" id="korban_benda" placeholder="Korban Benda">
                </div>
                <div class="form-group">  <div class="col-xs-12">
                <label for="ket_perkara">Keterangan Singkat</label>
                  <textarea class="form-control" name="ket_perkara" rows="3" placeholder="Keterangan secara singkat ..."></textarea>
                </div>
                <div class="form-group">  <div class="col-xs-12">
                <label for="posisi_kendaraan">Posisi Setelah laka</label>
                 <textarea class="form-control" name="posisi_kendaraan" rows="3" placeholder="Posisi kendaraan ..."></textarea>	
                </div><div class="input-group"><div class="col-xs-4">
                <label for="kerugian_lawan">Kerugian Lawan</label>
                  <input type="text" class="form-control" name="kerugian_lawan" id="kerugian_lawan" placeholder="Kerugian Pihak lawan">
                </div><div class="input-group">  <div class="col-xs-6">
                <label for="png_jln_sebelumnya">Perjalanan Pengemudi Sebelumnya</label>
                  <input type="text" class="form-control" name="png_jln_sebelumnya" id="png_jln_sebelumnya" placeholder="Perjalanan pengemudi sebelumnya">
                </div><div class="input-group">  <div class="col-xs-12">
                <label for="tgl_masuk_png">Tanggal Masuk Pengemudi</label>
                  <input type="text" class="form-control" name="tgl_masuk_png" id="tgl_masuk_png" placeholder="Tanggal Masuk Pengemudi">
                </div>
     <input type="hidden" name="pembuat" id="pembuat" value="<?php echo $userdata->FirstName; ?>" />
    </div></div>
    <div class="box-footer">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
      </div>
  </form>
    </div>

<script>
function autotab(original,destination){
if (original.getAttribute&&original.value.length==original.getAttribute("maxlength"))
destination.focus()
}
    $(function() {
        $( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker({
			format: 'yyyy/mm/dd',
            changeMonth: true, 
			changeYear: true,
      autoclose: true
			
        });
		$('.timepicker').timepicker({
      showInputs: false
    })
    });
  //  $(".select2").select2();

//   $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
//     checkboxClass: 'icheckbox_flat-blue',
 //   radioClass: 'iradio_flat-blue'
//   });
// });
</script>