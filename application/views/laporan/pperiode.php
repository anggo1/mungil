<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>
 <div class="section-body">
<div class="row ">
              <div class="col-12 ">
				 <div class="card card-first card-outline">
                  <div class="card-body">
 <form role="form" id="form-cari-tempat" method="post" name="personal" action="<?php echo base_url('Laporan/pPromo');?>" class="form-horizontal form-groups-bordered">
                   
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
						<?php if(!empty($dataPromo)){ $tgl1=$_REQUEST['date'];$tgl2=$_REQUEST['date2'];?>
<a href="<?php echo base_url('Laporan/exportBarangPromo'); ?>?tgl=<?php echo $tgl1 ?>&tgl2=<?php echo $tgl2 ?>"  onClick="validateForm()" class="form-control btn btn-success"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a><?php } ?>
    					</div></div>
                    </div>                        
      

</div>
</div> 
</div> 
</div> 
</div> 
                     <?php if(!empty($dataPromo)){ ?>
					
					<div class="row ">
              <div class="col-12 ">
				 <div class="card card-first card-outline">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped  table-bordered table-hover dt-responsive nowrap" id="list-data">
                        <thead>  
        <tr>
          <th>No</th>
                <th>Tgl Promo</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Promo</th>
                <th>awal</th>
                <th>Akhir</th>
                <th>Jumlah Promo</th>
                <th>Keterangan</th>
                <th>Tgl Input</th>
                <th>Tgl Input</th>
        </tr>
     </thead>
             <tbody>  
      
	  <?php
  $no = 1;
  foreach ($dataPromo as $d) {	  
	  $datetime = new DateTime($d->tgl_promo);
      $date = $datetime->format('d-m-Y');
	 ?>
        
    <tr>
		<td><?php echo $no ?></td>
		<td><?php echo $date  ?></td>
		<td><?php echo $d->kode_barang; ?></td>
		<td><?php echo $d->nama_barang; ?></td>
		<td><?php if($d->promo=='R'){echo'Rupiah';}else{echo'Persen';} ?></td>
		<td><?php echo $d->tgl_awal; ?></td>
		<td><?php echo $d->tgl_akhir; ?></td>
		<td><?php if($d->promo=='R'){echo  number_format($d->jml_promo);}else{echo $d->jml_promo. ' %';} ?></td>
		<td><?php echo $d->keterangan; ?></td>
		<td><?php echo $d->tgl_input; ?></td>
		<td class="text-center">
		  <button class="btn btn-danger btn-sm delete-promo" data-toggle="modal" data-target="#konfirmasiHapus" data-id="<?php echo $d->id_promo; ?>"><i class="fa fa-delete"></i> Hapus</button>
      </td>
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
<?php show_my_confirm('konfirmasiHapus', 'hapus-promo', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
	