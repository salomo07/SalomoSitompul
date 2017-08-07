<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog" style="width: auto;left: 0.0%;">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Add Mutasi Barang</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Tanggal Mutasi :</label>
              <div class="radio" id="rgSwitchTanggalMutasi" onchange="rgSwitchTanggalMutasiChange()">
                <form>
                  <label>
                    <input type="radio" name="rgSwitchTanggalMutasi" id="optionradioOff" value="disabled" checked>
                    Tanggal Hari Ini
                  </label>
                  <label> </label>
                  <label>
                    <input type="radio" name="rgSwitchTanggalMutasi" id="optionradioOn">
                    Pilih Tanggal
                  </label>
                  <label></label>
                </form>
              </div>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" id="txtTanggalMutasi" onchange="getTransaksiAll()" class="form-control datepicker pull-right" disabled="" value="<?php echo date('d-m-Y');?>">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <div class="radio" id="rgSwitchSourceItem" onchange="rgSwitchMasterChange()">
                <form>
                  <label>
                    <input type="radio" name="rgSwitchSourceItem" id="optionradioOff" value="Product" checked>
                    Master Product
                  </label>
                  <label> </label>
                  <label>
                    <input type="radio" name="rgSwitchSourceItem" id="optionradioOn" value="Item">
                    Master Item
                  </label>
                  <label></label>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <center><label id="lblNotifikasi"></label></center>
          </div>
          <div class="col-md-12" style="overflow: auto; max-height: 300px; height: 200px">
            <table id="tblAddMutasi" class="table table-bordered table-hover dataTable" role="grid" width="100%">
              <thead>
                <tr>
                  <th><center>Kode Barang</center></th>
                  <th><center>Nama Barang</center></th>
                  <th><center>Satuan</center></th>
                  <th><center>Saldo Awal</center></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td width="5%">
                    <input id="txtKodeBarang" size="10" name="txtKodeBarang"><input id="txtJenisMutasiModal" type="hidden" size="10" value="<?php echo $jenis ?>">
                  </td>
                  <td><input id="txtDescBarang" type="text" size="90" style="text-align: center;" disabled></td>
                  <td><input id="txtSatuan" type="text" size="5" style="text-align: center;" disabled></td>
                  <td><input id="txtSaldoAwal" style="text-align: center;" value="0" disabled></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button id="btnAddMutasi" onclick="addRow()" type="button" class="btn" ><i class="fa fa-plus-square"></i>  Add Row</button>
        <button id="btnSaveMutasi" onclick="saveMutasi()" type="button" class="btn" style="background-color: #00ff80">Save Mutasi Barang</button>
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
#txtTanggalMutasi{z-index:1151 !important;}
</style>
<script>
getTransaksiAll();
getMaster();
var sumber='Product';
$('.datepicker').datepicker(
  {
    autoclose: true,dateFormat: 'dd-mm-yy'
  });
function saveMutasi()
{
  $('#txtSaldoAkhir').number(false, 4,',', '.');
  $('#txtStokOpname').number(false, 4,',', '.');
  var arrayOfObject=[];var kosong=false;
  $('#tblAddMutasi tbody tr').each(function() {
    $(this).find('input:checkbox:checked').each(function() {
      if($(this).closest('tr').find('#txtKodeBarang').val()==''|| $(this).closest('tr').find('#txtDescBarang').val()==''){alert('Silahkan pilih Item/Product');}
      else
      {
        var JenisMutasi='<?php echo $jenis; ?>';
        var KodeBarang=$(this).closest('tr').find('#txtKodeBarang').val();
        var NamaBarang=$(this).closest('tr').find('#txtDescBarang').val();
        var Sat=$(this).closest('tr').find('#txtSatuan').val();
        var SaldoAwal=$(this).closest('tr').find('#txtSaldoAwal').val();
        var Pemasukan=$(this).closest('tr').find('#txtPemasukan').val();
        var Pengeluaran=$(this).closest('tr').find('#txtPengeluaran').val();
        var Penyesuaian=$(this).closest('tr').find('#txtPengyesuaian').val();
        var StokOpname=$(this).closest('tr').find('#txtStokOpname').val();
        var Penyesuaian=$(this).closest('tr').find('#txtPenyesuaian').val();
        var Selisih=$(this).closest('tr').find('#txtSelisih').val();
        var SaldoAkhir=$(this).closest('tr').find('#txtSaldoAkhir').val();        
        var Keterangan=$(this).closest('tr').find('#txtKeterangan').val();
        if(NamaBarang==''||SaldoAwal==''){kosong=true;}
        var objDetailMutasi={'JenisMutasi':JenisMutasi,'KodeBarang':KodeBarang,'NamaBarang':NamaBarang,'Sat':Sat,'SaldoAwal':SaldoAwal,'Pemasukan':Pemasukan,'Pengeluaran':Pengeluaran,'StokOpname':StokOpname,'Penyesuaian':Penyesuaian,'Selisih':Selisih,'Keterangan':Keterangan,'TanggalMutasi':$('#txtTanggalMutasi').val(),'SaldoAkhir':SaldoAkhir}
        arrayOfObject.push(objDetailMutasi);
      } 
    });      
  });
  if(kosong==true){alert('Nama barang / Stok Awal tidak boleh kosong.');}
  else
  {
      if(arrayOfObject.length>0)
      {
        var xxx=JSON.stringify(arrayOfObject);
        $.ajax({
            url: "<?php echo base_url();?>Mutasi/saveMutasi",
            method:"POST",
            dataType:"json",
            data : {'arrayOfObject':xxx},
            success: function (response) 
            {//console.log(response);
              if(response.length>0)
              {
                for (var i = 0; i < response.length; i++) 
                {
                  alert('Input mutasi dengan Kode Barang : '+response[i].KodeBarang+' tidak berhasil karena barang ini telah tersimpan sebelumnya dihari yang sama.');
                } 
              }
              $('#myModal').modal('hide');
              getDataMutasi();
            }
        });
      }
      else
      {alert('Silahkan pilih data mutasi');}
    }    
}
function removeRow(element)
{
  $(element).closest('tr').remove();
}
function rgSwitchTanggalMutasiChange()
{
  if($("#txtTanggalMutasi").is(':disabled')==false)
  {
    var d = '<?php echo date('d-m-Y');?>';
    $("#txtTanggalMutasi").val(d);
    $('#txtTanggalMutasi').prop('disabled', true);getTransaksiAll();
  }
  else
  {
    $('#txtTanggalMutasi').prop('disabled', false);getTransaksiAll();
  }
}
function rgSwitchMasterChange()
{
  getMaster();
}
function getMaster()
{
  $('#lblNotifikasi').text('Memuat Master Produk / Master Item...');
  $.ajax({
      url: "<?php echo base_url();?>Mutasi/getMasterItem",
      method:"POST",
      dataType:"JSON",
      data : {'sumber':$("input[name='rgSwitchSourceItem']:checked").val()},
      success: function (response) 
      {
        $('#lblNotifikasi').text('');
        setArrayMaster(response);
      }
  });
}

function checkIdBarangSama(idterpilih)
{
  var sama=0;
  $('#tblAddMutasi tbody tr').each(function() {
    if($(this).find('#txtKodeBarang').val()!='')
    {
      if(idterpilih==$(this).find('#txtKodeBarang').val())
      {
        sama++;
      }
    }
  });
  return sama;
}
function getTransaksiAll()
{
  $('#lblNotifikasi').text('Menghitung Stok...');
  $.ajax({
        url: "<?php echo base_url();?>Mutasi/getTransaksiAll",
        method:"POST",
        dataType:"text",
        data : {'tgl':$('#txtTanggalMutasi').val(),'jenis':'<?php echo $jenis; ?>'},
        success: function (response) 
        { console.log(response);
          $('#lblNotifikasi').text('');
          var table=$('#tblAddMutasi').DataTable();table.destroy();
          $('#tblAddMutasi').html(response);
          $('#tblAddMutasi').DataTable( {
            "paging":   false,
            "ordering": false,
            "searching": false,
            "info":     false
          } );
        }
    });
}
</script>