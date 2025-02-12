<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 style="display:block; text-align:center;"><?php if (!empty($dataPosisi->id_posisi)) {
                            echo 'Edit  Posisi/ Jabatan';
                        } else { echo 'Penambahan Data Posisi/Jabatan';}
                        ?></h4>

  <form <?php if (empty($dataPosisi->id_posisi)) {echo 'id="form-tambah-posisi"';} else { echo 'id="form-update-posisi"';}?> method="POST">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="hidden" name="id_posisi" value="<?php
                        if (!empty($dataPosisi->id_posisi)) {
                            echo $dataPosisi->id_posisi;
                        }
                        ?>">
      <input type="text" class="form-control" placeholder="Nama Posisi" value="<?php
                        if (!empty($dataPosisi->posisi)) {
                            echo $dataPosisi->posisi;
                        }
                        ?>" name="posisi" aria-describedby="sizing-addon2">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Simpan </button>
      </div>
    </div>
  </form>
</div>