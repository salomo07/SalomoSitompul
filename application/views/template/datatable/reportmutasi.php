<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<thead style="font-size:12px">
  <tr>
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
    <th><center>Pilih <input type="checkbox" onchange="checkAll(this)"></center></th>
  </tr>
</thead>
<tbody style="font-size:12px">
  <?php foreach ($dataMutasi as $key => $detail): ?>
    <tr>
      <td><center><?php echo $detail->KodeBarang;?></center></td>
      <td><center><?php echo $detail->NamaBarang;?></td>
      <td><center><?php echo $detail->Sat;?></center></td>
      <td><center><?php echo $detail->SaldoAwal;?></center></td>
      <td><center><?php echo $detail->Pemasukan;?></center></td>
      <td><center><?php echo $detail->Pengeluaran;?></center></td>
      <td><center><?php echo $detail->Penyesuaian;?></center></td>
      <td><center><?php echo $detail->SaldoAkhir;?></center></td>
      <td><center><?php echo $detail->StokOpname;?></center></td>
      <td><center><?php echo $detail->Selisih;?></center></td>
      <td><center><?php echo $detail->Keterangan;?></center></td>
      <td><center><input id="chkPilih" type="checkbox" value="<?php echo $detail->IdDetail;?>"></center></td>
    </tr>
<?php endforeach ?>
<?php if (count($dataMutasi)==0): ?>
  <tr>
      <td><center></center></td>
      <td><center></center></td>
      <td><center></center></td>
      <td><center></center></td>
      <td><center></center></td>
      <td><center></center></td>
      <td><center></center></td>
      <td><center></center></td>
      <td><center></center></td>
      <td><center></center></td>
      <td><center></center></td>
      <td><center></center></td>
    </tr>
<?php endif ?>
</tbody>
