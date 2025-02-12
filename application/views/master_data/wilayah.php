<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
            <button class="form-control btn btn-success" data-toggle="modal" data-target="#tambah-cargo"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
            <p class="section-lead">
             
            </p>
	  <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover dt-responsive nowrap" id="table-1">
                        <thead>          
     <!--<table id="list-data" class="table table-bordered table-striped display responsive nowrap" style="width:100%">-->
        <tr>
         <th>No</th>
    <th>Kode</th>
    <th>Pengurus</th>
    <th>Pangkalan</th>
    <th>Wilayah</th>
    <th>Aksi</th>
  </tr>
      </thead>
      <tbody>
       <?php
  $no = 1;
  foreach ($dataWilayah as $s) {
    ?>
    <tr>
    
    <td><?php echo $no; ?></td>
    <td><?php echo $s->kode; ?></td>
    <td><?php echo $s->pengurus; ?></td>
    <td><?php echo $s->pangkalan; ?></td>
    <td><?php echo $s->wilayah; ?></td>

      <td class="text-center">
        
        <button class="btn btn-info btn-sm update-datacargo" data-id="<?php echo $s->kode; ?>"><i class="glyphicon glyphicon-repeat"></i> Edit</button>
      </td>
    </tr>
    <?php
	 $no++;
  }
?> 
      </tbody>
    </table>
  </div></div></div>
</div>
<?php echo $modal_tambah_cargo; ?>
<div id="tempat-modal"></div>
		