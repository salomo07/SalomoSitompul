<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="assets/plugins/jQueryUI/jquery-ui.css">
<div class="modal-dialog" style="width: auto;left: 0.0%;">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Edit Mutasi Barang</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="col-md-2">
            <div class="radio">
            <label>
              <input onclick="onCheckedChange()" type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
              Master Item
            </label>
          </div>
          </div>
          <div class="col-md-2">
            <div class="radio">
            <label>
              <input onclick="onCheckedChange()" type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
              Master Product
            </label>
            </div>
          </div>          
        </div>
        <div class="col-md-12" style="overflow: auto;">
          <table id="tblAddMutasi" class="table table-bordered table-hover dataTable" role="grid" width="100%">
            <thead>
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
              </tr>
            </thead>
            <tbody>
              <tr>
                <td width="5%">
                  <input id="txtKodeBarang" size="10" onkeyup="searchKodeBarang(this.value)" value="<?php echo $kodebarang; ?>"><input id="txtIdMutasiModal" type="hidden" value="<?php echo $id ?>">
                </td>
                <td><input id="txtDescBarang" type="text" size="90" style="text-align: center;" disabled value="<?php echo $namabarang; ?>"></td>
                <td><input id="txtSatuan" type="text" size="5" style="text-align: center;" value="<?php echo $satuan; ?>"></td>
                <td><input id="txtSaldoAwal" type="number" style="text-align: center;" value="<?php echo $saldoawal; ?>"></td>
                <td><input id="txtPemasukan" type="number" style="text-align: center;" value="<?php echo $pemasukan ?>"></td>
                <td><input id="txtPengeluaran" type="number" style="text-align: center;" value="<?php echo $pengeluaran; ?>"></td>
                <td><input id="txtPengyesuaian" type="number" style="text-align: center;" value="<?php echo $penyesuaian; ?>"></td>
                <td><input id="txtSaldoAkhir" type="number" style="text-align: center;" value="<?php echo $saldoakhir; ?>"></td>
                <td><input id="txtStokOpname" type="number" style="text-align: center;" value="<?php echo $stokopname; ?>"></td>
                <td><input id="txtSelisih" type="number" style="text-align: center;" value="<?php echo $selisih; ?>"></td>
                <td><input id="txtKeterangan" type="text" style="text-align: center;" value="<?php echo $keterangan; ?>"></td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
      <div class="modal-footer">
      <br>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button id="btnSaveRole" onclick="editMutasi()" type="button" class="btn" style="background-color: #00ff80">Edit Mutasi Barang</button>
      </div>
  </div>
</div>
<style type="text/css">
.ui-autocomplete {
    max-height: 200px;
    overflow-y: auto;
    overflow-x: hidden;
    z-index: 5000;
  }
</style>
<script src="<?php echo base_url();?>assets/plugins/jQueryUI/jquery-ui.min.js"></script>
<script>
var hasilKodeBarang=[];
function searchKodeBarang(val)
{
  if(val.length>2)
  {
    var namaFungsi='';
    if($('#optionsRadios1').is(':checked'))
    {namaFungsi='getKodeItem';getKodeBarang(val,namaFungsi);}
    else if($('#optionsRadios2').is(':checked'))
    {namaFungsi='getKodeProduct';getKodeBarang(val,namaFungsi);}
  }
}
function getKodeBarang(val,namaFungsi)
{
  $.ajax({
        url: "<?php echo base_url();?>Mutasi/"+namaFungsi,
        method:"POST",
        dataType:"JSON",
        data : {'val':val},
        success: function (response) 
        {
          hasilKodeBarang=response;
          var kodebarang=[];
          for (var i = 0; i < response.length; i++) 
          {
            kodebarang.push(response[i].OldItemID);
          }
          $("#txtKodeBarang").autocomplete({
            source: kodebarang,
            select: function (a, b) {
              getDescription(hasilKodeBarang,b.item.value);
            }
          }); 
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
    });
}
function getDescription(hasilKodeBarang,kodebarang)
{//console.log(hasilKodeBarang[i].ItemName);
  for (var i = 0; i < hasilKodeBarang.length; i++) 
  {
    if(kodebarang==hasilKodeBarang[i].OldItemID)
    {
      $('#txtDescBarang').val(hasilKodeBarang[i].ItemName);break;
    }
  }
}
function onCheckedChange()
{
  $('#txtKodeBarang').val('');$('#txtDescBarang').val('');$('#txtSatuan').val('');$('#txtSaldoAwal').val(0);$('#txtPemasukan').val(0);$('#txtPengeluaran').val(0);$('#txtPengyesuaian').val(0);$('#txtSaldoAkhir').val(0);$('#txtStokOpname').val(0);$('#txtSelisih').val(0);$('#txtKeterangan').val('');
}
function editMutasi()
{
  if($('#txtKodeBarang').val()==''){alert('Silahkan isi kode barang.');}
  else 
  {
    var objDetailMutasi={'KodeBarang':$('#txtKodeBarang').val(),'NamaBarang':$('#txtDescBarang').val(),'Sat':$('#txtSatuan').val(),'SaldoAwal':$('#txtSaldoAwal').val(),'Pemasukan':$('#txtPemasukan').val(),'Pengeluaran':$('#txtPengeluaran').val(),'Penyesuaian':$('#txtPengyesuaian').val(),'SaldoAkhir':$('#txtSaldoAkhir').val(),'StokOpname':$('#txtStokOpname').val(),'Selisih':$('#txtSelisih').val(),'Keterangan':$('#txtKeterangan').val()}
    var xxx=JSON.stringify(objDetailMutasi);
    $.ajax({
        url: "<?php echo base_url();?>Mutasi/editMutasi",
        method:"POST",
        data : {id:$('#txtIdMutasiModal').val(),objDetailMutasi:xxx},
        success: function (response) 
        {
          $('#myModal').modal('hide');operation='';
          getDataMutasi();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
    });
  }
}
</script>