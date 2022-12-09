<div class="box box-default">
    <form id="form_data" method="post">
        <div class="box-header with-border">
            <div class="pull-left">
                <h4><strong>FORMULIR PEMBELIAN</strong></h4>
            </div>
            <?php if(!empty($data)): ?>
                <div class="pull-right">
                    <button class="btn btn-default" type="button" name="button" data-callback="<?php echo base_url('buy'); ?>" data-url="<?php echo base_url('buy/delete/'.$data->id); ?>" onclick="return deleteData(this)"><i class="fa fa-trash"></i></button>
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
        <div class="box-body">
            <div class="input-group">
                <input id="input-kode" type="text" class="form-control" placeholder="Masukan Kode Produk...Lalu tekan ENTER">
                <span class="input-group-btn">
                    <button type="button" id="btn-item-add" class="btn btn-success">Pilih Produk</button>
                </span>
            </div>

            <div class="table-responsive no-margin">
            <table id="tbl-item" class="table table-bordered">
                <thead>
                <tr>
                    <th>Produk</th>
                    <th style="min-width:100px" >Jumlah</th>
                    <th style="min-width:120px">Harga</th>
                    <th style="min-width:140px">Total</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php $total = 0;if(!empty($detail)) :?>
                        <?php foreach ($detail as $key => $value) : ?>
                            <tr>
                                <input type="hidden" name="detail-id[]" class="buy-id" value="<?php echo $value->item_id ?>">
                                <td><?php echo $value->name ?><br>(<?php echo $value->sku ?>)</td>
                                <td><input type="text" name="detail-qty[]" class="input-uang buy-qty form-control" value="<?php echo number_format($value->qty) ?>"></td>
                                <td><input type="text" name="detail-amount[]" class="input-uang buy-amount form-control" value="<?php echo number_format($value->amount) ?>"></td>
                                <td><input type="text" name="detail-total[]" class="input-uang buy-total form-control" value="<?php echo number_format($value->qty*$value->amount) ?>"></td>
                                <td><button type="button" class="btn btn-danger btn-delete-row"><i class="fa fa-trash"></i></button></td>
                            </tr>                        
                        <?php $total+=$value->qty*$value->amount;endforeach ?>
                    <?php endif ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td colspan="4"><strong><input id="buy-total-amount" readonly type="text" value="<?php echo number_format($total)?>" class="input-uang form-control"></strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
        <div class="box-footer">
            <button type="button" class="btn_action btn btn-primary" data-redirect="<?php echo base_url('buy/index').get_query_string() ?>" data-action="<?php echo $action ?>" data-form="#form_data" data-idle="<i class='fa fa-save'></i> Simpan" data-process="Menyimpan..."><i class='fa fa-save'></i> Simpan</button>
            <button type="button" class="btn_close btn btn-default" data-redirect="<?php echo base_url('buy/index').get_query_string() ?>"><i class='fa fa-close'></i> Kembali</button>
        </div>
    </form>
</div>