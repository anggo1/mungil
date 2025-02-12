<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 style="display:block; text-align:center;"><?php if (!empty($dataDepartement->id_departement)) {
                            echo 'Edit  Departement';
                        } else { echo 'Penambahan Data Departement';}
                        ?></h4>

  <form <?php if (empty($dataDepartement->id_departement)) {echo 'id="form-tambah-departement"';} else { echo 'id="form-update-departement"';}?> method="POST">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="hidden" name="id_departement" value="<?php if (!empty($dataDepartement->id_departement)) { echo $dataDepartement->id_departement; } ?>">
      <input type="text" class="form-control" placeholder="Nama departement" value="<?php
                        if (!empty($dataDepartement->departement)) {
                            echo $dataDepartement->departement;
                        }
                        ?>" name="departement" aria-describedby="sizing-addon2">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Simpan </button>
      </div>
    </div>
  </form>
</div>