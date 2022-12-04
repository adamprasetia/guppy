<div class="box box-default">
    <form id="form_data" method="post">
        <div class="box-header with-border">
            <div class="pull-left">
                <h4><strong>FORMULIR TOKO</strong></h4>
            </div>
        </div>
        <div class="box-body">
        <table class="table table-bordered">
            <input type="hidden" id="id" name="id" value="<?php echo isset($data->id)?$data->id:'' ?>">
            <tr>
                <td><label>Nama Toko *</label></td>
                <td><input type="text" id="name" name="name" class="form-control" value="<?php echo isset($data->name)?htmlentities($data->name):'' ?>"></td>
            </tr>
        </table>
        </div>
        <div class="box-footer">
            <button type="button" class="btn_action btn btn-primary" data-redirect="<?php echo base_url('store/index').get_query_string() ?>" data-action="<?php echo $action ?>" data-form="#form_data" data-idle="<i class='fa fa-save'></i> Simpan" data-process="Menyimpan..."><i class='fa fa-save'></i> Simpan</button>
            <button type="button" class="btn_close btn btn-default" data-redirect="<?php echo base_url('store/index').get_query_string() ?>"><i class='fa fa-close'></i> Kembali</button>
        </div>
    </form>
</div>