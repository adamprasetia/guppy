<div class="box box-default">
    <?php if(empty($this->input->get('popup'))): ?>
    <div class="box-header with-border">
        <div class="pull-left">
            <h4><strong>DATA KEUANGAN</strong></h4>
        </div>
    </div>
    <?php endif ?>
    <div class="box-header with-border">
        <div class="row">
            <div class="col-sm-6 col-md-8 col-lg-9">
                <a href="<?php echo base_url('trans/add') ?>" class="btn btn-default"><i class="fa fa-plus"></i> Tambah</a>
                <button id="btn-filter" class="btn btn-default"><i class="fa fa-filter"></i> Filter</button>
                <a href="<?php echo now_url() ?>" class="btn btn-default"><i class="fa fa-refresh"></i> Refresh</a>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <input id="input_search" name="search" type="text" class="form-control" placeholder="Search..." data-url="<?php echo current_url() ?>" data-query-string="<?php echo get_query_string(array('search','page')) ?>" value="<?php echo $this->input->get('search') ?>">
            </div>           
        </div>           
    </div>
    <div class="box-header with-border filter-wrap">
        <form id="filter-form" action="<?php echo base_url('trans') ?>" method="get">
            <div class="form-group">
                <label for="" class="label-control">Tipe</label>
                <select name="type" id="type" class="form-control">
                    <option <?php echo ($this->input->get('type')==''?'selected':'')?> value=""></option>
                    <option <?php echo ($this->input->get('type')=='IN'?'selected':'')?> value="IN">CREDIT</option>
                    <option <?php echo ($this->input->get('type')=='OUT'?'selected':'')?> value="OUT">DEBIT</option>
                </select>
            </div>
            <div class="form-group">
                <label for="" class="label-control">Tanggal</label>
                <input type="text" name="from" placeholder="From" class="datetimepicker2 form-control" value="<?php echo $this->input->get('from') ?>">
                <input type="text" name="to" placeholder="To" class="datetimepicker2 form-control" value="<?php echo $this->input->get('to') ?>">
            </div>
            <input onclick="document.getElementById('filter-form').submit();" type="button" value="Filter" class="btn btn-default">
            <a href="<?php echo base_url('trans') ?>" id="reset-search" class="btn btn-default">Reset</a>
        </form>
    </div>
    <div class="box-body no-padding">
        <div class="table-responsive no-margin">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Debit</th>
                        <th>Credit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no=1+$offset;
                        foreach ($data as $key => $value){
                    ?>
                    <tr onclick="window.location.href = '<?php echo base_url('trans/edit/'.$value->id); ?>'">
                        <td><?php echo $no; ?></td>
                        <td><?php echo format_dmy($value->date); ?></td>
                        <td><?php echo $value->remark; ?></td>
                        <td><?php echo $value->type=='OUT'?number_format($value->value):''; ?></td>
                        <td><?php echo $value->type=='IN'?number_format($value->value):''; ?></td>
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
