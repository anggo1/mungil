<div class="row">
    <div class="col-12">
        <div class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <?php $idlevel = $this->session->userdata['id_level']; ?>
                <?php if (($idlevel==1) or ($idlevel==7) or ($idlevel==12)){ ?>
                <!-- /.col-md-6 -->

                <div class="row">
                    <!-- /.row -->
                    <div class="col-lg-4 col-4">
                        <!-- small box -->
                        <div class="small-box bg-indigo">
                        <div class="small-box bg-gradient-primary" style="border-radius: 0.50rem;">
              <div class="inner" style="padding-bottom: 0rem;">
                  <a href="<?php echo base_url('Status_pengiriman'); ?>">
                      <h4 align="center" style="padding-bottom: 0rem;"><i class="fa fa-shipping-fast" style="color: aliceblue;"></i></h4><p></p>
                     </div>
              <a href="<?php echo base_url('DataPenjualan'); ?>" class="small-box-footer" style="border-bottom-left-radius: 0.50rem;border-bottom-right-radius: 0.50rem;">
                  <?php //echo $dataMakanan; ?> Daftar Transaksi</a>            
                </div></a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-4">
                        <!-- small box -->
                        <div class="small-box bg-gradient-info" style="border-radius: 0.50rem;">
              <div class="inner" style="padding-bottom: 0rem;">
                  <a href="<?php echo base_url('Status_pengiriman'); ?>">
                      <h4 align="center" style="padding-bottom: 0rem;"><i class="fa fa-shipping-fast" style="color: aliceblue;"></i></h4><p></p>
                     </div>
              <a href="<?php echo base_url('Pengeluaran'); ?>" class="small-box-footer" style="border-bottom-left-radius: 0.50rem;border-bottom-right-radius: 0.50rem;">
                  <?php // echo $dataMakanan; ?> Barang Keluar</a>            
                </div></a>
                    </div>

                    <div class="col-lg-4 col-4">
                        <!-- small box -->
                        <div class="small-box bg-indigo">
                        <div class="small-box bg-gradient-indigo" style="border-radius: 0.50rem;">
              <div class="inner" style="padding-bottom: 0rem;">
                  <a href="<?php echo base_url('Status_pengiriman'); ?>">
                      <h4 align="center" style="padding-bottom: 0rem;"><i class="fa fa-shipping-fast" style="color: aliceblue;"></i></h4><p></p>
                     </div>
              <a href="<?php echo base_url('BarangMasuk'); ?>" class="small-box-footer" style="border-bottom-left-radius: 0.50rem;border-bottom-right-radius: 0.50rem;">
                  <?php // echo $dataMakanan; ?> Barang Masuk</a>            
                </div></a>
                        </div>
                    </div>
                    </div>
                    </div>

                    <div class="col-lg-12 col-12">
                        <!-- small box -->
                        <div class="small-box bg-success"><a href="<?php echo base_url('Penjualan'); ?>" class="small-box-footer">
                            <div class="inner">
                                <h3>Transaksi Baru</h3>

                                <p>Transaksi penjualan baru</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-file-signature"></i>
                            </div>
                            More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <?php } ?>
                    <!-- ./col -->
                    <!-- ./col -->
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
//untuk Chart
$(function() {
    'use strict'

    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true

    var $salesChart = $('#sales-chart')
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart($salesChart, {
        type: 'bar',
        data: {
            //$datanya=""; if(empty($data_asal)) {$datanya='Non SPK';}else{$datanya=$data_asal;} 
            labels: <?php echo $data_asal; ?>,
            datasets: [{
                backgroundColor: <?php  echo $warna_asal; ?>,
                borderColor: <?php  echo $warna_asal; ?>,
                data: <?php  echo $jumlah_asal; ?>
            }]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    display: true,
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,

                        // Include a dollar sign in the ticks
                        callback: function(value) {
                            if (value >= 1000) {
                                value /= 1000
                                value += 'k'
                            }

                            return '' + value
                        }
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
            }
        }
    })

    var $visitorsChart = $('#visitors-chart')
    // eslint-disable-next-line no-unused-vars
    var visitorsChart = new Chart($visitorsChart, {
        data: {
            labels: <?php  echo $data_barang; ?>,
            datasets: [{
                type: 'line',
                backgroundColor: <?php  echo $warna_barang; ?>,
                borderColor: <?php  echo $warna_barang; ?>,
                data: <?php  echo $jumlah_barang; ?>,
                //backgroundColor: 'transparent',
                // borderColor: '#007bff',
                pointBorderColor: '#007bff',
                pointBackgroundColor: <?php  echo $warna_barang; ?>,
                fill: false
                // pointHoverBackgroundColor: '#007bff',
                // pointHoverBorderColor    : '#007bff'
            }]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    // display: false,
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,
                        suggestedMax: 200
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
            }
        }
    })
})
</script>