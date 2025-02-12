<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 style="display:block; text-align:center;"><?php if (!empty($dataPendidikan->id_pendidikan)) {
                            echo 'Edit  Pendidikan';
                        } else { echo 'Penambahan Data Pendidikan';}
                        ?></h4>

  <form <?php if (empty($dataPendidikan->id_pendidikan)) {echo 'id="form-tambah-pendidikan"';} else { echo 'id="form-update-pendidikan"';}?> method="POST">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="hidden" name="id_pendidikan" value="<?php if (!empty($dataPendidikan->id_pendidikan)) { echo $dataPendidikan->id_pendidikan; } ?>">
      <input type="text" class="form-control" placeholder="Nama pendidikan" value="<?php
                        if (!empty($dataPendidikan->pendidikan)) {
                            echo $dataPendidikan->pendidikan;
                        }
                        ?>" name="pendidikan" aria-describedby="sizing-addon2">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Simpan </button>
      </div>
    </div>
  </form>
</div>