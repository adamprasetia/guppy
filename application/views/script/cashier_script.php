<script>
$('#btn-item-add').click(function(){
    $('#general-modal-title').html('Pilih Produk');
    $('#general-modal-iframe').attr('src', '<?php echo base_url('item?popup=1') ?>');
    $('#general-modal').modal('show');
})
$('#diskon').on('keyup change', function(){
    var detail = JSON.parse($('#detail').val())
    detail.diskon = $(this).val().replace(',', '')
    $('#detail').html(JSON.stringify(detail));
    gen_table_detail()

})
$('#total-pembayaran').on('keyup change', function(){
    console.log($(this).val().replace(',', ''))
    var detail = JSON.parse($('#detail').val())
    detail.total_pembayaran = $(this).val().replace(',', '')
    $('#detail').html(JSON.stringify(detail));
    gen_table_detail()

})
$('#input-kode').keypress(function (e) {
    var key = e.which;
    if(key == 13)  // the enter key code
    {
        $.get('<?php echo base_url() ?>item/find?search='+$(this).val(), function(data, status){
            add_item(JSON.parse(data));
        });
        $('#input-kode').val('');
    }
});   
function add_item(data)
{
    if(data){
        var detail = JSON.parse($('#detail').val())

        var exist = false;
        $.each(detail.item, function(index, value){
            if(value.item_id == data.id){
                exist = true;
                detail.item[index].qty++;
            }
        })
        if(!exist){
            detail.item.push({
                'qty':1,
                'amount':data.sp,
                'item_id':data.id,
                'name':data.name,
                'sku':data.sku,
            });
        }
        console.log(detail)
        $('#detail').html(JSON.stringify(detail));
        gen_table_detail()
    }
}
function edit_item(index, item){
    var data = JSON.parse($('#detail').val())
    data.item[index] = item
    console.log(data)
    $('#detail').html(JSON.stringify(data))
    gen_table_detail()
}
$("#general-modal-iframe").on('load',function () {
    $(this).contents().find('.btn-choose-item').click(function () {
        var id = $(this).attr('data-id');
        var data = JSON.parse($("#general-modal-iframe").contents().find('#data-'+id).html());
        add_item(data)
        $('#general-modal').modal('hide');
        $('#input-kode').focus()
    });
});
$('#input-kode').focus()
$('body').on('click', '.btn-delete-row', function(){
    var t = $(this);
    swal({
      title: 'Kamu yakin ?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Yes',
      closeOnConfirm: true
    },function(result){
        if(result){
            // $(t).parent().parent().remove();
            var data = JSON.parse($('#detail').val())
            const index = t.attr('data-index');
            if (index > -1) { // only splice array when item is found
                data.item.splice(index, 1); // 2nd parameter means remove one item only
            }
            $('#detail').html(JSON.stringify(data))
            gen_table_detail()
            $('#input-kode').focus()
        }
    })
  });

gen_table_detail()
function gen_table_detail()
{
    var data = JSON.parse($('#detail').val())
    console.log(data)
    var body ='';
    var sub_total = 0;
    $.each(data.item, function(index, value){
        sub_total += value.qty*value.amount
        body += '<tr><td>'+value.name+'<br>('+value.sku+')</td><td onclick="detail_edit(this, '+index+')">'+value.qty.format()+'</td><td>'+value.amount.format()+'</td><td>'+(value.qty*value.amount).format()+'</td><td><button data-index="'+index+'" type="button" class="btn btn-danger btn-delete-row"><i class="fa fa-trash"></i></button></td></tr>'
    })
    $('#tbl-item tbody').html(body);
    $('#sub-total').html(sub_total.format());
    $('.total-tagihan').html((sub_total-data.diskon).format());
    if(data.total_pembayaran){
    $('#kembalian').html((data.total_pembayaran-(sub_total-data.diskon)).format());
    }
}

$('#btn-detail-add').click(function(){
    $('#btn-detail-add').hide()
    $('#form-detail').show()
    $('#btn-item-add').click()
    $('#btn-detail-save').html('Tambahkan')
    $('#form-detail-title').html('Formulir Tambah Item')
})
$('#btn-detail-cancel').click(function(){
    $('#btn-detail-add').show()
    $('#form-detail').hide()
    $('#form-detail-title').html('')
})
$('#btn-detail-save').click(function(){
    item = {
        'item_id':$('#item_id').val(),
        'name':$('#item_name').val(),
        'sku':$('#item_sku').val(),
        'qty':parseInt($('#qty').val().replaceAll(',','')),
        'amount':parseInt($('#amount').val().replaceAll(',','')),
    }
    if($(this).text() == 'Tambahkan'){
        add_item(item)
    }else{
        index = $('#detail-index').val()
        edit_item(index, item)
    }
    $('#btn-detail-add').show()
    $('#form-detail').hide()
    $('#form-detail-title').html('')
})

function detail_edit(t, index){
    var data = JSON.parse($('#detail').val())
    $(t).removeAttr('onclick')
    $(t).html('<input type="number" min="1" style="min-width:100px" data-index="'+index+'" class="input-qty form-control" value="'+data.item[index].qty+'">')

    $('.input-qty').focus()

}

$('#input-kode').keypress(function (e) {
    var key = e.which;
    if(key == 13)  // the enter key code
    {
        $.get('<?php echo base_url() ?>item/find?search='+$(this).val(), function(data, status){
            add_item(JSON.parse(data));
        });
        $('#input-kode').val('');
    }
});   

$('body').on('keypress', '.input-qty', function(e){
    var key = e.which;
    var val = parseInt($(this).val());
    var index = $(this).attr('data-index');
    if(key == 13)  // the enter key code
    {
        var data = JSON.parse($('#detail').val())
        data.item[index].qty = val
        $('#detail').html(JSON.stringify(data))
        $(this).parent().attr('onclick', 'detail_edit(this, '+index+')')
        // $(this).parent().html(val)
        gen_table_detail()
    }
})
</script>
