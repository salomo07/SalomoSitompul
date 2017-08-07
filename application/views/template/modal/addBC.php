<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
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
          </div>
          <div class="col-md-6"><br>
            <label><?php echo $titlelabel; ?></label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" id="txtTglData" class="form-control datepicker" placeholder="Tanggal Penerimaan Barang" value="<?php echo $tglhariini;?>">
            </div>
          </div>            
          <div class="col-md-6"><br>
            <label>Pemasok/Buyer</label>
            <select class="form-control select2" id="selectPemasok" onchange="getDataResourceByTanggal($('#txtTglData').val(),$('#selectPemasok').val())">        
            </select>
          </div>
          <div class="col-md-6" style="<?php if(!isset($isShow)){echo "display: none";} else{echo "";} ?>">
            <br>
            <label>Kategori Barang :</label>
            <div class="radio" id="rgSwitchMasterItem" onchange="rgMasterItemChange()">
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
          <div class="col-md-12"><br> 
            <div class="col-md-12" style="max-height: 300px"><br><center ><i class="fa fa-spin tes-spin"></i></center>
              <table id="tblAddBC" class="table table-bordered table-hover dataTable" cellspacing="0">
                <thead style="font-size:12px">
                  <tr>
                      <th><center>Nota</center></th>
                      <th><center>Tgl. Nota</center></th>
                      <th><center>Invoice</center></th>                      
                      <th><center>Tgl. Invoice</center></th>
                      <th><center>Kode Barang</center></th>
                      <th><center>Nama Barang</center></th>
                      <th><center>Satuan</center></th>
                      <th><center>Valas</center></th>
                      <th><center>Kode HS</center></th>
                      <th><center>Keterangan</center></th>
                      <th><center>Tarif</center></th>
                      <th><center>Qty</center></th>
                      <th><center>CIF</center></th>
                      <th><center>Nilai Barang</center></th>
                      <th><center>PDRI Bayar</center></th>
                      <th><center>PDRI Bebas</center></th>
                      <th><center>No SKEP</center></th>
                      <th><center>Tanggal SKEP</center></th>
                      <th><center>Buyer</center></th>
                      <th><center>Pilih</center></th>                      
                  </tr>
                </thead>
                <tbody style="font-size:12px">
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
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
        <button id="btnAddBC" onclick="addBC(this)" type="button" class="btn" style="background-color: #80ffff">Add BC</button>
      </div>
  </div>
</div>
<script>
  getPemasokbyTanggal();
  if($('#selectPemasok').val()!=''){getDataResourceByTanggal('<?php echo $tglhariini; ?>',$('#selectPemasok').val());}  
  $(".datepicker").datepicker({ autoclose: true,format: 'dd-mm-yyyy'});
  $('#txtTglPabean').datepicker()
    .on('changeDate', function(e) 
    {
      $('#txtTglInvoice').datepicker('setDate', $('#txtTglPabean').val());
      $('#txtTglBL').datepicker('setDate', $('#txtTglPabean').val());
      $('#txtTglData').datepicker('setDate', $('#txtTglPabean').val());
    });
  
  function addBC(element) 
  {
    var arrayOfObject=[];
    if($('#txtNoPabean').val()==''){alert('Silahkan masukkan No Pabean.');}
    else
    {
      var lengkap=0;var NoPabean='';
      $('#tblAddBC tbody tr').each(function() {
        $(this).find('input:checkbox:checked').each(function() {
          NoPabean=$('#txtNoPabean').val();          
          var NoBL=$('#txtNoBL').val();
          var JenisBC=$(this).closest('tr').find('#txtJenisBC').val();
          var NoNota=$(this).closest('tr').find('#txtNoNota').val();
          var NoVoy=$(this).closest('tr').find('#txtNoVoy').val();
          var TglPabean=$('#txtTglPabean').val();
          var TglNota=$(this).closest('tr').find('#txtTglNota').val();
          var NoInvoice=$(this).closest('tr').find('#txtNoInvoice').val();
          var TglInvoice=$(this).closest('tr').find('#txtTglInvoice').val();
          var TglBL=$('#txtTglBL').val();

          var KodeBarang=$(this).closest('tr').find('#txtKodeBarang').val();
          var NamaBarang=$(this).closest('tr').find('#txtNamaBarang').val();
          var Pemasok=$('#selectPemasok option:selected').text();
          var Satuan=$(this).closest('tr').find('#txtSat').val();
          var Valas=$(this).closest('tr').find('#txtValas').val();
          var KodeHS=$(this).closest('tr').find('#txtKodeHS').val();                    
          var Tarif=$(this).closest('tr').find('#txttarifBarang').val();
          var Jumlah=$(this).closest('tr').find('#txtjumlahBarang').val();
          var CIF=$(this).closest('tr').find('#txtCIF').val();          
          var Total=$(this).closest('tr').find('#txtTotal').val();
          var PDRIBayar=$(this).closest('tr').find('#PDRIBayar').val();
          var PDRIBebas=$(this).closest('tr').find('#PDRIBebas').val();
          var Keterangan=$(this).closest('tr').find('#txtKet').val();
          var Buyer=$(this).closest('tr').find('#txtBuyer').val();
          if(Jumlah==''){alert('Silahkan masukkan jumlah barang.');lengkap=0;}
          else if(Total==''&&lengkap==0){alert('Silahkan masukkan Nilai Pabean.');lengkap=0;}
          else{lengkap=1;}
          var objDetailBC={"JenisBC":JenisBC,'NoVoy':NoVoy,"NoPabean":NoPabean,"NoInvoice":NoInvoice,"NoBL":NoBL,"NoNota":NoNota,"TglPabean":TglPabean,"TglInvoice":TglInvoice,"TglBL":TglBL,"TglNota":TglNota,"KodeBarang":KodeBarang,'NamaBarang':NamaBarang,'Pemasok':Pemasok,'Satuan':Satuan,'Valas':Valas,'Jumlah':Jumlah,'Tarif':Tarif,'KodeHS':KodeHS,'CIF':CIF,'Keterangan':Keterangan,'Total':Total,'PDRIBayar':PDRIBayar,"PDRIBebas":PDRIBebas,'Buyer':Buyer};
          arrayOfObject.push(objDetailBC);
        });
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
        {         
          if(response.length>0)
          {
            alert('Data tidak tersimpan dengan benar, silahkan cek kembali inputan (format angka, tanggal, dll).');
          }
          else
          {
            $('#myModal').modal('hide');
          }
          var table=$('#tblBC').DataTable();table.destroy();
          getBC('<?php echo $jenis ?>');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
    });
  }  
  $('#txtTglData').datepicker().on('changeDate', function(e) 
  {
    getPemasokbyTanggal();getDataResourceByTanggal($('#txtTglData').val(),$('#selectPemasok').val());
  });
  function getDataResourceByTanggal(tgl,pemasok) 
  {
    if(pemasok==''||pemasok=='null'){var table=$('#tblAddBC').DataTable();table.destroy();}
    else
    {
      $.ajax({
        url: "<?php echo base_url();?>BC/getDataResourceByTanggal",
        method:"POST",
        data : {tglhariini:tgl,pemasok:pemasok,jenis:'<?php echo $jenis;?>'},
        async: true,
        beforeSend: function() {
          $('.tes-spin').addClass('fa-refresh');
        },
        success: function (response) 
        { //console.log(response)
          var table=$('#tblAddBC').DataTable();table.destroy();
          $('#tblAddBC').html(response);
          $('#tblAddBC').DataTable( {
            "scrollY":"200px",
            "scrollX": true,
            scrollCollapse: true,
            "paging":   false,
            "ordering": false,
            "searching": false, 
            "info":     false,
          } );
          $('.tes-spin').removeClass('fa-refresh');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); console.log(XMLHttpRequest.responseText);
          $('.tes-spin').removeClass('fa-refresh');
        }
      });
    }

  }
  function getPemasokbyTanggal()
  {
    $.ajax({
        url: "<?php echo base_url();?>BC/getPemasokbyTanggal",
        method:"POST",
        dataType:"json",
        async:false,
        data : { 'tanggal': $('#txtTglData').val(),'jenisSumberData':'<?php echo $jenisSumberData; ?>'},
        success: function (response) 
        {
          var html='';
          for (var i = 0; i < response.length; i++) 
          {
            html=html+'<option value="'+<?php if($jenisSumberData=='BTB'){echo 'response[i].SupplierID'; } else{echo "response[i].Pemasok";}?>+'">'+response[i].Pemasok+'</option>';
          }
          //console.log(html);
          if(response.length==0){$('#tblAddBC tbody').html('');}
          $('#selectPemasok').html(html);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
    });
  }
  
  $('.txtjumlahBarang').number(true, 4,',', '.');
  $('.txtCIF').number(true, 4,',', '.');
  $('.txtTotal').number(true, 4,',', '.');
  $('.PDRIBayar').number(true, 4,',', '.');
  $('.PDRIBebas').number(true, 4,',', '.');
  </script>

