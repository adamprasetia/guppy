<div class="box box-default">
    <?php if(empty($this->input->get('popup'))): ?>
    <div class="box-header with-border">
        <div class="pull-left">
            <h4><strong>DATA KEUANGAN</strong></h4>
        </div>
    </div>
    <?php endif ?>
    <div class="box-header with-border">
        <div class="form-group">
            <a href="<?php echo base_url('trans/add') ?>" class="btn btn-default"><i class="fa fa-plus"></i> Tambah</a>
            <a href="<?php echo now_url() ?>" class="btn btn-default"><i class="fa fa-refresh"></i> Refresh</a>
        </div>
        <div class="form-group">
            <div class="input-group">
                <input id="input_search" type="text" class="form-control" placeholder="Search..." data-url="<?php echo current_url() ?>" data-query-string="<?php echo get_query_string(array('search','page')) ?>" value="<?php echo $this->input->get('search') ?>">
                <span class="input-group-btn">
                    <a href="<?php echo base_url('trans') ?>" id="reset-search" class="btn btn-default">Reset</a>
                </span>
            </div>

        </div>
    </div>
    <div class="box-body no-padding">
        <div class="table-responsive no-margin">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Tipe</th>
                        <th>Tanggal</th>
                        <th>Nilai</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1+$offset;
                        foreach ($data as $key => $value){
                    ?>
                    <tr onclick="window.location.href = '<?php echo base_url('trans/edit/'.$value->id); ?>'">
                        <td><?php echo $no; ?></td>
                        <td><span class="badge <?php echo $value->type=='IN'?'bg-green':'bg-red'?>"><?php echo $value->type; ?></span></td>
                        <td><?php echo format_dmy($value->date); ?></td>
                        <td><?php echo number_format($value->value); ?></td>
                        <td><?php echo $value->remark; ?></td>
                    </tr>
                    <?php $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="box-footer">
        <label><?php echo isset($total)?$total:'' ?></label>
        <div class="pull-right">
            <?php echo isset($paging)?$paging:'' ?>
        </div>
    </div>
</div>
