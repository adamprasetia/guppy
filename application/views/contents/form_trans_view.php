<div class="box box-default">
    <form id="form_data" method="post">
        <div class="box-header with-border">
            <div class="pull-left">
                <h4><strong>FORMULIR KEUANGAN</strong></h4>
            </div>
            <?php if(!empty($data)): ?>
                <div class="pull-right">
                    <button class="btn btn-default" type="button" name="button" data-callback="<?php echo base_url('trans'); ?>" data-url="<?php echo base_url('trans/delete/'.$data->id); ?>" onclick="return deleteData(this)"><i class="fa fa-trash"></i></button>
                </div>
            <?php endif ?>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label>Tipe *</label>
                <select name="type" id="type" class="form-control">
                    <option <?php echo (isset($data->type) && $data->type=='IN'?'selected':'')?> value="IN">CREDIT</option>
                    <option <?php echo (isset($data->type) && $data->type=='OUT'?'selected':'')?> value="OUT">DEBIT</option>
                </select>
                <small><i>CREDIT = Pemasukan, DEBIT : Pengeluaran</i></small>
                
            </div>
            <div class="form-group">
                <label>Tanggal*</label>
                <input type="date" id="date" name="date" class="form-control" value="<?php echo isset($data->date)?$data->date:date('Y-m-d') ?>">
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                
                    <input type="text" id="remark" name="remark" class="form-control" value="<?php echo isset($data->remark)?$data->remark:'' ?>">        
                    <script>document.getElementById("remark").focus()</script>
                
            </div>
            <div class="form-group">
                <label>Nilai*</label>
                
                    <input type="number" id="value" name="value" class="form-control" value="<?php echo isset($data->value)?$data->value:'' ?>">
                
            </div>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-sm-12 col-md-4 form-group">
                    <button type="button" class="btn_action btn btn-primary btn-block" data-redirect="<?php echo base_url('trans/add').get_query_string() ?>" data-action="<?php echo $action ?>" data-form="#form_data" data-idle="<i class='fa fa-save'></i> Simpan Lalu Tambah Lagi" data-process="Menyimpan..."><i class='fa fa-save'></i> Simpan Lalu Tambah Lagi</button>
                </div>
                <div class="col-sm-12 col-md-4 form-group">
                    <button type="button" class="btn_action btn btn-primary btn-block" data-redirect="<?php echo base_url('trans/index').get_query_string() ?>" data-action="<?php echo $action ?>" data-form="#form_data" data-idle="<i class='fa fa-save'></i> Simpan" data-process="Menyimpan..."><i class='fa fa-save'></i> Simpan</button>
                </div>
                <div class="col-sm-12 col-md-4 form-group">
                    <button type="button" class="btn_close btn btn-default btn-block" data-redirect="<?php echo base_url('trans/index').get_query_string() ?>"><i class='fa fa-close'></i> Kembali</button>
                </div>
            </div>
        </div>
    </form>
</div>