<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 style="display:block; text-align:center;"><?php if (!empty($dataKode->id)) {
                            echo 'Edit  Kode NIP';
                        } else { echo 'Penambahan Kode NIP';}
                        ?></h4>

  <form <?php if (empty($dataKode->id)) {echo 'id="form-tambah-kode"';} else { echo 'id="form-update-kode"';}?> method="POST">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
      </span>
      <input type="hidden" name="id" value="<?php if (!empty($dataKode->id)) { echo $dataKode->id; } ?>">
      <input type="text" class="form-control" placeholder="Kode" value="<?php
                        if (!empty($dataKode->kode)) {
                            echo $dataKode->kode;
                        }
                        ?>" name="kode" aria-describedby="sizing-addon2">
    </div> <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="hidden" name="id" value="<?php if (!empty($dataKode->id)) { echo $dataKode->id; } ?>">
      <input type="text" class="form-control" placeholder="Nama Perusahaan" value="<?php
                        if (!empty($dataKode->nama)) {
                            echo $dataKode->nama;
                        }
                        ?>" name="nama" aria-describedby="sizing-addon2">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Simpan </button>
      </div>
    </div>
  </form>
</div>