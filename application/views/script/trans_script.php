<script>
$('.btn-pilih-item').click(function(){
    $('#general-modal-title').html('Pilih Produk');
    $('#general-modal-iframe').attr('src', '<?php echo base_url('item?popup=1') ?>');
    $('#general-modal').modal('show');
})
$("#general-modal-iframe").on('load',function () {
    $(this).contents().find('.btn-choose-item').click(function () {
        var id = $(this).attr('data-id');
        var data = $("#general-modal-iframe").contents().find('#data-'+id).html();
        data = JSON.parse(data);
        $('#item_id').val(data.id);
        $('#item_sku').val(data.sku);
        $('#item_name').val(data.name);
        $('#value').val(data.sp);
        $('#general-modal').modal('hide');
    });
});

</script>
