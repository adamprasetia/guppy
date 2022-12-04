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
            add_item(data);
        });
        $('#input-kode').val('');
    }
});   
function add_item(data)
{
    data = JSON.parse(data);

    var exist = false;
    for (let index = 0; index < $('.sell-qty').length; index++) {
        if($('.sell-id')[index].value == data.id){
            exist = true;
            $('.sell-qty')[index].value = parseInt($('.sell-qty')[index].value.replace(',',''))+1;
        }
    }
    if(!exist){
        $('#tbl-item tbody').append('<tr><input name="detail-id[]" class="sell-id" type="hidden" value="'+data.id+'"><td>'+data.sku+'</td><td>'+data.name+'</td><td><input name="detail-qty[]" class="input-uang form-control sell-qty" value="1"></td><td><input name="detail-amount[]" class="sell-amount input-uang form-control" value="'+data.sp+'"></td><td><input readonly name="total[]" class="sell-total input-uang form-control" value="'+data.sp+'"></td><td><button type="button" class="btn btn-danger btn-delete-row"><i class="fa fa-trash"></i></button></td></tr>');
    }

    calculate()

    $('.input-uang').priceFormat({
        prefix: '',
        thousandsSeparator: ',',
        centsLimit: 0
    });

}
$("#general-modal-iframe").on('load',function () {
    $(this).contents().find('.btn-choose-item').click(function () {
        var id = $(this).attr('data-id');
        var data = $("#general-modal-iframe").contents().find('#data-'+id).html();
        add_item(data);

        $('#general-modal').modal('hide');
    });
});

$('body').on('change keyup', '.sell-qty', function(){
    calculate()
});
$('body').on('change keyup', '.sell-amount', function(){
    calculate()
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
            $(t).parent().parent().remove();
            calculate()
        }
    })
  });

function calculate()
{
    var total_all = 0;
    for (let index = 0; index < $('.sell-qty').length; index++) {
        $total = parseInt($('.sell-qty')[index].value.replaceAll(',',''))*parseInt($('.sell-amount')[index].value.replaceAll(',',''));
        console.log($total)
        $('.sell-total')[index].value = $total;
        total_all += $total;
    }
    console.log(total_all);
    $('#sell-total-amount').val(total_all);

    $('.input-uang').priceFormat({
        prefix: '',
        thousandsSeparator: ',',
        centsLimit: 0
    });

}
</script>
