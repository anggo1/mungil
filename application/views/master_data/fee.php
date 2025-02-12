<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div><div class="row">

<div class="col-lg-12 col-xs-12">
    <div class="box box-info">
<div class="box-header with-border">
  <div class="box-header"><div class="col-md-6" style="padding: 0;">
        <button class="form-control btn btn-success" data-toggle="modal" data-target="#tambah-satuan"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>

  </div>
  <!-- /.box-header -->
  <div class="box-body">
                
    <table id="list-data" class="table table-bordered table-striped display responsive nowrap" style="width:100%">
      <thead>
        <tr>
         <td rowspan="2">No</td>
    <td rowspan="2">Satuan</td>
    <td rowspan="2">Nama Barang</td>
    <td rowspan="2">Harga</td>
    <td rowspan="2">Harga Min</td>
    <td rowspan="2">Jml Min</td>
    <td colspan="3" align="center">FEE</td>
    <td colspan="2">Discount</td>
    <td rowspan="2">Aksi</td>
  </tr>
  <tr>
    <td align="center">Crew Bus</td>
    <td align="center">Fee 1</td>
    <td align="center">Fee 2</td>
    <td> (%)</td>
    <td>(KG)</td>
    </tr>
      </thead>
      <tbody>
       <?php
  $no = 1;
  foreach ($dataSatuan as $s) {
    ?>
    <tr>
    
    <td><?php echo $no; ?></td>
    <td><?php echo $s->nama_satuan; ?></td>
    <td><?php echo $s->nama_barang; ?></td>
    <td><?php echo $s->hrg_satuan; ?></td>
    <td><?php echo $s->harga_minimum; ?></td>
    <td><?php echo $s->jml_minimum; ?></td>
    <td><?php echo $s->fee_crew; ?></td>
    <td><?php echo $s->persen; ?></td>
    <td><?php echo $s->rupiah; ?></td>
    <td><?php echo $s->d_persen; ?></td>
    <td><?php echo $s->d_kg; ?></td>

      <td class="text-center">
        
        <button class="btn btn-info btn-sm update-datasatuan" data-id="<?php echo $s->id_satuan; ?>"><i class="glyphicon glyphicon-repeat"></i> Edit</button>
      </td>
    </tr>
    <?php
	 $no++;
  }
?> 
      </tbody>
    </table>
  </div>
</div>
<?php echo $modal_tambah_satuan; ?>
<div id="tempat-modal"></div>