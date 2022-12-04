<div class="box box-default">
    <form id="form_data" method="post">
        <div class="box-header with-border">
            <div class="pull-left">
                <h4><strong>FORMULIR REKANAN</strong></h4>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
            <input type="hidden" id="id" name="id" value="<?php echo isset($data->id)?$data->id:'' ?>">
            <tr>
                <td><label>Nama Rekanan *</label></td>
                <td><input type="text" id="nama" name="nama" class="form-control" value="<?php echo isset($data->nama)?htmlentities($data->nama):'' ?>"></td>
            </tr>
            <tr>
                <td><label>Nama Direktur</label></td>
                <td><input type="text" id="direktur" name="direktur" class="form-control" value="<?php echo isset($data->direktur)?htmlentities($data->direktur):'' ?>"></td>
            </tr>
            <tr>
                <td><label>Alamat</label></td>
                <td><textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control"><?php echo isset($data->alamat)?htmlentities($data->alamat):'' ?></textarea></td>
            </tr>
            <tr>
                <td><label>NPWP</label></td>
                <td><input type="text" id="npwp" name="npwp" class="form-control" value="<?php echo isset($data->npwp)?htmlentities($data->npwp):'' ?>"></td>
            </tr>
            <tr>
                <td><label>Telepon</label></td>
                <td><input type="text" id="tlp" name="tlp" class="form-control" value="<?php echo isset($data->tlp)?htmlentities($data->tlp):'' ?>"></td>
            </tr>
            <tr>
                <td><label>Bank</label></td>
                <td><input type="text" id="bank" name="bank" class="form-control" value="<?php echo isset($data->bank)?htmlentities($data->bank):'' ?>"></td>
            </tr>
            <tr>
                <td><label>No Rekening</label></td>
                <td><input type="text" id="norek" name="norek" class="form-control" value="<?php echo isset($data->norek)?htmlentities($data->norek):'' ?>"></td>
            </tr>
            </table>
        </div>
        <div class="box-footer">
            <button type="button" class="btn_action btn btn-primary" data-redirect="<?php echo base_url('rekanan/index').get_query_string() ?>" data-action="<?php echo $action ?>" data-form="#form_data" data-idle="<i class='fa fa-save'></i> Simpan" data-process="Menyimpan..."><i class='fa fa-save'></i> Simpan</button>
            <button type="button" class="btn_close btn btn-default" data-redirect="<?php echo base_url('rekanan/index').get_query_string() ?>"><i class='fa fa-close'></i> Kembali</button>
        </div>
    </form>
</div>