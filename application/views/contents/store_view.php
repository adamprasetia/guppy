<div class="box box-default">
    <div class="box-header with-border">
        <div class="pull-left">
            <h4><strong>DATA TOKO</strong></h4>
        </div>
    </div>
    <div class="box-header with-border hidden-xs">
        <a href="<?php echo base_url('store/add').get_query_string() ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
        <a href="<?php echo now_url() ?>" class="btn btn-default"><i class="fa fa-refresh"></i> Refresh</a>
        <div class="pull-right">
            <input id="input_search" name="search" type="text" class="form-control" placeholder="Search..." data-url="<?php echo current_url() ?>" data-query-string="<?php echo get_query_string(array('search','page')) ?>" value="<?php echo $this->input->get('search') ?>">
        </div>
    </div>           
    <div class="box-header with-border visible-xs">
        <a href="<?php echo base_url('store/add').get_query_string() ?>" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Tambah</a>
        <a href="<?php echo now_url() ?>" class="btn btn-default btn-block"><i class="fa fa-refresh"></i> Refresh</a>
        <input id="input_search" name="search" type="text" class="form-control" placeholder="Search..." data-url="<?php echo current_url() ?>" data-query-string="<?php echo get_query_string(array('search','page')) ?>" value="<?php echo $this->input->get('search') ?>">
    </div>           
    <div class="box-body no-padding">
        <div class="table-responsive no-margin">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Toko</th>
                    </tr>
                </thead>
                <tbody>
                      <?php
                            $no=1+$offset;
                            foreach ($data as $key => $value){
                      ?>
                    <tr onclick="window.location.href = '<?php echo base_url('store/edit/'.$value->id).get_query_string(); ?>'">
                        <td><?php echo $no; ?></td>
                        <td><?php echo $value->name; ?></td>
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
