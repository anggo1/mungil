<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
 <div class="section-body">
<div class="row ">
              <div class="col-12 ">
				 <div class="card card-first card-outline">
                  <div class="card-body">
 <form role="form" id="form-cari-tempat" method="post" name="personal" action="<?php echo base_url('Laporan/mPeriode');?>" class="form-horizontal form-groups-bordered">
                   
					<div class="form-group row">
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
                         <div class="col-sm-3 ">
						<div class="input-group date" id="reservationdate" data-target-input="nearest">                       
                            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Cari..</button>
                        <div class="input-group-append" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-search"></i></div>
                        </div>
                    </div>
                    </div>
						
						<div class="col-md-3">
                        <div class="input-group">
        				</form>
						<?php if(!empty($dataBarang)){ $tgl1=$_REQUEST['date'];$tgl2=$_REQUEST['date2'];?>
<a href="<?php echo base_url('Laporan/exportBarangMasuk'); ?>?tgl=<?php echo $tgl1 ?>&tgl2=<?php echo $tgl2 ?>"  onClick="validateForm()" class="form-control btn btn-success"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a><?php } ?>
    					</div></div>
                    </div>                        
      

</div>
</div> 
</div> 
</div> 
</div> 
                     <?php if(!empty($dataBarang)){ ?>
					
					<div class="row ">
              <div class="col-12 ">
				 <div class="card card-first card-outline">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped  table-bordered table-hover dt-responsive nowrap" id="list-data">
                        <thead>  
        <tr>
          <th>No</th>
                <th>Tgl Input</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>No Invoice</th>
                <th>Supplier</th>
                <th>Jumlah</th>
                <th>Tgl Expired</th>
                <th>Keterangan</th>
                <th>Pembuat</th>
        </tr>
     </thead>
             <tbody>  
      
	  <?php
  $no = 1;
  foreach ($dataBarang as $d) {	  
	 ?>
        
    <tr>
		<td><?php echo $no ?></td>
		<td><?php echo tglIndoPendek($d->tgl_input);  ?></td>
		<td><?php echo $d->kode_barang; ?></td>
		<td><?php echo $d->nama_barang; ?></td>
		<td><?php echo $d->no_invoice; ?></td>
		<td><?php echo $d->nama_supplier; ?></td>
		<td><?php echo $d->jumlah; ?></td>
		<td><?php echo tglIndoPendek($d->tgl_expired); ?></td>
		<td><?php echo $d->keterangan; ?></td>
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
	