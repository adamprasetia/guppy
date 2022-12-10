<div class="box box-default">
    <form id="form_data" method="post">
        <div class="box-header with-border">
            <div class="pull-left">
                <h4><strong>FORMULIR PENJUALAN</strong></h4>
            </div>
            <?php if(!empty($data)): ?>
                <div class="pull-right">
                    <button class="btn btn-default" type="button" name="button" data-callback="<?php echo base_url('sell'); ?>" data-url="<?php echo base_url('sell/delete/'.$data->id); ?>" onclick="return deleteData(this)"><i class="fa fa-trash"></i></button>
                </div>
            <?php endif ?>
        </div>
        <div class="box-body">
            <table class="table table-bordered">                
                <tr>
                    <td><label>Tanggal*</label></td>
                    <td><input type="text" id="date" name="date" class="form-control datetimepicker" value="<?php echo isset($data->date)?format_dmy($data->date):date('d/m/Y') ?>"></td>
                </tr>
                <tr>
                    <td><label>Keterangan</label></td>
                    <td>
                        <input type="text" id="remark" name="remark" class="form-control" value="<?php echo isset($data->remark)?$data->remark:'' ?>">        
                    </td>
                </tr>
                <tr>
                    <td><label>Nomor</label></td>
                    <td>
                        <input type="text" id="nomor" name="nomor" class="form-control" value="<?php echo isset($data->nomor)?$data->nomor:'' ?>">        
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <h4><strong>DETAIL PENJUALAN</strong></h4>
            <h4 id="form-detail-title"></h4>
            <button id="btn-detail-add" class="btn btn-success">Tambah</button>
        </div>
        <div id="form-detail" class="box-body" style="display:none">
            <input type="hidden" id="detail-index" name="">
            <div class="form-group">
                <label for="">Kode Produk</label>
                <div class="input-group">
                    <input id="item_id" type="hidden" class="form-control" placeholder="">
                    <input id="item_sku" type="text" class="form-control" placeholder="">
                    <span class="input-group-btn">
                        <button type="button" id="btn-item-add" class="btn btn-success">Pilih Produk</button>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="">Nama Produk</label>
                <input readonly type="text" id="item_name" name="item_name" class="form-control" value="">        
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="text" id="qty" name="qty" class="input-uang form-control" value="">
            </div>
            <div class="form-group">
                <label>Harga Satuan</label>
                <input type="text" id="amount" name="amount" class="input-uang form-control" value="">
            </div>
            <button id="btn-detail-save" class="btn btn-success">Tambahkan</button>
            <button id="btn-detail-cancel" class="btn btn-default">Batal</button>
        </div>
        <div class="box-body">
            <textarea style="display:none" id="detail" name="detail" type="text"><?php echo isset($detail)?json_encode($detail, JSON_NUMERIC_CHECK):'[]' ?></textarea>
            <div class="table-responsive no-margin">
            <table id="tbl-item" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td colspan="4"><strong id="sell-total-amount"></strong></td>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
        <div class="box-footer">
            <button type="button" class="btn_action btn btn-primary" data-redirect="<?php echo base_url('sell/index').get_query_string() ?>" data-action="<?php echo $action ?>" data-form="#form_data" data-idle="<i class='fa fa-save'></i> Simpan" data-process="Menyimpan..."><i class='fa fa-save'></i> Simpan</button>
            <button type="button" class="btn_close btn btn-default" data-redirect="<?php echo base_url('sell/index').get_query_string() ?>"><i class='fa fa-close'></i> Kembali</button>
        </div>
    </form>
</div>