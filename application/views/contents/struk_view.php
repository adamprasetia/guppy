<html>
<head>
<title>Faktur Pembayaran</title>
<style>
 
#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
padding-left:5px;
border: 1px solid black;
}
</style>
</head>
<body style='font-family:tahoma; font-size:8pt;'>
<center><table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='CENTER' vertical-align:top'><span style='color:black;'>
<b><?php echo $data->store->name ?></b></span></br>
 
 
<span style='font-size:12pt'>No. : <?php echo $data->nomor.', '.date('Y-m-d H:i:s') ?></span></br>
</td>
</table>
<style>
hr { 
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 1px;
} 
</style>
<table cellspacing='0' cellpadding='0' style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>
 
<tr align='center'>
<td width='10%'>Item</td>
<td width='13%'>Price</td>
<td width='4%'>Qty</td>
<td width='20%'>Total</td><tr>
<td colspan='4'><hr></td></tr>
</tr>
<?php $total=0;foreach ($data->item as $key => $value) { ?>
    <tr><td style='vertical-align:top'><?php echo $value->name ?></td>
    <td style='vertical-align:top; text-align:right; padding-right:10px'><?php echo number_format($value->amount) ?></td>
    <td style='vertical-align:top; text-align:right; padding-right:10px'><?php echo number_format($value->qty) ?></td>
    <td style='text-align:right; vertical-align:top'><?php echo number_format($value->amount*$value->qty) ?></td></tr>
    <tr>
<?php $total+=$value->amount*$value->qty;} ?>
<td colspan='4'><hr></td>
</tr>
<tr>
<td colspan = '3'><div style='text-align:right'>Sub Total : </div></td><td style='text-align:right; font-size:16pt;'><?php echo number_format($total) ?></td>
</tr>
<tr>
<td colspan = '3'><div style='text-align:right; color:black'>Diskon : </div></td><td style='text-align:right; font-size:16pt; color:black'><?php echo number_format($data->diskon) ?></td>
</tr>
<tr>
<td colspan = '3'><div style='text-align:right; color:black'>Total Tagihan : </div></td><td style='text-align:right; font-size:16pt; color:black'><?php echo number_format($total-$data->diskon) ?></td>
</tr>
<tr>
<td colspan = '3'><div style='text-align:right; color:black'>Total Pembayaran : </div></td><td style='text-align:right; font-size:16pt; color:black'><?php echo number_format($data->total_pembayaran) ?></td>
</tr>
<tr>
<td colspan = '3'><div style='text-align:right; color:black'>Kembali : </div></td><td style='text-align:right; font-size:16pt; color:black'><?php echo !empty($data->total_pembayaran)?number_format($data->total_pembayaran-($total-$data->diskon)):'0' ?></td>
</tr>
</table>
<table style='width:350; font-size:12pt;' cellspacing='2'><tr></br><td align='center'>****** TERIMAKASIH ******</br></td></tr></table></center>
<script>
    window.print()
</script>
</body>
</html>