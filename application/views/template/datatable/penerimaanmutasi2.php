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
    <th><center>Stok Opname</center></th>
    <th><center>Penyesuaian</center></th>
    <th><center>Saldo Akhir</center></th>
    <th><center>Selisih</center></th>
    <th><center>Keterangan</center></th>
    <th><center>Pilih <input type="checkbox" onchange="checkAll(this)"></center></th>
  </tr>
</thead>
<tbody style="font-size:12px">
  <?php foreach ($dataTransaksiMutasi as $key => $detail): ?>
    <tr> 
      <td>
        <center><input class="form-control" id="txtKodeBarang" size="25" value="<?php echo $detail->KodeBarang; ?>" disabled></center><input id="txtJenisMutasiModal" type="hidden" size="10" value="<?php echo $jenis; ?>">
      </td>
      <td><center><input class="form-control" id="txtDescBarang" type="text" size="80" style="text-align: center;" disabled value="<?php echo $detail->NamaBarang; ?>"></center></td>
      <td><center><input class="form-control" id="txtSatuan" type="text" size="5" style="text-align: center;" disabled value="<?php echo $detail->Sat; ?>"></center></td>
      <td><center><input class="form-control txtSaldoAwal" id="txtSaldoAwal" type="text" size="20" style="text-align: center;" value="<?php echo number_format($detail->SaldoAwal, 4, ',', '.'); ?>" onkeyup="getSaldoAkhir(this)"></center></td>
      <td><center><input class="form-control txtPemasukan" id="txtPemasukan" size="15" style="text-align: center;" value="<?php echo number_format($detail->Pemasukan, 4, ',', '.'); ?>" onkeyup="getSaldoAkhir(this)"></center></td>
      <td><center><input class="form-control txtPengeluaran" id="txtPengeluaran" size="15" style="text-align: center;" value="<?php echo number_format($detail->Pengeluaran, 4, ',', '.'); ?>" onkeyup="getSaldoAkhir(this)"></center></td>
      <td><center><input class="form-control txtStokOpname" size="20" id="txtStokOpname" style="text-align: center;" placeholder="Stok Opname" value="<?php echo number_format($detail->SaldoAkhir, 4, ',', '.'); ?>"></center></td>
      <td><center><input class="form-control txtPenyesuaian" size="3" id="txtPenyesuaian" style="text-align: center;" placeholder="Penyesuaian" value="0"></center></td>
      <td><center><input type="text" class="form-control txtSaldoAkhir" size="20" id="txtSaldoAkhir" style="text-align: center;" placeholder="Saldo Akhir" value="<?php echo number_format($detail->SaldoAkhir, 4, ',', '.'); ?>" disabled></center></td>
      <td><center><input class="form-control txtSelisih" size="3" id="txtSelisih" style="text-align: center;" placeholder="Selisih" value="0"></center></td>
      <td><center><input class="form-control" type="text" id="txtKeterangan" style="text-align: center;" placeholder="Keterangan" value=""></center></td>
      <td><center><input type="checkbox"></center></td>
    </tr>
<?php endforeach ?>
</tbody>

<script>
  $('.txtSaldoAwal').number(true, 4,',', '.');
  $('.txtPemasukan').number(true, 4,',', '.');
  $('.txtPengeluaran').number(true, 4,',', '.');  
  $('.txtPenyesuaian').number(true, 4,',', '.');
  $('.txtSelisih').number(true, 4,',', '.');
  $('.txtStokOpname').number(true, 4,',', '.');
  $('.txtSaldoAkhir').number(true, 4,',', '.');
</script>
