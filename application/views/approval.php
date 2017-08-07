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
  <link rel="stylesheet" href="assets/plugins/select2/select2.min.css">
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
          <div class="box" style="border-top-color: #ccff66";> <!-- Approval BC -->
            <div class="box-header with-border">
              <h3 class="box-title">Approval Pabean</h3>
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
                      <label>Tanggal Transaksi :</label>
                      <div class="radio" id="rgSwitchTanggalTransaksi">
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
                        <input type="text" id="txtTanggalTransaksi" class="form-control pull-right" disabled="" value="<?php echo date('d-m-Y');?>" onchange="getApprovalbyDate()">
                      </div>
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
                  <div class="col-md-1">
                    <div class="form-group">
                      <label>Dept Name</label>
                      <input type="text" id="txtDeptName" class="form-control pull-right" value="<?php echo $deptname; ?>" disabled>
                      <input type="hidden" id="txtDeptId" class="form-control pull-right" value="<?php echo $deptid; ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Print</label>
                      <button id="btnExportExcel" onclick="exportExcel()" style="background-color: #ccff66" class="btn btn-block"><i class="glyphicon glyphicon-floppy-save"></i> Export to Excel</button>
                    </div>
                  </div>
                </div>
              </div>
              <br><br><br><center><div id="txtMsg"></div></center>
              <div class="col-md-12">
                <table id="tblBCApproved" class="table table-bordered table-hover dataTable" role="grid" width="100%">
                    <thead>
                      <tr>
                        <th><center>Voy</center></th>
                        <th><center>No Pabean</center></th>
                        <th><center>No Invoice</center></th>
                        <th><center>Tgl Pabean</center></th>
                        <th><center>Pemasok</center></th>
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
            </div>
            <div class="box-footer">
              <div class="col-md-12">
                <div class="col-md-6"></div>
                <div class="col-md-6"><button id="btnApproveBC" onclick="btnApproveBC()" style="background-color: #ccff66" class="btn btn-block"><i class="fa fa-check"></i> Approve BC</button></div>
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
.datepicker{z-index:1151 !important;}
</style>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>

<script>   
  function getApprovalbyDate() 
  {
    $.ajax({
          url: "<?php echo base_url();?>Approval/getApprovalbyDate",
          method:"POST",
          data : { date: $('#txtTanggalTransaksi').val(),jenis:$('#selectJenisBC').val(),'deptid':$('#txtDeptId').val()},
          success: function (response) 
          {console.log(response)
            var table=$('#tblBCApproved').DataTable();table.destroy();
            $('#tblBCApproved').html(response);
            $('#tblBCApproved').DataTable( {
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
  getApprovalbyDate();
  function btnApproveBC()
  {
    var jumlahChecked=0;
    $('#tblBCApproved tbody tr').each(function() {
      $(this).find('input:checkbox:checked').each(function() {
        var check=$(this).closest('tr').find('td').eq(17).find('#chkApproval');
        if($(check).is(":checked")){jumlahChecked=jumlahChecked+1;}
        else{}
      });
    });
    if(jumlahChecked==0)
    {operation='Approve'; alert('Silahkan pilih BC yang akan di approve');}
    else
    {
      approvingBC();
    }
  }
  function exportExcel()
  {
    var bcTerpilih=[];
    $('#tblBCApproved tbody tr').each(function() 
    {
      $(this).find('input:checkbox:checked').each(function() 
      {
        var objectBCTerpilih={'IdBC':$(this).val()};
        bcTerpilih.push(objectBCTerpilih);      
      });    
    });
    if(bcTerpilih.length==0)
    {alert('Silahkan pilih transaksi BC yang akan di export ke Excel.');}
    else
    {//console.log("<?php echo base_url();?>ExportExcel/exportToExcel");
      $.ajax({
          url: "<?php echo base_url();?>ExportExcel/exportApproveTransaksi",
          method:"POST",
          data : { jenis: $('#selectJenisBC').val(),priode:$('#txtTanggalTransaksi').val(),bcTerpilih:JSON.stringify(bcTerpilih),'deptname':$('#txtDeptName').val()},
          success: function (response) 
          {
            window.location.href ='<?php echo base_url();?>ExportExcel/exportApproveTransaksi/';
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) 
          { 
            alert("Error: " + errorThrown); 
          }
      });
    }
  }
  function approvingBC() 
  {
    var dataDipilih=[];
    $('#tblBCApproved tbody tr').each(function() {
      $(this).find('input:checkbox:checked').each(function() 
      {
        var objDetailBC={'Checked':$(this).val(),'jenisBC':'<?php echo $_GET['jenis'];?>'};
        dataDipilih.push(objDetailBC);
      });
    });
    $.ajax({
          url: "<?php echo base_url();?>Approval/approveBC",
          method:"POST",
          data : {'json':JSON.stringify(dataDipilih)},
          success: function (response) 
          {
            alert('BC telah berhasil di Approve.');getApprovalbyDate();
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Error: " + errorThrown); 
          }
    });
  }
  $('#txtTanggalTransaksi').datepicker(
  {
      autoclose: true,format: 'dd-mm-yyyy'
  });
  function changingJenisBC()
  {
    getApprovalbyDate();
  }
  //$(".select2").select2();
  $('#rgSwitchTanggalTransaksi').on('change', function() 
  {
    if($("input[name='rgSwitchTanggalTransaksi']:checked").val()=='disabled')
    {
      var d = '<?php echo date('d-m-Y');?>';
      $("#txtTanggalTransaksi").val(d);
      $('#txtTanggalTransaksi').prop('disabled', true);getApprovalbyDate();
    }
    else
    {
      $('#txtTanggalTransaksi').prop('disabled', false);getApprovalbyDate();
    }
  });
</script>   