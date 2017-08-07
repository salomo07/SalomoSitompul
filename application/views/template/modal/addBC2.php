<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="assets/plugins/jQueryUI/jquery-ui.css">
<div class="modal-dialog " style="width: auto;left: 0.0%;">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Add BC</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <label>Dokumen Pabean</label><br>
            <div class="col-md-6">
              <input id="txtNoPabean" type="text" class="form-control" placeholder="No Pabean">
            </div>
            <div class="col-md-6">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" id="txtTglPabean" class="form-control datepicker" placeholder="Tanggal Pabean" value="<?php echo $tglhariini;?>">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <label>BL</label><br>
            <div class="col-md-6">
              <input id="txtNoBL" type="text" class="form-control" placeholder="No BL">
            </div>
            <div class="col-md-6">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" id="txtTglBL" class="form-control datepicker" placeholder="Tanggal BL" value="<?php echo $tglhariini;?>">
              </div>
            </div>
          </div><br>
          <div class="col-md-6"> <br>
            <label>Kategori Barang :</label>
            <div class="radio" id="rgSwitchMasterItem">
              <form>
                <label>
                  <input type="radio" name="rgSwitchMasterItem" id="optionradioOff" checked="">
                  Master Item
                </label>
                <label> </label>
                <label>
                  <input type="radio" name="rgSwitchMasterItem" id="optionradioOn">
                  Master Product
                </label>
                <label></label>
              </form>
            </div>
          </div>
          <div class="col-md-12">
            <div class="col-md-12" style="max-height: 300px">
              <table id="tblAddBC" class="table table-bordered table-hover dataTable"  width="100%">
                <thead style="">
                  <tr>
                    <th><center>Nota</center></th>
                    <th><center>Tgl. Nota</center></th>
                    <th><center>Invoice</center></th>                                           
                    <th><center>Tgl. Invoice</center></th>
                    <th><center>Pemasok/Marketing</center></th>
                    <th><center>Kode Barang</center></th>
                    <th><center>Nama Barang</center></th>
                    <th><center>Satuan</center></th>
                    <th><center>Valas</center></th>
                    <th><center>Kode HS</center></th>                    
                    <th><center>Tarif</center></th>  
                    <th><center>Jumlah</center></th>                                          
                    <th><center>CIF</center></th>                      
                    <th><center>Nilai Barang</center></th>
                    <th><center>PDRI Bayar</center></th>
                    <th><center>PDRI Bebas</center></th>
                    <th><center>Keterangan</center></th>
                    <th><center></center></th>
                  </tr>
                </thead>
                <tbody style="font-size:12px">
                  <tr>
                    <td><center><input type="text" id="txtNoNota" class="form-control" placeholder="Nomor Nota"><input class="form-control" type="hidden" id="txtJenisBC" value="<?php echo $jenis; ?>"></center></td>
                    <td><center><input type="text" id="txtTglNota" class="form-control datepicker" placeholder="Tanggal Nota" value="<?php echo $tglhariini;?>"></td>
                    <td><center><input type="text" id="txtNoInvoice" placeholder="No Invoice" value="" class="form-control"></center></td> 
                    <td><center><input type="text" id="txtTglInvoice" class="form-control datepicker" placeholder="Tanggal Invoice" value="<?php echo $tglhariini;?>"></center></td>
                    <td><center><input type="text" id="txtPemasok" placeholder="Pemasok" onkeyup="autoCompletePemasok(this)" class="form-control"></center></td>
                    <td><center><input type="text" id="txtKodeBarang" placeholder="Kode Barang" class="form-control" onkeyup="autoCompleteKodeBarang(this)"></center></center></td>
                    <td><center><input type="text" id="txtNamaBarang" placeholder="Nama Barang" class="form-control"></center></td>
                    <td><center><input id="txtSat" type="text" onkeyup="autoCompleteSatuan(this)" placeholder="Satuan" class="form-control" style="width: 80px" ></center></td>
                    <td><center><input type="text" id="txtValas" placeholder="Valas" class="form-control" onkeyup="autoCompleteValas(this)"></center></td>
                    <td><center><input id="txtKodeHS" type="text" class="form-control" placeholder="Kode HS" style="width: 110px"></center></td>
                    <td><center><input id="txttarifBarang" class="form-control" onchange="warning(this)" type="text" placeholder="Tarif" style="width: 80px" ></center></td>
                    <td><center><input id="txtjumlahBarang" class="form-control" onchange="warning(this)" type="number" value="" placeholder="Qty" style="width: 90px"></center></td>                                        
                    <td><center><input id="txtCIF" class="form-control" type="text" placeholder="CIF (Harga Satuan)" style="width: 130px"></center></td>
                    <td><center><input id="txtTotal" class="form-control" type="number" placeholder="Total Nilai Barang"></center></td>
                    <td><center><input id="PDRIBayar" class="form-control" type="number" placeholder="PDRI Bayar"></center></td>
                    <td><center><input id="PDRIBebas" class="form-control" type="number" placeholder="PDRI Bebas"></center></td>
                    <td><center><input id="txtKet" type="text" class="form-control" placeholder="Keterangan" style="width: 150px"></center></td>
                    <td><input class="form-control" class="form-control" type="hidden" id="txtJenisBC" value="<?php echo $jenis; ?>"><button onclick="addRow(this)" type="button" style="color:#72afd2"><i class="fa fa-plus-square"></i></button><span>        </span><button onclick="removeRow(this)" type="button" style="color:#72afd2"><i class="fa fa-trash"></i></button>
                  </tr>
                </tbody>              
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button id="btnAddRow" onclick="addRow()" type="button" class="btn" ><i class="fa fa-plus-square"></i>  Add Row</button>
        <button id="btnAddBC" onclick="addBC(this)" type="button" class="btn btn-primary">Add BC</button>
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
  $(".datepicker").datepicker({dateFormat: "dd-mm-yy"});  
  function warning(element) 
  {
    if($('#txtjumlahBarang').val()==''&& Number($('#txtjumlahBarang').val())<1)
    {alert('Inputan jumlah barang tidak boleh kosong atau lebih kecil dari 1.'); $(element).closest('tr').find('#txtTotal').text('');$(element).closest('tr').find('td').eq(10).find('#txtBM').text('');}
  }
  function addBC(element) 
  {
    var arrayOfObject=[]; 
    if($('#txtNoPabean').val()==''){alert('Silahkan masukkan No Pabean.');}
    else
    {
      var lengkap=0;var NoPabean='';
      $('#tblAddBC tbody tr').each(function() {
        // $(this).find('input:checkbox:checked').each(function() {
          NoPabean=$('#txtNoPabean').val();          
          var NoBL=$('#txtNoBL').val();
          var JenisBC=$(this).find('#txtJenisBC').val();
          var NoNota=$(this).find('#txtNoNota').val();
          var NoVoy='';
          var TglPabean=$('#txtTglPabean').val();
          var TglNota=$(this).find('#txtTglNota').val();
          var NoInvoice=$(this).find('#txtNoInvoice').val();
          var TglInvoice=$(this).find('#txtTglInvoice').val();
          var TglBL=$('#txtTglBL').val();          
          
          var KodeBarang=$(this).find('#txtKodeBarang').val();
          var NamaBarang=$(this).find('#txtNamaBarang').val();
          var Pemasok=$(this).find('#txtPemasok').val();
          var Satuan=$(this).find('#txtSat').val();
          var Valas=$(this).find('#txtValas').val();
          var KodeHS=$(this).find('#txtKodeHS').val();
          var Keterangan=$(this).find('#txtKet').val();          
          var Tarif=$(this).find('#txttarifBarang').val();
          var Jumlah=$(this).find('#txtjumlahBarang').val();
          var CIF=$(this).find('#txtCIF').val();          
          var Total=$(this).find('#txtTotal').val();
          var PDRIBayar=$(this).find('#PDRIBayar').val();
          var PDRIBebas=$(this).find('#PDRIBebas').val();
          if(Jumlah==''){alert('Silahkan masukkan jumlah barang.');lengkap=0;}
          else if(Total==''&&lengkap==0){alert('Silahkan masukkan Nilai Pabean.');lengkap=0;}
          else{lengkap=1;}
          var objDetailBC={"JenisBC":JenisBC,'NoVoy':NoVoy,"NoPabean":NoPabean,"NoInvoice":NoInvoice,"NoBL":NoBL,"NoNota":NoNota,"TglPabean":TglPabean,"TglInvoice":TglInvoice,"TglBL":TglBL,"TglNota":TglNota,"KodeBarang":KodeBarang,'NamaBarang':NamaBarang,'Pemasok':Pemasok,'Satuan':Satuan,'Valas':Valas,'Jumlah':Jumlah,'Tarif':Tarif,'KodeHS':KodeHS,'CIF':CIF,'Keterangan':Keterangan,'Total':Total,'PDRIBayar':PDRIBayar,"PDRIBebas":PDRIBebas};
          arrayOfObject.push(objDetailBC);
          //console.log(objDetailBC);
        // });
      });
      if(arrayOfObject.length==0)
      {
        alert('Silahkan pilih data BC yang akan disimpan.');
      }
      else if(lengkap==1)
      { 
        simpanBC(arrayOfObject);
      }
    }    
  }  
  function simpanBC(arrayOfObject)
  {
    var json=JSON.stringify(arrayOfObject);
    $.ajax({
        url: "<?php echo base_url();?>BC/insertBC",
        method:"POST",
        data : { 'json': json},
        success: function (response) 
        {//console.log(response);
          $('#myModal').modal('hide');
          var table=$('#tblBC').DataTable();table.destroy();
          var table=$('#tblBCApproved').DataTable();table.destroy();
          getBC('<?php echo $jenis;?>');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
    });
  }  
  $('#tblAddBC').DataTable( {
    "paging":   false,
    "ordering": false,
    "info":     false,
    "searching": false
  } );

  $('#tblAddBC').css('z-index',1151);
  function addRow(element)
  {
    $('#tblAddBC tbody tr:last').after('<tr>'+ $(element).closest('tr').html() +'</tr>');
  }
  function removeRow(element)
  {
    $(element).closest('tr').remove();
  }
  function autoCompletePemasok(elementTxt)
  {
    $.ajax({
        url: "<?php echo base_url();?>BC/getSupplierAll",
        method:"POST",
        data : { 'supplier': elementTxt.value},
        dataType:'json',
        success: function (response) 
        {          
          var daftarPemasok=[];
          for (var i = 0; i < response.length; i++) 
          {            
            daftarPemasok.push(response[i].Pemasok);
          }
          
          $(elementTxt).closest('tr').find("#txtPemasok").autocomplete({
            source: daftarPemasok,
            select: function (a, b) {
              $(this).val(b.item.value);
            }
          }); 
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
    });
  }
  function autoCompleteKodeBarang(element)
  {
    var namaFungsi='';
    if($(element).val().length>=1)
    {      
      if($('#optionradioOff').is(':checked'))
      {namaFungsi='getKodeItem';}
      else if($('#optionradioOn').is(':checked'))
      {namaFungsi='getKodeProduct';}
    }
    else if($(element).val().length==0)
    {
      $(element).closest('tr').find('#txtNamaBarang').val('');
    }
    $.ajax({
        url: "<?php echo base_url();?>BC/"+namaFungsi,
        method:"POST",
        dataType:"JSON",
        data : {'val':$(element).val()},
        success: function (response) 
        {
          hasilKodeBarang=response;
          var kodebarang=[];
          for (var i = 0; i < response.length; i++) 
          {
            kodebarang.push(response[i].OldItemID);
          }
          $(element).closest('tr').find("#txtKodeBarang").autocomplete({
            source: kodebarang,
            select: function (a, b) {
              getDescription(element,hasilKodeBarang,b.item.value);
              $(this).val(b.item.value);
            }
          }); 
        }
  });
  }
  function getDescription(elementTxt,hasilKodeBarang,kodebarang)
  {
    for (var i = 0; i < hasilKodeBarang.length; i++) 
    {
      if(kodebarang==hasilKodeBarang[i].OldItemID)
      {
        $(elementTxt).closest('tr').find('#txtNamaBarang').val(hasilKodeBarang[i].ItemName);
        $(elementTxt).closest('tr').find('#txtSat').val(hasilKodeBarang[i].Satuan);
        break;
      }
    }
  }
  function autoCompleteSatuan(element)
  {
    $.ajax({
        url: "<?php echo base_url();?>BC/getSatuanAll",
        method:"POST",
        data : { 'satuan': element.value},
        dataType:'json',
        success: function (response) 
        {          
          var daftarPemasok=[];
          for (var i = 0; i < response.length; i++) 
          {            
            daftarPemasok.push(response[i].Satuan);
          }          
          $(element).closest('tr').find("#txtSat").autocomplete({
            source: daftarPemasok,
            select: function (a, b) {
              $(this).val(b.item.value);
            }
          }); 
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
    });
  }
  function autoCompleteValas(element)
  {
    $.ajax({
        url: "<?php echo base_url();?>BC/getValasAll",
        method:"POST",
        data : { 'valas': element.value},
        dataType:'json',
        success: function (response) 
        {          
          var daftarPemasok=[];
          for (var i = 0; i < response.length; i++) 
          {            
            daftarPemasok.push(response[i].Valas);
          }          
          $(element).closest('tr').find("#txtValas").autocomplete({
            source: daftarPemasok,
            select: function (a, b) {
              $(this).val(b.item.value);
            }
          }); 
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
    });
  }
 </script>

