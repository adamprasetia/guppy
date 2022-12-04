<div class="box box-default">
    <form id="form_data" method="post">
        <div class="box-header with-border">
            <div class="pull-left">
                <h4><strong>FORMULIR KEUANGAN</strong></h4>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered">                
                <tr>
                    <td><label>Tipe *</label></td>
                    <td><select name="type" id="type" class="form-control">
                        <option <?php echo (isset($data->type) && $data->type=='IN'?'selected':'')?> value="IN">IN</option>
                        <option <?php echo (isset($data->type) && $data->type=='OUT'?'selected':'')?> value="OUT">OUT</option>
                    </select></td>
                </tr>
                <tr>
                    <td><label>Tanggal*</label></td>
                    <td><input type="text" id="date" name="date" class="form-control datetimepicker" value="<?php echo isset($data->date)?format_dmy($data->date):date('d/m/Y') ?>"></td>
                </tr>
                <tr>
                    <td><label>Nilai*</label></td>
                    <td>
                        <input type="text" id="value" name="value" class="input-uang form-control" value="<?php echo isset($data->value)?$data->value:'' ?>">
                    </td>
                </tr>
                <tr>
                    <td><label>Keterangan</label></td>
                    <td>
                        <input type="text" id="remark" name="remark" class="form-control" value="<?php echo isset($data->remark)?$data->remark:'' ?>">        
                    </td>
                </tr>
            </table>
        </div>
        <div class="box-footer">
            <button type="button" class="btn_action btn btn-primary" data-redirect="<?php echo base_url('trans/index').get_query_string() ?>" data-action="<?php echo $action ?>" data-form="#form_data" data-idle="<i class='fa fa-save'></i> Simpan" data-process="Menyimpan..."><i class='fa fa-save'></i> Simpan</button>
            <button type="button" class="btn_close btn btn-default" data-redirect="<?php echo base_url('trans/index').get_query_string() ?>"><i class='fa fa-close'></i> Kembali</button>
        </div>
    </form>
</div>