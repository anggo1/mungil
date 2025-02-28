<div class="card card-first">
              <div class="card-header">
                <h3 class="card-title">
					 <h4 class="modal-title" style="display:block; text-align:center;">
                       Pencarian Data Supplier</h4></h3>
              </div>
 				<div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped display responsive nowrap" id="table-barang">
                        <thead>          
     <!--<table id="list-data" class="table table-bordered table-striped display responsive nowrap" style="width:100%">-->
        <tr>
            <th>Check</th>
            <th>Nama Supplier</th>
            <th>No Telp </th>
           	<th>Alamat</th>
  </tr>
      </thead>
      <tbody>
       <?php
  $no = 1;
  foreach ($dataCariSupplier as $h) {
    ?>
    <tr>
    
    <td class="text-center">
		<button type="button" class="btn btn-sm bg-gradient-warning" 
                onClick="javascript:selectHarga('<?php echo $h->id_supplier ?>','<?php echo $h->nama_supplier ?>')"><i class="fa  fa-check"></i>Pilih</button></td>
            <td><?php echo $h->nama_supplier?></td>
            <td><?php echo $h->telp?></td>
            <td><?php echo $h->alamat?></td>
    </tr>
    <?php
  }
?> 
      </tbody>
    </table>
  </div></div></div>

		