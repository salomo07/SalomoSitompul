<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog " style="width: auto;left: 0.0%;">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><?php if($isDelete==1){echo "Delete BC";}else{echo 'Edit BC';} ?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <label>Dokumen Pabean</label><br>
            <div class="col-md-6">
              <input id="txtNoPabean" type="text" class="form-control" placeholder="No Pabean" value="<?php echo $noPabean; ?>" <?php if($isDelete==1) {echo "disabled";} ?>>
            </div>
            <div class="col-md-6">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" id="txtTglPabean" class="form-control datepicker" placeholder="Tanggal Pabean" value="<?php echo $tglPabean; ?>" disabled>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <label>BL</label><br>
            <div class="col-md-6">
              <input id="txtNoBL" type="text" class="form-control" placeholder="No BL" value="<?php echo $noBL; ?>" <?php if($isDelete==1) {echo "disabled";} ?>>
            </div>
            <div class="col-md-6">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" id="txtTglBL" class="form-control datepicker" placeholder="Tanggal BL" value="<?php echo $tanggalBL ?>" disabled>
              </div>
            </div>
          </div>
          <div class="col-md-12"><br><br>            
            <div class="col-md-6">
              <label><?php echo $titlelabel; ?></label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" id="txtTglDataRMP" class="form-control datepicker" placeholder="Tanggal Penerimaan Barang" value="<?php echo $tglnota; ?>" disabled>
              </div>
            </div>
            
            <div class="col-md-6">
              <label>Pemasok</label>
              <select class="form-control select2" id="selectPemasok" disabled>
                  <option value="<?php echo $pemasok; ?>"><?php echo $pemasok; ?></option>        
              </select>
            </div>
            <div class="col-md-12" style="overflow: auto;"><br>
              <table id="tblEditBC" class="table table-bordered table-hover dataTable" role="grid" width="100%">
                <thead style="font-size:12px">
                  <tr>
                    <th><center>Nota / DO / BPB /BTB</center></th>
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
                    <th><center>Jumlah</center></th>                                          
                    <th><center>CIF</center></th>                      
                    <th><center>Nilai Barang</center></th>
                    <th><center>PDRI Bayar</center></th>
                    <th><center>PDRI Bebas</center></th>
                    <th><center>Pemasok (Optional)</center></th>
                  </tr>
                </thead>
                <tbody style="font-size:12px">
                  <tr>
                    <td><center><input class="form-control" id="txtNota" value="<?php echo $NoNota; ?>"<?php if($isDelete==1) {echo "disabled";} ?> ></input> <input type="hidden" id="txtJenisBC" value="<?php echo $jenis; ?>"><input type="hidden" id="txtIDDetail" value="<?php echo $IDDetail; ?>"></center></td>
                    <td><center><input type="text" id="txtTglNota" class="form-control datepicker" placeholder="Tanggal Nota" value="<?php echo str_replace(' ', '',$tglnota);?>" <?php if($isDelete==1) {echo "disabled";} ?>></td>
                    <td><center><input type="text" id="txtNoInvoice" placeholder="No Invoice" value="<?php echo $noInvoice; ?>" class="form-control" <?php if($isDelete==1) {echo "disabled";} ?>></center></td>                    
                    <td><center><input type="text" id="txtTglInvoice" class="form-control datepicker" placeholder="Tanggal Invoice" value="<?php echo str_replace(' ', '',$tglinvoice);?>" <?php if($isDelete==1) {echo "disabled";} ?>></center></td>
                    <td><center><input type="text" id="txtKodeBarang" class="form-control" placeholder="Kode Barang" value="<?php echo $kodeBarang;?>"></center></td>
                    <td><center style="width: 300px"><input type="text" id="txtNamaBarang" class="form-control" placeholder="Nama Barang" size="40" value="<?php echo $namaBarang;?>"></center></td>
                    <td><center><input class="form-control" id="txtSatuan" type="text" placeholder="Satuan" style="width: 110px" value="<?php echo $satuan; ?>" <?php if($isDelete==1) {echo "disabled";} ?>></center></td>
                    <td><center><input class="form-control" id="txtValas" type="text" placeholder="Valas" style="width: 110px" value="<?php echo $valas; ?>" <?php if($isDelete==1) {echo "disabled";} ?>></center></td>
                    <td><center><input class="form-control" id="txtKodeHS" type="text" placeholder="Kode HS" style="width: 110px" value="<?php echo $kodeHS; ?>" <?php if($isDelete==1) {echo "disabled";} ?>></center></td>
                    <td><center><input class="form-control" id="txtKet" type="text" placeholder="Keterangan" style="width: 150px" value="<?php echo $ket; ?>" <?php if($isDelete==1) {echo "disabled";} ?>></center></td>
                    <td><center><input class="form-control" id="txttarifBarang" type="text" placeholder="Tarif" style="width: 80px" value="<?php echo $tarif; ?>" <?php if($isDelete==1) {echo "disabled";} ?>></center></td>
                    <td><center><input class="form-control txtjumlahBarang" id="txtjumlahBarang" type="text" value="<?php echo number_format($jumlah, 4, ',', '.');?>" placeholder="Qty" style="width: 90px" <?php if($isDelete==1) {echo "disabled";} ?>></center></td>                                        
                    <td><center><input class="form-control txtCIF" id="txtCIF" type="text" placeholder="CIF" style="width: 120px" value="<?php if(isset($cif)){echo number_format($cif, 2, ',', '.');} ?>" <?php if($isDelete==1) {echo "disabled";} ?>></center></td>
                    <td><center><input class="form-control txtTotal" id="txtTotal" type="text" placeholder="Total Nilai Barang" value="<?php echo number_format($total, 2, ',', '.'); ?>" <?php if($isDelete==1) {echo "disabled";} ?>></center></td>
                    <td><center><input class="form-control PDRIBayar" id="PDRIBayar" type="text" placeholder="PDRI Bayar" value="<?php echo $PDRIBayar; ?>" <?php if($isDelete==1) {echo "disabled";} ?>></center></td>
                    <td><center><input class="form-control PDRIBebas" id="PDRIBebas" type="text" placeholder="PDRI Bebas" value="<?php echo $PDRIBebas ?>" <?php if($isDelete==1) {echo "disabled";} ?>></center></td>
                    <td><center><input class="form-control" id="txtPemasok" type="text" placeholder="Pemasok" value="<?php echo $PDRIBebas ?>" <?php if($isDelete==1) {echo "disabled";} ?>></center></td>
                  </tr>
                </tbody>              
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button id="btnModalEditBC" onclick="editBC(this)" type="button" class="btn btn-primary"><?php if($isDelete==1) {echo "Delete BC";} else{echo "Edit BC";} ?></button>
      </div>
  </div>
</div>

<script>
  $(".datepicker").datepicker({ autoclose: true,format: 'dd-mm-yyyy'});
  $('#txtTglPabean').datepicker()
    .on('changeDate', function(e) 
    {
      $('#txtTglInvoice').datepicker('setDate', $('#txtTglPabean').val());
      $('#txtTglBL').datepicker('setDate', $('#txtTglPabean').val());
      $('#txtTglDataRMP').datepicker('setDate', $('#txtTglPabean').val());
    });
  function editBC(element) 
  {
    if($(element).text()=='Delete BC')
    {
      deleteBC();
    }
    else
    {
      var arrayOfObject=[]; 
      if($('#txtNoPabean').val()==''){alert('Silahkan masukkan No Pabean.');}
      else
      {
        var lengkap=0;
        var IdDetail=$('#txtIDDetail').val(); 
        var NoPabean=$('#txtNoPabean').val();  
        var NoBL=$('#txtNoBL').val();
        var TglBL=$('#txtTglBL').val();
        var NoInvoice=$('#txtNoInvoice').val();
        var NoNota=$('#txtNota').val();
        var TglInvoice=$('#txtTglInvoice').val();
        var TglNota=$('#txtTglNota').val();
        var Satuan=$('#txtSatuan').val();
        var Valas=$('#txtValas').val();        
        var KodeHS=$('#txtKodeHS').val();
        var Keterangan=$('#txtKet').val();
        var Tarif=$('#txttarifBarang').val();
        var Jumlah=$('#txtjumlahBarang').val();
        var CIF=$('#txtCIF').val();
        var Total=$('#txtTotal').val();
        var PDRIBayar=$('#PDRIBayar').val();
        var PDRIBebas=$('#PDRIBebas').val();
        var Pemasok1=$('#selectPemasok').val();
        var Pemasok2=$('#txtPemasok').val();
        var objDetailBC={"IdDetail":IdDetail,"NoPabean":NoPabean,"NoInvoice":NoInvoice,'NoNota':NoNota,"NoBL":NoBL,"TglInvoice":TglInvoice,"TglBL":TglBL,"TglNota":TglNota,'Jumlah':Jumlah,'Tarif':Tarif,'KodeHS':KodeHS,'CIF':CIF,'Keterangan':Keterangan,'Total':Total,'PDRIBayar':PDRIBayar,"PDRIBebas":PDRIBebas,'Satuan':Satuan,'Valas':Valas,'Pemasok1':Pemasok1,'Pemasok2':Pemasok2};
        console.log(objDetailBC);
        updateBC(objDetailBC);
      }  
    }      
  }  
  function updateBC(object)
  {
    var json=JSON.stringify(object);//console.log(json);
    $.ajax({
        url: "<?php echo base_url();?>BC/editBC",
        method:"POST",
        data : { 'json': json},
        success: function (response) 
        {console.log(response);
          $('#myModal').modal('hide');
          var table=$('#tblBC').DataTable();table.destroy();
          getBC('<?php echo $jenis ?>');operation='';
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
    });
  }
  function deleteBC()
  {
    $.ajax({
        url: "<?php echo base_url();?>BC/deleteBC",
        method:"POST",
        data : { 'iddetail': $('#txtIDDetail').val()},
        success: function (response) 
        {
          $('#myModal').modal('hide');
          var table=$('#tblBC').DataTable();table.destroy();
          getBC('<?php echo $jenis ?>');operation='';
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
    });
  }
  
  $('#tblEditBC').DataTable( {
    "paging":   true,
    "ordering": true,
    "info":     false
  } );
  $("#myModal .datepicker").datepicker({ autoclose: true,format: 'dd-mm-yyyy'});
  $('#txtTglDataRMP').datepicker().on('changeDate', function(e) 
  {
    getDataResourceByTanggal($('#txtTglDataRMP').val(),$('#selectPemasok').val());
  });
  $('#txtjumlahBarang').number(true, 4,',', '.');
  $('#txtCIF').number(true, 2,',', '.');
  $('#txtTotal').number(true, 2,',', '.');
  $('#PDRIBayar').number(true, 2,',', '.');
  $('#PDRIBebas').number(true, 2,',', '.');
 </script>

