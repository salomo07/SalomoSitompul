<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PSG IT Inventory</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php $this->load->view('/template/link');?>  
  <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="assets/plugins/jQueryUI/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css">
</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">
  <?php echo $header?>
  <?php echo $asideleft?> 

  <div class="content-wrapper">
    <section class="content-header"><br>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">PSG IT Inventory</a></li>
        <li class="active"><?php echo $this->router->fetch_class();?></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box" style="border-top-color: #00ff80";>
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title; ?></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body" style="overflow: auto;">
              <div class="col-md-12"> 
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Tanggal Mutasi :</label>
                      <div class="radio" id="rgSwitchTanggalTransaksi" onchange="rgSwitchTanggalTransaksiChange()">
                        <form>
                          <label>
                            <input type="radio" name="rgSwitchTanggalTransaksi" id="optionradioOff" value="disabled" checked>
                            Tanggal Hari Ini
                          </label>
                          <label> </label>
                          <label>
                            <input type="radio" name="rgSwitchTanggalTransaksi" id="optionradioOn">
                            Pilih Tanggal
                          </label>
                          <label></label>
                        </form>
                      </div>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input id="txtTanggalTransaksi" class="form-control datepicker pull-right" disabled value="<?php echo date('d-m-Y');?>" onchange="getDataMutasi()">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <br><br><br><center><div id="txtMsg"></div></center>
              <div class="col-md-12">
                <table id="tblMutasi"  class="table table-bordered table-hover dataTable" role="grid" width="100%">
                  <thead>
                    <tr>
                      <th><center>Kode Barang</center></th>
                      <th><center>Nama Barang</center></th>
                      <th><center>Satuan</center></th>
                      <th><center>Saldo Awal</center></th>
                      <th><center>Pemasukan</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div id="addscript"></div>
            </div>
            <div class="box-footer">
              <div class="col-md-12">
                <div class="col-md-6"><button id="btnAddMutasi" onclick="AddMutasi();operation=''" style="background-color: #00ff80" class="btn btn-block"><i class="fa fa-plus"></i> Input Mutasi Barang</button></div>
                <div class="col-md-6"><button id="btnEditMutasi" onclick="operation='Edit'; alert('Silahkan pilih Data Mutasi Barang yang akan diedit.');" style="background-color: #00ff80" class="btn btn-block"><i class="fa fa-edit"></i> Edit Mutasi Barang</button></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
    </div>

  <footer class="main-footer">
    <center>Copyright &copy; PT. PSG 2016.</center>
  </footer>
  <div id="myModal" class="modal fade" tabindex="-1" role="dialog"></div>
  <?php $this->load->view('/template/asideright');?> 
<div class="control-sidebar-bg"></div>
</div>
</body>
</html>
<?php $this->load->view('/template/script');?> 
<style>
</style>

<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/maskMoney/jquery.number.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jQueryUI/jquery-ui.min.js"></script>
<script>   
  var operation='';
  getDataMutasi();
  var arrayMaster='';
  function getDataMutasi()
  {
    $.ajax({
        url: "<?php echo base_url();?>Mutasi/getDataMutasi",
        method:"POST",
        data : {'tgl':$('#txtTanggalTransaksi').val(),'jenis':'<?php echo $jenis;?>'},
        success: function (response) 
        {//console.log(response);
          var table=$('#tblMutasi').DataTable();table.destroy();
          $('#tblMutasi').html(response);
          $('#tblMutasi').DataTable( {
            "paging":   true,
            "ordering": true,
            "info":     false
          } );
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
    });
  }
  
  function rgSwitchTanggalTransaksiChange()
  {
    if($("input[name='rgSwitchTanggalTransaksi']:checked").val()=='disabled')
    {
      var d = '<?php echo date('d-m-Y');?>';
      $("#txtTanggalTransaksi").val(d);
      $('#txtTanggalTransaksi').prop('disabled', true);getDataMutasi()//getBC('<?php echo $jenis;?>');
    }
    else
    {
      $('#txtTanggalTransaksi').prop('disabled', false);getDataMutasi()//getBC('<?php echo $jenis;?>');      
    }
  }
  function AddMutasi() 
  {
    $.ajax({
        url: "<?php echo base_url();?>Mutasi/getModalAddMutasi",
        method:"POST",
        data : {'jenis':'<?php echo $jenis;?>'},
        success: function (response) 
        {
          $('#myModal').html(response);
          $('#myModal').modal('show');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
    });
  }
  function trClicked(element)
  {
    if(operation=='Edit')
    {
      $.ajax({
        url: "<?php echo base_url();?>Mutasi/getModalEditMutasi",
        method:"POST",
        data : {'id':$(element).find('#txtIdMutasi').val()},
        success: function (response) 
        {
          //console.log(response);
          $('#myModal').html(response);
          $('#myModal').modal('show');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
    });
    }
  }
  function checkAll(ele)
  {
    var checkboxes = document.getElementsByTagName('input');
    if (ele.checked) {
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox') {
                checkboxes[i].checked = true;
            }
        }
    } else {
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox') {
                checkboxes[i].checked = false;
            }
        }
    }
  }
  var arrayBaru=[];
  function addRow()
  {
    if(arrayMaster==''){alert('Master kosong')}
    else{
    if($('#tblAddMutasi tbody tr:last').find('td').text()=='No data available in table')
      {$('#tblAddMutasi tbody tr:last').html('');}
    
    $('#tblAddMutasi tbody tr:last').after('<tr><td><center><input class="form-control" name="txtKodeBarang" id="txtKodeBarang" size="15"></center><input id="txtJenisMutasiModal" type="hidden" size="10" value="<?php echo $jenis; ?>"></td><td><center><input class="form-control" id="txtDescBarang" type="text" size="90" style="text-align: center;" value=""></center></td><td><center><input class="form-control" id="txtSatuan" type="text" size="5" style="text-align: center;" value=""></center></td><td><center><input class="form-control txtSaldoAwal" id="txtSaldoAwal" type="text" size="20" style="text-align: center;" value="0" onkeyup="getSaldoAkhir(this)"></center></td><td><center><input class="form-control txtPemasukan" id="txtPemasukan" size="15" style="text-align: center;" value="0" onkeyup="getSaldoAkhir(this)"></center></td><td><center><input class="form-control txtPengeluaran" id="txtPengeluaran" size="15" style="text-align: center;" value="0" onkeyup="getSaldoAkhir(this)"></center></td><td><center><input class="form-control txtStokOpname" size="3" id="txtStokOpname" style="text-align: center;" placeholder="Stok Opname" value="0"></center></td><td><center><input class="form-control txtPenyesuaian" size="3" id="txtPenyesuaian" style="text-align: center;" placeholder="Penyesuaian" value="0"></center></td><td><center><input class="form-control txtSaldoAkhir" size="20" id="txtSaldoAkhir" style="text-align: center;" placeholder="Saldo Akhir" value="0" disabled></center></td><td><center><input class="form-control txtSelisih" size="3" id="txtSelisih" style="text-align: center;" placeholder="Selisih" value="0"></center></td><td><center><input class="form-control" type="text" id="txtKeterangan" style="text-align: center;" placeholder="Keterangan" value=""></center></td><td><center><input type="checkbox"></center></td></tr>');
    $('#addscript').html("<script>$('.txtSaldoAwal').number(true, 4,',', '.');$('.txtPemasukan').number(true, 4,',', '.');$('.txtPengeluaran').number(true, 4,',', '.');$('.txtStokOpname').number(true, 4,',', '.');$('.txtPenyesuaian').number(true, 4,',', '.');$('.txtSelisih').number(true, 4,',', '.');$('.txtSaldoAkhir').number(true, 4,',', '.');<\/script>");
    getMaster()
    $('input[name="txtKodeBarang"]').autocomplete({
        source: arrayBaru,
        select: function (a, b) {          
          getDescription(b.item.value)
        }
    });
    }
  }
  function setArrayMaster(xxx)
  {
    arrayMaster=[];arrayMaster=xxx;//console.log(xxx)
    var arrayBaru=[];
    for (var i = 0; i < xxx.length; i++) {
      arrayBaru.push(xxx[i].ItemID);
    }
    $('input[name="txtKodeBarang"]').autocomplete({
        source: arrayBaru,
        select: function (a, b) {          
          getDescription(b.item.value)
        }
    });
  }
  function getDescription(iditem)
  {
    for (var i = 0; i < arrayMaster.length; i++) 
    {
      if(arrayMaster[i].ItemID==iditem){$('#txtDescBarang').val(arrayMaster[i].Name);$('#txtSatuan').val(arrayMaster[i].Satuan);}
    }
  }
  function getSaldoAkhir(element)
  {
    var SaldoAwal=$(element).closest('tr').find('#txtSaldoAwal').val();
    var Pemasukan=$(element).closest('tr').find('#txtPemasukan').val();
    var Pengeluaran=$(element).closest('tr').find('#txtPengeluaran').val();
    var StokOpname=$(element).closest('tr').find('#txtStokOpname').val();
    var Penyesuaian=$(element).closest('tr').find('#txtPenyesuaian').val();
    var SaldoAkhir=$(element).closest('tr').find('#txtSaldoAkhir').val();
    var Selisih=$(element).closest('tr').find('#txtSelisih').val();
    if(SaldoAwal==''||Pemasukan==''||Pengeluaran==''||SaldoAkhir=='')
    {
      alert('Kolom tidak boleh kosong.');
    }
    else
    {
      SaldoAkhir=Number(SaldoAwal)+Number(Pemasukan)-Number(Pengeluaran);
      $(element).closest('tr').find('#txtSaldoAkhir').val(SaldoAkhir);
      $(element).closest('tr').find('#txtStokOpname').val(SaldoAkhir);
      $('#txtSaldoAkhir').number(true, 4,',', '.');
      $('#txtStokOpname').number(true, 4,',', '.');
    }
  }
  $('.datepicker').datepicker(
  {
    autoclose: true,dateFormat: 'dd-mm-yy'
  });
</script>   