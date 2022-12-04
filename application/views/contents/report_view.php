<div class="box box-default">
    <div class="box-header with-border">
        <h4><strong>LAPORAN</strong></h4>
    </div>
    <div class="box-header with-border">
        <h5><strong>PENGELUARAN</strong></h5>
    </div>
    <?php $total_out = 0;if(!empty($out)): ?>
        <div class="box-body no-padding">
            <div class="table-responsive no-margin">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;foreach ($out as $key => $value){ ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo format_dmy($value->date); ?></td>
                            <td><?php echo $value->remark; ?></td>
                            <td><?php echo number_format($value->value); ?></td>
                        </tr>
                        <?php $total_out += $value->value;$i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="box-body">
            <i>Tidak ada pengeluaran</i>
        </div>
    <?php endif ?>
    <div class="box-header with-border">
        <h5><strong>PEMASUKAN</strong></h5>
    </div>

    <?php $total_in = 0;if(!empty($in)): ?>
    <div class="box-body no-padding">
        <div class="table-responsive no-margin">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;foreach ($in as $key => $value){ ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo format_dmy($value->date); ?></td>
                        <td><?php echo $value->remark; ?></td>
                        <td><?php echo number_format($value->value); ?></td>
                    </tr>
                      <?php $total_in += $value->value;$i++; } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php else: ?>
        <div class="box-body">
            <i>Tidak ada pemasukan</i>
        </div>
    <?php endif ?>

    <?php $total_sell=0;if(!empty($sell)): ?>
    <div class="box-header with-border">
        <h5><strong>PENJUALAN</strong></h5>
    </div>
    <div class="box-body no-padding">
        <div class="table-responsive no-margin">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Nilai</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;foreach ($sell as $key => $value){ ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo format_dmy($value->date); ?></td>
                        <td><?php echo $value->remark; ?></td>
                        <td><?php echo $value->name; ?></td>
                        <td><?php echo number_format($value->qty); ?></td>
                        <td><?php echo number_format($value->amount); ?></td>
                        <td><?php echo number_format($value->qty*$value->amount); ?></td>
                    </tr>
                      <?php $total_sell += ($value->qty*$value->amount);$i++; } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php else: ?>
        <div class="box-body">
            <i>Tidak ada penjualan</i>
        </div>
    <?php endif ?>

    <div class="box-header with-border">
        <h5><strong>RUGI/LABA</strong></h5>
    </div>
    <div class="box-body no-padding">
        <div class="table-responsive no-margin">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Keterangan</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total Pengeluaran</td>
                        <td><?php echo number_format($total_out) ?></td>
                    </tr>
                    <tr>
                        <td>Total Pemasukan</td>
                        <td><?php echo number_format($total_in) ?></td>
                    </tr>
                    <tr>
                        <td>Total Penjualan</td>
                        <td><?php echo number_format($total_sell) ?></td>
                    </tr>
                    <tr>
                        <td>Total Rugi/Laba</td>
                        <td><strong><?php echo number_format($total_in+$total_sell-$total_out) ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box-footer">
    </div>
</div>
