<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('form-msg'); ?>
</div>
   		  
 <div class="section-body">
	
        <button class="form-control btn btn-success" data-toggle="modal" data-target="#tambah-jabatan"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data </button>
            <p class="section-lead">
              </p>
	  <div class="row ">
              <div class="col-12 ">
				 <div class="card card-first card-outline">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped  table-bordered table-hover dt-responsive nowrap" id="table-1">
                        <thead>       
                        <tr>
         <td>No</td>
    <td>No Body</td>
    <td>No Pol</td>
    <td>Tgl Keur</td>
    <td>Keterangan</td>
    <td>Aksi</td>
  </tr>
      </thead>
      <tbody id="data-cargo">	</div></div></div>
		  <?php echo $modal_tambah_jabatan; ?>
<div id="tempat-modal">
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
</div>
		 
</div>
</div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataKota', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
