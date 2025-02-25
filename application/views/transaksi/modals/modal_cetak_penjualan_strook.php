<script>
document.getElementById("btnPrint").onclick = function() {
    printElement(document.getElementById("printThis"));
}

function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
    //window.location.assign("<?php echo base_url();?>/Penjualan");
}

function simpanAje(elem) {

    window.location.assign("<?php echo base_url();?>/Penjualan");
}
</script>
<style>
@media screen {
    #printSection {
        display: none;
    }
}

@media print {
    body * {
        visibility: hidden;
    }

    #printSection,
    #printSection * {
        visibility: visible;
    }

    #printSection {
        position: absolute;
        left: 0;
        top: 0;
    }
}

p,
td,
th {
    font: 1 Verdana, Arial, Helvetica, sans-serif;

}

.datatable {
    border-collapse: collapse;
}

.datatable td {
    padding: -1px;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 5px;
}

.datatable th {
    padding-bottom: -1px;
    padding-top: -1px;
    border: 0px solid #000;
    font-weight: bold;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: -1px;
}


p,
td,
th {
    font: 1 Verdana, Arial, Helvetica, sans-serif;

}

.datatable2 {
    border-collapse: collapse;
}

.datatable2 td {
    padding: 0px;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 5px;
}

.datatable2 th {
    border: 0px solid #000;
    font-weight: bold;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: -1px;
}


#A4 {
    background-color: #FFFFFF;
    left: 5px;
    right: 5px;
    height: 5.51in;
    /*Ukuran Panjang Kertas */
    width: 8.50in;
    /*Ukuran Lebar Kertas */
    margin: 1px solid #FFFFFF;

    font-family: Georgia, "Times New Roman", Times, serif;
}
</style>
<div id="printThis">
    <?php 
    $apl = $this->db->get("aplikasi")->row();
    foreach ($dataKirim as $k){} ?>

    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" id="datatable">
        <thead>
            <tr>

                <th style="text-align: center;"><img
                        src="<?php echo base_url();?>assets/foto/logo/<?php echo $apl->logo; ?>" width="150"
                        style="align-content: center; align-items: center; justify-content: center;"></th>
            </tr>
            <tr>
                <th style="text-align: center;"><?php echo  $apl->title; ?></th>
            </tr>
            </tr>
            <th style="text-align: center;">
                <font size="-2"><?php echo  $apl->alamat; ?></font>
            </th>
            </tr>
            <tr>
                <th style="text-align: center;"><i class="fa fa-phone-alt"></i> &nbsp;<?php echo  $apl->tlp; ?>
                </th>
            </tr>
            <tr>
                <th style="text-align: center;">
                    <font size="-3">STRUK PENJUALAN &nbsp;|&nbsp; <?php echo $k->id_penjualan ?></font>
                </th>
        </thead>

    </table>

    <table>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="datatable2">
            <thead>
                <tr>
                    <th style="border-bottom: 1px dashed #000;"><strong>Nama Barang</strong></th>
                    <th style="border-bottom: 1px dashed #000; text-align: right;"><strong>Total</strong></th>
                </tr>
                <?php $no=0;$total_beli=0;foreach($detailKirim as $d):$no++; 
      if(!empty($detailSum)){
                foreach($detailSum as $s){
                    //$total_bayar=$s->total_harganya-$s->jml_diskon;
                    }} ?>
                <tr>
                    <th style="border-bottom: 1px dashed #000;">
                        <font size="-3"><?php echo $d->jumlah ?> x <?php echo $d->nama_barang ?> </font><em>
                            <font size="-3">
                        </em><?php echo $d->satuan ?>@<?php echo number_format($d->harga_dasar) ?>
                    </th>
                    <th align="right" style="border-bottom: 1px dashed #000; text-align: right;">
                        <font size="-2"><?php echo $d->formatted1 = number_format($d->total_harga) ?></font>
                    </th>
                </tr>
                <?php $no+1;endforeach ?>
                <tr>
                    <th>
                        <font size="-2">Grand Total</font>
                    </th>
                    <th align="right" style="border-bottom: 1px dashed #000; text-align: right;">
                        <font size="-2"><?php echo number_format($k->total) ?></font>
                    </th>
                </tr>
                <tr>
                    <th>
                        <font size="-2">Potongan/Diskon = <?php echo $s->pot_diskon ?></font>
                    </th>
                    <th align="right" style="border-bottom: 1px dashed #000; text-align: right;">
                        <font size="-2"><?php echo number_format($k->jumlah_diskon) ?></font>
                    </th>
                </tr>
                <tr>
                    <th>
                        <font size="-2">Total Jumlah Barang</font>
                    </th>
                    <th align="right" style=" text-align: right;">
                        <font size="-2"><?php echo number_format($s->total_jumlah) ?></font>
                    </th>
                </tr>
                <tr>
                    <th>
                        <font size="-2">Total Bayar</font>
                    </th>
                    <th align="right" style=" text-align: right;">
                        <font size="-2"><?php echo number_format($k->sisa_bayar) ?></font>
                    </th>
                </tr>
                <tr>
                    <th>
                        <font size="-2">Pembayaran</font>
                    </th>
                    <th align="right" style=" text-align: right;">
                        <font size="-2"><?php echo $s->pembayaran ?> | <?php echo number_format($k->jumlah_bayar) ?>
                        </font>
                    </th>
                </tr>
                <tr>
                    <?php 
                
                ?>
                    <th>
                        <font size="-2">Uang Kembali</font>
                    </th>
                    <th align="right" style=" text-align: right;">
                        <font size="-2">
                            <?php if($k->jumlah_bayar==0){echo '0';}else{echo number_format($k->kembalian);} ?></font>
                    </th>
                </tr><?php ?>
            </thead>

        </table>
        <table>
            <span style="text-align: center;"><?php //echo $userdata->strook; keterangan ?></span>

            <table width="100%" border="0" cellpadding="5" cellspacing="0" class="datatable2">
                <thead>
                    <tr>
                        <th>
                            <p>
                                <font size="-2"><?php echo date('d M Y');?>
                            </p>
                            <p><?php echo $this->session->userdata['full_name']; ?></font>
                            </p>
                        </th>
                    </tr>
                </thead>

            </table>
</div>
<P></P>
<P></P>
<!--<strong><em><font size="-1">Terbilang</strong> : <?php echo ucwords((number_to_words("$s->total_harganya"))); ?> Rupiah</em>-->
<div class="card-footer">
<button type="button" id="btnPrint" class="btn btn-primary" onClick="strook('<?php echo $k->id_penjualan ?>')" ><span class="fa fa-print"></span>&nbsp;&nbsp;  STROOK </button>
    <script type="text/javascript">
    function strook(toast) {
        Android.cari_data(toast);
    }

    function label(toast) {
        Android.cari_data2(toast);
    }
    </script>