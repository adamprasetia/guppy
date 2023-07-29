<div class="box box-default">
    <?php if(empty($this->input->get('popup'))): ?>
    <div class="box-header with-border">
        <div class="pull-left">
            <h4><strong>DATA PRODUK</strong></h4>
        </div>
    </div>
    <?php endif ?>
    <div class="box-header with-border hidden-xs">
        <div class="row">
            <div class="col-sm-6 col-md-8 col-lg-9">
                <a href="<?php echo base_url('item/add').get_query_string() ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                <a href="<?php echo now_url() ?>" class="btn btn-default"><i class="fa fa-refresh"></i> Refresh</a>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <input id="input_search" name="search" type="text" class="form-control" placeholder="Search..." data-url="<?php echo current_url() ?>" data-query-string="<?php echo get_query_string(array('search','page')) ?>" value="<?php echo $this->input->get('search') ?>">
            </div>           
        </div>           
    </div>           
    <div class="box-header with-border visible-xs">
        <a href="<?php echo base_url('item/add').get_query_string() ?>" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Tambah</a>
        <a href="<?php echo now_url() ?>" class="btn btn-default btn-block"><i class="fa fa-refresh"></i> Refresh</a>
        <input id="input_search" name="search" type="text" class="form-control" placeholder="Search..." data-url="<?php echo current_url() ?>" data-query-string="<?php echo get_query_string(array('search','page')) ?>" value="<?php echo $this->input->get('search') ?>">
    </div>           
    <div class="box-body no-padding">
        <div class="table-responsive no-margin">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Produk</th>
                        <th>Kode Produk</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <?php if(!empty($this->input->get('popup'))): ?>
                        <th width="100">Aksi</th>
                        <?php endif ?>
                    </tr>
                </thead>
                <tbody>
                      <?php
                            $no=1+$offset;
                            foreach ($data as $key => $value){
                      ?>
                    <?php if(!empty($this->input->get('popup'))): ?>
                        <tr>
                        <div style="display:none" id="data-<?php echo $value->id ?>"><?php echo json_encode($value, JSON_NUMERIC_CHECK) ?></div>
                    <?php else: ?>
                        <tr onclick="window.location.href = '<?php echo base_url('item/edit/'.$value->id).get_query_string(); ?>'">
                    <?php endif ?>
                        <td data-id="<?php echo $value->id ?>" <?php echo !empty($this->input->get('popup'))?'class="btn-choose-item"':'' ?>><?php echo $no; ?></td>
                        <td data-id="<?php echo $value->id ?>" <?php echo !empty($this->input->get('popup'))?'class="btn-choose-item"':'' ?>><?php echo $value->name; ?></td>
                        <td data-id="<?php echo $value->id ?>" <?php echo !empty($this->input->get('popup'))?'class="btn-choose-item"':'' ?>><?php echo $value->sku; ?></td>
                        <td data-id="<?php echo $value->id ?>" <?php echo !empty($this->input->get('popup'))?'class="btn-choose-item"':'' ?>><?php echo number_format($value->bp); ?></td>
                        <td data-id="<?php echo $value->id ?>" <?php echo !empty($this->input->get('popup'))?'class="btn-choose-item"':'' ?>><?php echo number_format($value->sp); ?></td>
                        <td>
                            <?php if(!empty($this->input->get('popup'))): ?>
                                <a href="<?php echo base_url('item/edit/'.$value->id).get_query_string(); ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                            <?php endif ?>
                        </td>
                    </tr>
                      <?php $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="box-footer">
        <label><?php echo isset($total)?$total:'' ?></label>
        <div class="visible-xs">
            <?php echo isset($paging)?$paging:'' ?>
        </div>
        <div class="pull-right hidden-xs">
            <?php echo isset($paging)?$paging:'' ?>
        </div>
    </div>
</div>
