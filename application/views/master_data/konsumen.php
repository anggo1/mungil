<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
 <div class="section-body">
	
        <button class="form-control btn btn-success" data-toggle="modal" data-target="#tambah-konsumen"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data </button>
            <p class="section-lead">
             
            </p>
	  <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                   <!--   <table class="table table-striped" id="table-lap">-->
                                
     <table id="table-lap" class="table table-bordered table-striped display responsive nowrap" style="width:100%">
        <thead>  
            <tr>
          <th width="20">No</th>
                <th>ID Konsumen</th>
                <th>Nama</th>
                <th>Telephone</th>
                <th>No KTP</th>
                <th>Alamat</th>
          <th>Aksi</th>
        </tr>
     </thead>
            <tbody></tbody><tfoot></tfoot>
    </table>
  </div>
</div>
		  
</div>
</div>
</div>
</div>
</div>
<?php echo $modal_tambah_konsumen; ?>

<div  id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataKonsumen', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
