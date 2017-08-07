<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PSG IT Inventory</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php $this->load->view('/template/link');?>
  <!-- <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css"> -->
  <link rel="stylesheet" href="assets/plugins/datatables/jquery-ui.css">
  <link rel="stylesheet" href="assets/plugins/datatables/dataTables.jqueryui.min.css">
  <link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="assets/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
  <!-- <link rel="stylesheet" href="assets/plugins/datatables/fixedHeader.dataTables.min.css"> -->
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
          <div class="box" style="border-top-color: violet;"> <!-- Add & Edit BC -->
            <div class="box-header with-border">
              <h3 class="box-title">Laporan Transaksi Pabean</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body" style="max-height: 500px; max-width: : 200px">
              <div class="col-md-12">
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Date Start:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" id="txtTanggalStart" class="form-control pull-right" onchange="dateChange()" >
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Date End:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" id="txtTanggalEnd" class="form-control pull-right" onchange="dateChange()">
                    </div>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label>Tipe BC</label>
                    <select onchange="changingTipeBC(this)" id="selectTipeBC" class="form-control select2" style="width: 100%;">
                      <option value="all">All</option>
                      <option value="in">In</option>
                      <option value="out">Out</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Jenis BC</label>
                    <select onchange="changingJenisBC()" name="selectJenisBC" id="selectJenisBC" class="form-control select2" style="width: 100%;">
                    <?php foreach ($dataAksesBC as $key => $value): ?>
                      <option value="<?php echo $value->IdBC; ?>"><?php echo $value->NamaMenu2; ?></option>
                    <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-2">
                  <div class="form-group">
                    <button id="btnExportPDF" onclick="exportPDF()" style="background-color: violet" class="btn btn-block"><i class="glyphicon glyphicon-print"></i> Export to PDF</button>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <button id="btnExportExcel" onclick="exportExcel()" style="background-color: violet" class="btn btn-block"><i class="glyphicon glyphicon-floppy-save"></i> Export to Excel</button>
                  </div>
                </div>
              </div>
              <br><br><br><center><label id="txtMsg"></label></center>
              <div class="col-md-12" id="divTblBC">
                <table id="tblBC" class="display" cellspacing="0" width="100%">
                  <thead style="">
                      <tr style="font-size:12px;">
                          <th><center>Pabean</center></th>
                          <th><center>Nota</center></th>
                          <th><center>Invoice</center></th>
                          <th><center>Tgl Pabean</center></th>
                          <th><center>Tgl Nota</center></th>
                          <th><center>Tgl Invoice</center></th>
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
                          <th><center>Pilih <input type="checkbox" onchange="checkAll(this)"></center></th>
                      </tr>
                  </thead>
                  <tbody></tbody>
                  <tfoot style="font-size:12px">
                      <tr">
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                      </tr>
                  </tfoot>
                </table>
                </div>
            </div>
            <div class="box-footer">
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
<div class="control-sidebar-bg"></div>
</div>
</body>
</html>
<?php $this->load->view('/template/script');?>
<style>
.datepicker{z-index:1151 !important;}
</style>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- <script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script> -->
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.jqueryui.min.js"></script>
<!-- <script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script> -->
<script src="<?php echo base_url();?>assets/plugins/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- <script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.fixedHeader.min.js"></script> -->
<!-- <script src="<?php echo base_url();?>assets/plugins/datatables/ColReorderWithResize.js"></script> -->

<script>
var start = moment().subtract(30, 'days').format('DD-MM-YYYY');
var end = moment().format('DD-MM-YYYY');
$('#txtTanggalStart').val(start);
$('#txtTanggalEnd').val(end);
$('#txtTanggalStart').datepicker(
{autoclose: true,format: 'dd-mm-yyyy'});
$('#txtTanggalEnd').datepicker({autoclose: true,format: 'dd-mm-yyyy'});

// $('#tblBC').DataTable({
//   "scrollY": 400,
//   "scrollX": true,
//   "paging":   true,
//   "ordering": true,
//   "info":     false,
//   "processing": true,
//   "serverSide": true,
//   "aLengthMenu": [[10, 25, 50], [10, 25, 50]],
//   "columnDefs": [{ "width": "50%", "targets": 7 }],
//   "ajax": {
//       url: 'Report/getReport',
//       type: "POST",
//       data:{jenis: $('#selectJenisBC').val(),date:$('#txtTanggalStart').val()+' - '+$('#txtTanggalEnd').val()},
//   },
//   "columns": [
//       { "data": "NoPabean"},
//       { "data": "NoNota"},
//       { "data": "NoInvoice"},
//       { "data": "TanggalPabean"},
//       { "data": "TanggalNota"},
//       { "data": "TanggalInvoice"},
//       { "data": "KodeBarang"},
//       { "data": "NamaBarang"},
//       { "data": "Sat"},
//       { "data": "Valas"},
//       { "data": "KodeHS"},
//       { "data": "Tarif"},
//       { "data": "Qty"},
//       { "data": "CIF"},
//       { "data": "Total"},
//       { "data": "PDRIBayar"},
//       { "data": "PDRIBebas"},
//       { "data": "Keterangan"},
//       { "data": "Centang"}
//   ]
// });

// ,
//   "columns": [
//       { "data": "JenisBC"},
//       { "data": "JenisBC"},
//       { "data": "JenisBC"}
//   ]
// "scrollY": 500,
//   "scrollX": true,
function exportExcel()
{
  var bcTerpilih=[];
  $('#tblBC tbody tr').each(function()
  {
    $(this).find('input:checkbox:checked').each(function()
    {
      var objectBCTerpilih={'BTBId':$(this).val()};
      bcTerpilih.push(objectBCTerpilih);
    });
  });
  if(bcTerpilih.length==0)
  {alert('Silahkan pilih transaksi BC yang akan di export ke Excel.');}
  else
  {
    $.ajax({
        url: "<?php echo base_url();?>ExportExcel/exportReportTransaksi",
        method:"POST",
        data : { jenis: $('#selectJenisBC').val(),priode:$('#txtTanggalStart').val()+' - '+$('#txtTanggalEnd').val(),bcTerpilih:JSON.stringify(bcTerpilih)},
        success: function (response)
        {//console.log(response);
          window.location.href ='<?php echo base_url();?>ExportExcel/exportReportTransaksi/';
        },
        error: function(XMLHttpRequest, textStatus, errorThrown)
        {
          alert("Error: " + errorThrown);
        }
    });
  }
}
function getTablePDF()
{
  var bcTerpilih=[];
  $('#tblBC tbody tr').each(function()
  {
    $(this).find('input:checkbox:checked').each(function()
    {
      var trBCTerpilih=$(this).closest('tr');
      bcTerpilih.push(trBCTerpilih);
    });
  });
  return bcTerpilih;
}
function exportPDF()
{
  var array=getTablePDF();
  if(array.length>0)
  {
    var htmltbl=`
    <table>
    <thead style="font-size:10px">
    <tr>
      <th><center>Pabean</center></th>
      <th><center>Nota</center></th>
      <th><center>Invoice</center></th>
      <th><center>Tgl. Pabean</center></th>
      <th><center>Tgl. Nota</center></th>
      <th><center>Tgl. Invoice</center></th>
      <th><center>Kode Barang</center></th>
      <th><center>Nama Barang</center></th>
      <th><center>Satuan</center></th>
      <th><center>Valas</center></th>
      <th><center>Tarif</center></th>
      <th><center>Jumlah</center></th>
      <th><center>CIF</center></th>
      <th><center>Nilai Barang</center></th>
      <th><center>PDRI Bayar</center></th>
    </tr>
    </thead>
    <tbody style="font-size:10px">`;
    for (var i = 0; i < array.length; i++)
    {
      htmltbl=htmltbl+
      `<tr>
        <td><center>`+array[i].find('td').eq(0).text()+`</center></td>
        <td><center>`+array[i].find('td').eq(1).text()+`</center></td>
        <td><center>`+array[i].find('td').eq(2).text()+`</center></td>
        <td><center>`+array[i].find('td').eq(3).text()+`</center></td>
        <td><center>`+array[i].find('td').eq(4).text()+`</center></td>
        <td><center>`+array[i].find('td').eq(5).text()+`</center></td>
        <td><center>`+array[i].find('td').eq(6).text()+`</center></td>
        <td><center>`+array[i].find('td').eq(7).text()+`</center></td>
        <td><center>`+array[i].find('td').eq(8).text()+`</center></td>
        <td><center>`+array[i].find('td').eq(9).text()+`</center></td>
        <td><center>`+array[i].find('td').eq(9).text()+`</center></td>
        <td><center>`+array[i].find('td').eq(12).text()+`</center></td>
        <td><center>`+array[i].find('td').eq(13).text()+`</center></td>
        <td><center>`+array[i].find('td').eq(14).text()+`</center></td>
        <td><center>`+array[i].find('td').eq(15).text()+`</center></td>
      </tr>`;
    }

    htmltbl=htmltbl+`</tbody><table>`;
  }
  //console.log(htmltbl);
  $('#txtMsg').html('<p class="bg-danger">Sedang mengeksport laporan ke PDF...</p>');

  $.ajax({
        url: "<?php echo base_url();?>Report/exportPDF",
        method:"POST",
        data : { 'data': htmltbl,'start':$('#txtTanggalStart').val(),'end':$('#txtTanggalEnd').val()},
        success: function (response)
        {
          window.location.href ='<?php echo base_url();?>Report/exportPDF';
          $('#txtMsg').text('');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown)
        {
          alert("Error: " + errorThrown);
        }
    });
}
getBC();//Untuk load BC
// function getBC()
// {
//   $('#txtMsg').text('Sedang memuat laporan...');
//   $.ajax({
//         url: "<?php echo base_url();?>Report/getReport",
//         method:"POST",
//         data : { jenis: $('#selectJenisBC').val(),date:$('#txtTanggalStart').val()+' - '+$('#txtTanggalEnd').val()},
//         async: true,
//         success: function (response)
//         {
//           console.log(response);
//           var table=$('#tblBC').DataTable();table.destroy();
//           $('#tblBC').html(response);
//           $('#tblBC').DataTable( {
//             "scrollY": 500,
//             "scrollX": true,
//             "paging":   true,
//             "ordering": true,
//             "info":     false,
//             "columnDefs": [{ "width": "50%", "targets": 7 }]
//           });
//           $('#txtMsg').html('');
//         },
//         error: function(XMLHttpRequest, textStatus, errorThrown) {
//           alert("Error: " + errorThrown);
//         }
//   });
// }
function getBC()
{
  $('#txtMsg').text('Sedang memuat laporan...');
  $.ajax({
        url: "<?php echo base_url();?>Report/getReport2",
        method:"POST",
        data : { jenis: $('#selectJenisBC').val(),date:$('#txtTanggalStart').val()+' - '+$('#txtTanggalEnd').val()},
        async: true,
        success: function (response)
        {
          if(response.search('<!-- HEADER -->' )>-1)
          {
            location.reload();
          }
          else
          {
            var table=$('#tblBC').DataTable();table.destroy();
            $('#tblBC').html(response);
            $('#tblBC').DataTable( {
              "scrollY": 400,
              "scrollX": true,
              "paging":   false,
              "ordering": true,
              "info":     false,
              "columnDefs": [{ "width": "50%", "targets": 7 }]
            });
            $('#txtMsg').html('');
          }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          alert("Error: " + errorThrown);
        }
  });
}
function changingJenisBC()
{
  getBC();
}
function changingTipeBC(element)
{
  if($(element).val()=='all')
  {
    $.ajax({
        url: "<?php echo base_url();?>Report/getDataAksesBC",
        method:"POST",
        dataType:"json",
        success: function (response)
        {
          var html='';
          for (var i = 0; i < response.length; i++)
          {
            var idBC=response[i].IdBC;
            if(idBC!=null)
            {
              html=html+'<option value="'+response[i].IdBC+'">'+response[i].NamaMenu2+'</option>';
            }
          }
          $('#selectJenisBC').html(html);
          getBC();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          alert("Error: " + errorThrown);
        }
    });
  }
  else if($(element).val()=='in')
  {
    $.ajax({
        url: "<?php echo base_url();?>Report/getDataAksesBC",
        method:"POST",
        dataType:"json",
        success: function (response)
        {
          var html='';
          for (var i = 0; i < response.length; i++)
          {

            var idBC=response[i].IdBC;
            if(idBC!=null)
            {
              if(idBC.includes('IN')==true || idBC.includes('FTZ')==true)
              {html=html+'<option value="'+response[i].IdBC+'">'+response[i].NamaMenu2+'</option>';}
            }
          }
          $('#selectJenisBC').html(html);
          getBC();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          alert("Error: " + errorThrown);
        }
    });
  }
  else if($(element).val()=='out')
  {
    $.ajax({
        url: "<?php echo base_url();?>Report/getDataAksesBC",
        method:"POST",
        dataType:"json",
        success: function (response)
        {
          var html='';
          for (var i = 0; i < response.length; i++)
          {
            var idBC=response[i].IdBC;
            if(idBC!=null)
            {
              if(idBC.includes('OUT')==true)
              {html=html+'<option value="'+response[i].IdBC+'">'+response[i].NamaMenu2+'</option>';}
            }
          }
          $('#selectJenisBC').html(html);
          getBC();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          alert("Error: " + errorThrown);
        }
    });
  }
  getBC();
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
function dateChange()
{
  getBC();
}
</script>