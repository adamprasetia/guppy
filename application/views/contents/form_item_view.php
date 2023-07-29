<div class="box box-default">
    <form id="form_data" method="post">
        <div class="box-header with-border">
            <div class="pull-left">
                <h4><strong>FORMULIR PRODUK</strong></h4>
            </div>
            <?php if(!empty($data)): ?>
                <div class="pull-right">
                    <button class="btn btn-default" type="button" name="button" data-callback="<?php echo base_url('item'); ?>" data-url="<?php echo base_url('item/delete/'.$data->id); ?>" onclick="return deleteData(this)"><i class="fa fa-trash"></i></button>
                </div>
            <?php endif ?>
        </div>
        <div class="box-body">
            <input type="hidden" id="id" name="id" value="<?php echo isset($data->id)?$data->id:'' ?>">
            <div class="form-group">
                <label>Kode Produk *</label>
                <input type="text" id="sku" name="sku" class="form-control" value="<?php echo isset($data->sku)?htmlentities($data->sku):'' ?>">
                <script>document.getElementById("sku").focus()</script>
            </div>
            <div class="form-group">
                <label>Nama Produk *</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo isset($data->name)?htmlentities($data->name):'' ?>">
            </div>
            <div class="form-group">
                <label>Harga Beli</label>
                <input type="number" id="bp" name="bp" class="form-control" value="<?php echo isset($data->bp)?htmlentities($data->bp):'' ?>">
            </div>
            <div class="form-group">
                <label>Harga Jual</label>
                <input type="text" id="sp" name="sp" class="form-control" value="<?php echo isset($data->sp)?htmlentities($data->sp):'' ?>">
            </div>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-sm-12 col-md-4 form-group">
                    <button type="button" class="btn_action btn btn-primary btn-block" data-redirect="<?php echo base_url('item/add').get_query_string() ?>" data-action="<?php echo $action ?>" data-form="#form_data" data-idle="<i class='fa fa-save'></i> Simpan Lalu Tambah Lagi" data-process="Menyimpan..."><i class='fa fa-save'></i> Simpan Lalu Tambah Lagi</button>
                </div>
                <div class="col-sm-12 col-md-4 form-group">
                    <button type="button" class="btn_action btn btn-primary btn-block" data-redirect="<?php echo base_url('item/index').get_query_string() ?>" data-action="<?php echo $action ?>" data-form="#form_data" data-idle="<i class='fa fa-save'></i> Simpan" data-process="Menyimpan..."><i class='fa fa-save'></i> Simpan</button>
                </div>
                <div class="col-sm-12 col-md-4 form-group">
                    <button type="button" class="btn_close btn btn-default btn-block" data-redirect="<?php echo base_url('item/index').get_query_string() ?>"><i class='fa fa-close'></i> Kembali</button>
                </div>
            </div>
        </div>
    </form>
</div>