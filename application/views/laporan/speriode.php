<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
 <div class="section-body">
<div class="row ">
              <div class="col-12 ">
				 <div class="card card-first card-outline">
                  <div class="card-body">
 <form role="form" id="form-cari-tempat" method="post" name="personal" action="<?php echo base_url('Laporan/speriode');?>" class="form-horizontal form-groups-bordered">
                   
					<div class="form-group row">
                        <label for="Kode Barang" class="col-sm-1 col-form-label">Nama Supplier</label>
                    <div class="col-sm-2">
						<div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="hidden" name="id_supplier" id="id_supplier" autofocus class="form-control">
                        <input type="text" name="nama" id="nama" autofocus class="form-control" readonly  data-toggle="modal" data-target="#cari-supplier">
							<span class="input-group-append">
                    <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#cari-supplier">Cari..</button></i>
                  </span>
                  </div>
				</div>
                    <label class="col-sm-1 col-form-label">Tanggal Awal</label>
                    <div class="col-sm-2 ">
						<div class="input-group date" id="reservationdate" data-target-input="nearest">

                        <input type="text" name="date" id="datepicker" value="" class="form-control datepicker datetimepicker" 
                               data-toggle="datetimepicker" data-target=".datepicker" data-format="yyy-mm-dd" required>

                        <div class="input-group-append" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    </div>
                    <label class="col-sm-1 col-form-label">Tanggal Akhir</label>
                        <div class="col-sm-2 ">
						<div class="input-group date" id="reservationdate" data-target-input="nearest">

                        <input type="text" name="date2" id="datepicker2" value="" class="form-control datepicker2 datetimepicker"
                               data-toggle="datetimepicker" data-target=".datepicker2" data-format="yyy-mm-dd" required>

                        <div class="input-group-append" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    </div>
                         <div class="col-sm-2 ">
						<div class="input-group date" id="reservationdate" data-target-input="nearest">                       
                            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Cari..</button>
                        <div class="input-group-append" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-search"></i></div>
                        </div>
                    </div>
                    </div>
						
						<div class="col-md-1">
                        <div class="input-group">
        				</form>
						<?php if(!empty($dataSupplier)){ $idsup=$_REQUEST['id_supplier'];$tgl1=$_REQUEST['date'];$tgl2=$_REQUEST['date2'];?>
<a href="<?php echo base_url('Laporan/exportSupplier'); ?>?id=<?php echo $idsup; ?>&tgl=<?php echo $tgl1 ?>&tgl2=<?php echo $tgl2 ?>"  onClick="validateForm()" class="form-control btn btn-success"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a><?php } ?>
    					</div></div>
                    </div>                        
      


</div>
</div> 
</div> 
</div> 
</div> 
                     <?php if(!empty($dataSupplier)){ ?>
					
					<div class="row ">
              <div class="col-12 ">
				 <div class="card card-first card-outline">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped  table-bordered table-hover dt-responsive nowrap" id="list-data">
                        <thead>  
        <tr>
          <th>No</th>
                <th>Nama Supplier</th>
                <th>No Invoice</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Expired</th>
                <th>Tanggal Input</th>
                <th>Pembuat</th>
        </tr>
     </thead>
             <tbody>  
      
	  <?php
  $no = 1;
  foreach ($dataSupplier as $d) {	  
	  $datetime = new DateTime($d->tgl_input);
      $date = $datetime->format('d-m-Y');
	 ?>
        
    <tr>
		<td><?php echo $no ?></td>
		<td><?php echo $d->nama_supplier; ?></td>   
		<td><?php echo $d->no_invoice; ?></td>
		<td><?php echo $d->kode_barang; ?></td>
		<td><?php echo $d->nama_barang; ?></td>
		<td><?php echo $d->jumlah; ?></td>
		<td><?php echo $d->tgl_expired; ?></td>
		<td><?php echo $d->tgl_input; ?></td>
		<td><?php echo $d->pengguna; ?></td>
    </tr><?php
    $no++;
  }
?><?php } ?>	</tbody><tfoot></tfoot>
    </table>
  </div>
</div>
	  
</div>
</div>
</div>  
<!-- ============ MODAL ADD PELANGGAN =============== -->
			<div class="modal fade" id="cari-supplier" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
			    <div class="modal-dialog">
			    <div class="modal-content">
			   <div class="card card-first">
              <div class="card-header">
                <h3 class="card-title">
					 <h4 class="modal-title" style="display:block; text-align:center;">
                       Pencarian Data Supplier</h4></h3>
              </div>
 				<div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped display responsive nowrap" id="table-supplier">
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
                onClick="javascript:selectSupplier('<?php echo $h->id_supplier ?>','<?php echo $h->nama_supplier ?>')"><i class="fa  fa-check"></i>Pilih</button></td>
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
  </div></div></div>

		
	