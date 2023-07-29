<div class="box box-default">
    <form id="form_data" method="post">
        <div class="box-header with-border">
            <div class="pull-left">
                <h4><strong>FORMULIR TOKO</strong></h4>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label>Nama Toko *</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo isset($data->name)?htmlentities($data->name):'' ?>">
                <script>document.getElementById("name").focus()</script>
            </div>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-sm-12 col-md-4 form-group">
                    <button type="button" class="btn_action btn btn-primary btn-block" data-redirect="<?php echo base_url('store/add').get_query_string() ?>" data-action="<?php echo $action ?>" data-form="#form_data" data-idle="<i class='fa fa-save'></i> Simpan Lalu Tambah Lagi" data-process="Menyimpan..."><i class='fa fa-save'></i> Simpan Lalu Tambah Lagi</button>
                </div>
                <div class="col-sm-12 col-md-4 form-group">
                    <button type="button" class="btn_action btn btn-primary btn-block" data-redirect="<?php echo base_url('store/index').get_query_string() ?>" data-action="<?php echo $action ?>" data-form="#form_data" data-idle="<i class='fa fa-save'></i> Simpan" data-process="Menyimpan..."><i class='fa fa-save'></i> Simpan</button>
                </div>
                <div class="col-sm-12 col-md-4 form-group">
                    <button type="button" class="btn_close btn btn-default btn-block" data-redirect="<?php echo base_url('store/index').get_query_string() ?>"><i class='fa fa-close'></i> Kembali</button>
                </div>
            </div>
        </div>
    </form>
</div>