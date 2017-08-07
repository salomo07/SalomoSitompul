<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PSG IT Inventory</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php $this->load->view('/template/link');?>  
  <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
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
          <div class="box" style="border-top-color: #80ffff"> <!-- Add & Edit BC -->
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
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Tanggal Transaksi :</label>
                    <div class="radio" id="rgSwitchTanggalTransaksi" onchange="rgSwitchTanggalTransaksiChange()">
                      <form>
                        <label>
                          <input type="radio" name="rgSwitchTanggalTransaksi" id="optionradioOff" value="disabled" checked="">
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
                      <input type="text" id="txtTanggalTransaksi" class="form-control pull-right" value="<?php echo date('d-m-Y'); ?>" onchange="getBC('<?php echo $jenis;?>')" disabled>
                    </div>
                    <br><button id="btnPrintBC" onclick="printReport()" class="btn btn-block" style="background-color: #80ffff"><i class="glyphicon glyphicon-floppy-save"></i> Export to Excel</button>
                  </div>
                </div>
              </div>
              <br><br><br><center><div id="txtMsg"></div></center>
              <div class="col-md-12">
                <table id="tblBC" class="table table-bordered table-hover dataTable" role="grid" width="100%">
                  <thead>
                    <tr>
                      <th><center>Voy</center></th>
                      <th><center>No Pabean</center></th>                    
                      <th><center>No Nota</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- <div class="box-footer">
              <div class="col-md-12">
                <div class="col-md-4"><button id="btnAddBC" onclick="getModalAddBC()" class="btn btn-block" style="background-color: #80ffff"><i class="fa fa-plus"></i>  Add BC <i class="fa fa-spin tes-spin"></i></button></div>
                <div class="col-md-4"><button id="btnDeleteBC" onclick="alert('Silahkan pilih Data BC yang akan dihapus.');operation='Delete';" class="btn btn-block" style="background-color: #80ffff"><i class="fa fa-trash"></i>  Delete BC</button></div>
                <div class="col-md-4"><button id="btnEditBC" onclick="alert('Silahkan pilih Data BC yang akan diubah.');operation='Edit';" class="btn btn-block" style="background-color: #80ffff"><i class="fa fa-edit"></i> Edit BC</button></div>
              </div>
            </div> -->
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
.datepicker{z-index:2000 !important;}
</style>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/plugins/maskMoney/jquery.number.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/moment.min.js"></script>
<script> 
var operation='';
getBC('<?php echo $jenis;?>');//Untuk load BC

function rgSwitchTanggalTransaksiChange()
{
  if($("input[name='rgSwitchTanggalTransaksi']:checked").val()=='disabled')
  {
    var d = '<?php echo date('d-m-Y');?>';
    $("#txtTanggalTransaksi").val(d);
    $('#txtTanggalTransaksi').prop('disabled', true);getBC('<?php echo $jenis;?>');
  }
  else
  {
    $('#txtTanggalTransaksi').prop('disabled', false);getBC('<?php echo $jenis;?>');
  }
}
$('#txtTanggalTransaksi').datepicker(
{
  autoclose: true,format: 'dd-mm-yyyy'
});
function printReport()
{
  if($('#txtTanggalTransaksi').val()!='')
  {
    var jenis='<?php echo $jenis;?>';
    var bcTerpilih=[];
    $('#tblBC tbody tr').each(function() 
    {
      if($(this).find('#txtIdDetail').val()===undefined)
      {}   
      else
      {
        var objectBCTerpilih={'IdBC':$(this).find('#txtIdDetail').val()};
        bcTerpilih.push(objectBCTerpilih);
      }
    });
    if(bcTerpilih.length>0)
    {
      $.ajax({
          url: "<?php echo base_url();?>ExportExcel/exportPreviewTransaksi",
          method:"POST",
          data : { jenis:jenis,priode:$('#txtTanggalTransaksi').val(),bcTerpilih:JSON.stringify(bcTerpilih)},
          success: function (response) 
          {
            window.location.href ='<?php echo base_url();?>ExportExcel/exportPreviewTransaksi/';
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) 
          { 
            alert("Error: " + errorThrown); 
          }
      });
    }
    else
    {
      alert('Tidak ada data yang dapat dieksport');
    }
  }
}
function getBC(jenis)
{ 
  $.ajax({
        url: "<?php echo base_url();?>BC/getBC",
        method:"POST",
        data : { jenis: jenis,date:$('#txtTanggalTransaksi').val()},
        beforeSend: function(){
          $('#txtMsg').html('Sedang memuat data...');
        },
        success: function (response) 
        {
          console.log(response);
          var table=$('#tblBC').DataTable();table.destroy();
          $('#tblBC').html(response);
          $('#tblBC').DataTable( {
            "paging":   true,
            "ordering": false,
            "searching": false,
            "info":     false
          } );
          $('#txtMsg').html('');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); $('#txtMsg').html('');console.log(XMLHttpRequest.responseText);
        }
  });
}
// <input id="txtKet" type="text" class="form-control" placeholder="Keterangan" style="width: 150px">
function addRow()
{
  if($('#tblAddBC tbody tr:last').find('td').text()=='No data available in table')
    {$('#tblAddBC tbody tr:last').html('');}
  
  $('#tblAddBC tbody tr:last').after('<tr><td><center><input type="hidden" id="txtJenisBC" value="<?php echo $_GET['jenis'];?>"><input id="txtNoNota" class="form-control" type="text" placeholder="No Nota" value=""></center></td><td><center><input type="hidden" id="txtNoVoy" value=""><input type="text" id="txtTglNota" class="form-control datepicker" placeholder="Tanggal Nota"></td><td><center><input type="text" id="txtNoInvoice" class="form-control" placeholder="No Invoice"></center></td><td><center><input type="text" id="txtTglInvoice" class="form-control datepicker" placeholder="Tanggal Invoice" value=""></center></td><td><center><input type="text" id="txtKodeBarang" class="form-control" placeholder="Kode Barang"></center></td><td><center><input type="text" id="txtNamaBarang" class="form-control" placeholder="Nama Barang" style="width: 300px"></center></td><td><center><input id="txtSat" type="text" class="form-control" placeholder="Satuan" style="width: 80px" value=""></center></td><td><center><input id="txtValas" type="text" class="form-control" placeholder="Valas" style="width: 80px" value=""></center></td><td><center><input id="txtKodeHS" type="text" class="form-control" placeholder="Kode HS" style="width: 110px"></center></td><td><center></center></td><td><center></center></td><td><center><input id="txtjumlahBarang" class="form-control txtjumlahBarang" onchange="warning(this)" type="text" value="" placeholder="Qty" style="width: 90px"></center></td><td><center><input id="txtCIF" type="text" class="form-control txtCIF" placeholder="CIF (Harga Satuan)" style="width: 120px" value=""></center></td><td><center><input id="txtTotal" class="form-control txtTotal" type="text" placeholder="Total Nilai Barang"></center></td><td><center><input id="PDRIBayar" class="form-control PDRIBayar" type="text" placeholder="PDRI Bayar"></center></td><td><center><input id="PDRIBebas" class="form-control PDRIBebas" type="text" placeholder="PDRI Bebas"></center></td><td><center><input id="txtBuyer" class="form-control" type="text" placeholder="Buyer (Optional)"></center></td><td><center><input type="checkbox"></center></td></tr>');
    $('.txtjumlahBarang').number(true, 4,',', '.');
    $('.txtCIF').number(true, 4,',', '.');
    $('.txtTotal').number(true, 4,',', '.');
    $('.PDRIBayar').number(true, 4,',', '.');
    $('.PDRIBebas').number(true, 4,',', '.');
    $(".datepicker").datepicker({ autoclose: true,format: 'dd-mm-yyyy'});
}
</script>   