<form id="form_print" action="<?php echo base_url('cashier/print') ?>" target="_blank" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">Total Tagihan</div>
                <div class="box-body">
                    <h1 class="total-tagihan">0</h1>
                </div>
            </div>
            <div class="box">
                <div id="form-detail" class="box-body">
                    <input type="hidden" id="detail-index" name="">
                    <div class="form-group">
                        <label for="">Masukan Kode Produk Lalu Tekan ENTER</label>
                        <div class="input-group">
                            <input id="input-kode" type="text" class="form-control" placeholder="">
                            <span class="input-group-btn">
                                <button type="button" id="btn-item-add" class="btn btn-success">Cari Produk</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <textarea style="display:none" class="detail" name="detail" type="text">{"total_pembayaran":0, "diskon":0, "item":[]}</textarea>
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
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-body">
                    <table class="table table-bordered">                
                        <tr>
                            <td><label>Tanggal</label></td>
                            <td><input type="text" id="date" name="date" class="form-control datetimepicker" value="<?php echo isset($data->date)?format_dmy($data->date):date('d/m/Y') ?>"></td>
                        </tr>
                        <tr>
                            <td><label>Order ID</label></td>
                            <td>
                                <input type="text" id="nomor" name="nomor" class="form-control" value="<?php echo isset($data->nomor)?$data->nomor:time() ?>">        
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="box box-default">
        <div class="box-body">
            <table class="table table-bordered">                
                <tr>
                    <td><label>Sub Total</label></td>
                    <td><span id="sub-total"></span></td>
                </tr>
                <tr>
                    <td><label>Diskon</label></td>
                    <td>
                        <input type="text" id="diskon" name="diskon" class="input-uang form-control" value="">        
                    </td>
                </tr>
                <tr>
                    <td><label>Total Tagihan</label></td>
                    <td><strong class="total-tagihan"></strong></td>
                </tr>
                <tr>
                    <td><label>Total Pembayaran</label></td>
                    <td>
                        <input type="text" id="total-pembayaran" name="total-pembayaran" class="input-uang form-control" value="">        
                    </td>
                </tr>
                <tr>
                    <td><label>Kembalian</label></td>
                    <td><span id="kembalian"></span></td>
                </tr>
            </table>
        </div>
    </div>
        </div>
    </div>
    <div class="box">
        <div class="box-body">
            <button type="button" class="btn_action btn btn-primary" data-redirect="<?php echo base_url('cashier/index').get_query_string() ?>" data-action="<?php echo $action ?>" data-form="#form_data" data-idle="<i class='fa fa-save'></i> Simpan" data-process="Menyimpan...">Checkout</button>
            <button type="button" class="btn_print btn btn-default">Cetak</button>
        </div>
    </div>
</form>