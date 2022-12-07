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
            <table class="table table-bordered">
            <input type="hidden" id="id" name="id" value="<?php echo isset($data->id)?$data->id:'' ?>">
            <tr>
                <td><label>Nama Produk *</label></td>
                <td><input type="text" id="name" name="name" class="form-control" value="<?php echo isset($data->name)?htmlentities($data->name):'' ?>"></td>
            </tr>
            <tr>
                <td><label>Kode Produk *</label></td>
                <td><input type="text" id="sku" name="sku" class="form-control" value="<?php echo isset($data->sku)?htmlentities($data->sku):'' ?>"></td>
            </tr>
            <tr>
                <td><label>Harga Beli</label></td>
                <td><input type="text" id="bp" name="bp" class="input-uang form-control" value="<?php echo isset($data->bp)?htmlentities($data->bp):'' ?>"></td>
            </tr>
            <tr>
                <td><label>Harga Jual</label></td>
                <td><input type="text" id="sp" name="sp" class="input-uang form-control" value="<?php echo isset($data->sp)?htmlentities($data->sp):'' ?>"></td>
            </tr>
            </table>
        </div>
        <div class="box-footer">
            <button type="button" class="btn_action btn btn-primary" data-redirect="<?php echo base_url('item/index').get_query_string() ?>" data-action="<?php echo $action ?>" data-form="#form_data" data-idle="<i class='fa fa-save'></i> Simpan" data-process="Menyimpan..."><i class='fa fa-save'></i> Simpan</button>
            <button type="button" class="btn_close btn btn-default" data-redirect="<?php echo base_url('item/index').get_query_string() ?>"><i class='fa fa-close'></i> Kembali</button>
        </div>
    </form>
</div>