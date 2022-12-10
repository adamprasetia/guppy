<script>
$('#btn-item-add').click(function(){
    $('#general-modal-title').html('Pilih Produk');
    $('#general-modal-iframe').attr('src', '<?php echo base_url('item?popup=1') ?>');
    $('#general-modal').modal('show');
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
        $.each(detail, function(index, value){
            if(value.item_id == data.id && value.amount == data.amount){
                exist = true;
                detail[index].qty++;
            }
        })
        if(!exist){
            detail.push({
                'qty':data.qty,
                'amount':data.amount,
                'item_id':data.item_id,
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
    data[index] = item
    console.log(data)
    $('#detail').html(JSON.stringify(data))
    gen_table_detail()
}
$("#general-modal-iframe").on('load',function () {
    $(this).contents().find('.btn-choose-item').click(function () {
        var id = $(this).attr('data-id');
        var data = JSON.parse($("#general-modal-iframe").contents().find('#data-'+id).html());
        $('#item_id').val(data.id)
        $('#item_sku').val(data.sku)
        $('#item_name').val(data.name)
        $('#qty').val(1)
        $('#amount').val(data.bp)

        $('.input-uang').priceFormat({
            prefix: '',
            thousandsSeparator: ',',
            centsLimit: 0
        });

        $('#general-modal').modal('hide');
    });
});

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
                data.splice(index, 1); // 2nd parameter means remove one item only
            }
            $('#detail').html(JSON.stringify(data))
            gen_table_detail()
        }
    })
  });

gen_table_detail()
function gen_table_detail()
{
    var data = JSON.parse($('#detail').val())
    console.log(data)
    var body ='';
    var total = 0;
    $.each(data, function(index, value){
        total += value.qty*value.amount
        body += '<tr><td onclick="detail_edit('+index+')">'+value.name+'<br>('+value.sku+')</td><td onclick="detail_edit('+index+')">'+value.qty.format()+'</td><td>'+value.amount.format()+'</td><td>'+(value.qty*value.amount).format()+'</td><td><button data-index="'+index+'" type="button" class="btn btn-danger btn-delete-row"><i class="fa fa-trash"></i></button></td></tr>'
    })
    $('#tbl-item tbody').html(body);
    $('#buy-total-amount').html(total.format());
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

function detail_edit(index){
    var data = JSON.parse($('#detail').val())
    $('#detail-index').val(index)
    $('#item_sku').val(data[index].sku)
    $('#item_name').val(data[index].name)
    $('#qty').val(data[index].qty)
    $('#amount').val(data[index].amount)
    $('#btn-detail-add').hide()
    $('#form-detail').show()
    $('#btn-detail-save').html('Update')
    $('#form-detail-title').html('Formulir Update Item')

    $('.input-uang').priceFormat({
        prefix: '',
        thousandsSeparator: ',',
        centsLimit: 0
    });

}
</script>
