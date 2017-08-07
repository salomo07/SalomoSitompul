<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<thead style="font-size:12px">
  <tr>
    <th><center>Nota / DO / BPB /BTB</center></th>   <!-- 1 -->
    <th><center>Tgl. Nota</center></th>     <!-- 2 -->
    <th><center>Invoice</center></th>       <!-- 3 -->
    <th><center>Tgl. Invoice</center></th>  <!-- 4 -->
    <th><center>Kode Barang</center></th>   <!-- 5 -->
    <th><center>Nama Barang</center></th>   <!-- 6 -->
    <th><center>Satuan</center></th>        <!-- 7 -->
    <th><center>Valas</center></th>         <!-- 8 -->
    <th><center>Kode HS</center></th>       <!-- 9 -->
    <th><center>Keterangan</center></th>    <!-- 10 -->
    <th><center>Tarif</center></th>         <!-- 11 -->  
    <th><center>Jumlah</center></th>        <!-- 12 -->                                          
    <th><center>CIF</center></th>           <!-- 13 -->               
    <th><center>Nilai Barang</center></th>  <!-- 14 -->
    <th><center>PDRI Bayar</center></th>    <!-- 15 -->
    <th><center>PDRI Bebas</center></th>    <!-- 16 -->
    <th><center>No SKEP</center></th>       <!-- 17 -->
    <th><center>Tgl. SKEP</center></th>     <!-- 18 -->
    <th><center>Pemasok/Buyer (Optional)</center></th> 
    <th><center>Pilih</center></th>         <!-- 19 -->
  </tr>
</thead>
<tbody style="font-size:12px;">
  <?php foreach ($dataTransaksi as $key => $value): ?>
  <tr>
    <td><center><input id="txtNoNota" class="form-control" type="text" placeholder="No Nota" value="<?php if(isset($value->NoNota)){echo $value->NoNota; }?>" ><input type="hidden" id="txtNoVoy" value="<?php echo isset($value->Voy); ?>"><input type="hidden" id="txtJenisBC" value="<?php echo $jenis; ?>"></center></td>
    <td><center><input type="text" id="txtTglNota" class="form-control datepicker" placeholder="Tanggal Nota" value="<?php echo $tglhariini;?>"></td>
    <td><center><input type="text" id="txtNoInvoice" class="form-control" value="<?php if(isset($value->NoInvoice)){echo $value->NoInvoice;} ?>"></center></td>    
    <td><center><input type="text" id="txtTglInvoice" class="form-control datepicker" placeholder="Tanggal Invoice" value="<?php echo $tglhariini;?>"></center></td>
    <td><center><input type="text" id="txtKodeBarang" class="form-control" placeholder="Kode Barang" value="<?php echo $value->KodeBarang;?>"></center></td>
    <td><center style="width: 300px"><input type="text" id="txtNamaBarang" class="form-control" placeholder="Nama Barang" size="40" value="<?php echo $value->NamaBarang;?>"></center></td>
    <td><center><input id="txtSat" type="text" class="form-control" placeholder="Satuan" style="width: 80px" value="<?php echo $value->Satuan;?>"></center></td>
    <td><center><input id="txtValas" type="text" class="form-control" placeholder="Valas" style="width: 80px" value="<?php echo $value->Valas;?>"></center></td>
    <td><center><input id="txtKodeHS" type="text" class="form-control" placeholder="Kode HS" style="width: 110px"></center></td>
    <td><center><input id="txtKet" type="text" class="form-control" placeholder="Keterangan" style="width: 150px" value=""></center></td>
    <td><center><input id="txttarifBarang" class="form-control" type="text" placeholder="Tarif" style="width: 80px" ></center></td>
    <td><center><input id="txtjumlahBarang" class="form-control txtjumlahBarang" onchange="warning(this)" type="text" value="<?php echo number_format($value->Jumlah, 4, ',', '.');?>" placeholder="Qty" style="width: 90px"></center></td>                                        
    <td><center><input id="txtCIF" type="text" class="form-control txtCIF" placeholder="CIF (Harga Satuan)" style="width: 120px" value="<?php if(isset($value->HargaSatuan)){echo number_format($value->HargaSatuan*$value->Jumlah, 2, ',', '.');} ?>"></center></td>
    <td><center><input id="txtTotal" class="form-control txtTotal" type="text" placeholder="Total Nilai Barang" value=""></center></td>
    <td><center><input id="PDRIBayar" class="form-control PDRIBayar" type="text" placeholder="PDRI Bayar"></center></td>
    <td><center><input id="PDRIBebas" class="form-control PDRIBebas" type="text" placeholder="PDRI Bebas"></center></td>
    <td><center><input id="NoSkep" class="form-control" type="text" placeholder="No SKEP"></center></td>
    <td><center><input id="TglSkep" class="form-control" type="text" placeholder="Tanggal SKEP" value=""></center></td>  
    <td><center><input id="txtBuyer" class="form-control" type="text" placeholder="Buyer (Optional)"></center></td>  
    <td><center><input type="checkbox"></center></td>
  </tr><?php endforeach ?>  
</tbody>

<!--<script src="<?php echo base_url();?>assets/plugins/maskMoney/jquery.number.min.js"></script>-->
<script>
    $('.txtjumlahBarang').number(true, 4,',', '.');
    $('.txtCIF').number(true, 2,',', '.');
    $('.txtTotal').number(true, 2,',', '.');
    $('.PDRIBayar').number(true, 2,',', '.');
    $('.PDRIBebas').number(true, 2,',', '.');
  </script>