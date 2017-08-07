<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<thead style="font-size:12px">
  <tr>
    <th><center>Id</center></th>
    <th><center>Kode Barang</center></th>
    <th><center>Nama Barang</center></th>
    <th><center>Satuan</center></th>
    <th><center>Saldo Awal</center></th>
    <th><center>Pemasukan</center></th>
    <th><center>Pengeluaran</center></th>
    <th><center>Penyesuaian</center></th>
    <th><center>Saldo Akhir</center></th>
    <th><center>Stock Opname</center></th>
    <th><center>Selisih</center></th>
    <th><center>Keterangan</center></th>
    <th><center>Approve <input type="checkbox" onchange="checkApprove(this)"></center></th>
  </tr>
</thead>
<tbody style="font-size:12px">
  <?php foreach ($dataMutasi as $key => $detail): ?>
    <tr <?php if (cekApproved($dataMutasiApproved,$detail->IdDetail)==true): ?>
      style="background-color: #ccffcc"
    <?php endif ?>
    >
      <td><center><?php echo $detail->IdDetail;?></td>
      <td><center><?php echo $detail->KodeBarang;?></center></td>
      <td><center><?php echo $detail->NamaBarang;?></td>
      <td><center><?php echo $detail->Sat;?></center></td>
      <td><center><?php echo number_format($detail->SaldoAwal, 4, ',', '.');;?></center></td>
      <td><center><?php echo number_format($detail->Pemasukan, 4, ',', '.');?></center></td>
      <td><center><?php echo number_format($detail->Pengeluaran, 4, ',', '.');?></center></td>
      <td><center><?php echo number_format($detail->Penyesuaian, 4, ',', '.');?></center></td>
      <td><center><?php echo number_format($detail->SaldoAkhir, 4, ',', '.');?></center></td>
      <td><center><?php echo number_format($detail->StokOpname, 4, ',', '.');?></center></td>
      <td><center><?php echo number_format($detail->Selisih, 4, ',', '.');?></center></td>
      <td><center><?php echo $detail->Keterangan;?></center></td>
      <td><center><input id="chkApproval" type="checkbox" value="<?php echo $detail->IdDetail;?>" <?php if (cekApproved($dataMutasiApproved,$detail->IdDetail)==true): ?>
        checked disabled
      <?php endif ?>></center></td>
    </tr>
<?php endforeach ?>
</tbody>
<?php 
  function cekApproved($array,$iddetail)
  {
    $sama=false;
    foreach ($array as $key => $value) 
    {      
      if($value->IdDetail==$iddetail)
      {
        $sama=true;
      }
    }
    return $sama;
  }
 ?>
 <script>
   
 </script>