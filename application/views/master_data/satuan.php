<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
            <button class="form-control btn btn-success" data-toggle="modal" data-target="#tambah-satuan"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
            <p class="section-lead">             
            </p>
					
					<div class="row ">
              <div class="col-12 ">
				 <div class="card card-first card-outline">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped  table-bordered table-hover dt-responsive nowrap" id="list-data">
                        <thead>       
        <tr>
         <td>No</td>
    <td>Satuan</td>					
    <td>Aksi</td>					
      </thead>
      <tbody id="data-satuan">	

      </tbody>
    </table>
  </div>
</div>
		 
</div>
<?php  echo $modal_tambah_satuan; ?><div id="tempat-modal"></div>
</div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataKota', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>