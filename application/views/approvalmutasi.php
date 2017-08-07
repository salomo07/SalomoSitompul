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
              <h3 class="box-title">Approval Barang Mutasi</h3>
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
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Jenis Mutasi</label>
                      <select onchange="getApprovalbyDate()" id="selectJenis" class="form-control select2" style="width: 100%;">
                        <option value="MPK">Mutasi Mesin &amp; Peralatan Kantor</option>
                        <option value="MBS">Mutasi Barang Sisa &amp; Scrap</option>
                        <option value="MBJ">Mutasi Barang Jadi</option>
                        <option value="MBB">Mutasi Bahan Baku &amp; Bahan Penolong</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <br><br><br><center><div id="txtMsg"></div></center>
              <div class="col-md-12">
                <table id="tblBCApprovedMutasi" class="table table-bordered table-hover dataTable" role="grid" width="100%">
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
  getApprovalbyDate();  
  function getApprovalbyDate() 
  {
    $.ajax({
          url: "<?php echo base_url();?>ApprovalMutasi/getMutasiForApprovalbyJenisBCDate",
          method:"POST",
          data : { date: $('#txtTanggalTransaksi').val(),jenis:$('#selectJenis').val()},
          success: function (response) 
          {console.log(response);
            var table=$('#tblBCApprovedMutasi').DataTable();table.destroy();
            $('#tblBCApprovedMutasi').html(response);
            $('#tblBCApprovedMutasi').DataTable( {
              "paging":   true,
              "ordering": true,
              "info":     false
            } );

            $('#tblBCApprovedMutasi tbody tr').each(function() {
              if(!$(this).find('#chkApproval').is(':checked'))
              {
                $(this).find('#chkComplete').prop('disabled', true);
              }
            });
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Error: " + errorThrown); 
          }
    });
  }
  function btnApproveBC()
  {
    var arrayObject=[];var arrayObject2=[];
    $('#tblBCApprovedMutasi tbody tr').each(function() {
      if($(this).find('#chkApproval').is(':checked'))//Untuk approve
      {
        var objectMutasi={'IdDetail':$(this).find('#chkApproval').val()};
        arrayObject.push(objectMutasi);
      }
    });
    //console.log(arrayObject);
    if(arrayObject.length==0)
    {alert('Silahkan pilih Mutasi yang akan di approve/di komplitkan');}
    else
    {
      $.ajax({
          url: "<?php echo base_url();?>ApprovalMutasi/updateApproval",
          method:"POST",
          data : { arrayObject: JSON.stringify(arrayObject),arrayObject2: JSON.stringify(arrayObject2)},
          success: function (response) 
          {
            getApprovalbyDate();
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Error: " + errorThrown); 
          }
    });
    }
  }
  $('#txtTanggalTransaksi').datepicker(
  {
      autoclose: true,format: 'dd-mm-yyyy'
  });
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
  function checkApprove(ele)
  {
    var idtable=$(ele).closest('table').attr('id');
    $('#'+idtable+' tbody tr').each(function() 
    {
      var chk=$(this).find('#chkApproval');
      chk.prop('checked', ele.checked);
    });
  }
  // function checkComplete(ele)
  // {
  //   var idtable=$(ele).closest('table').attr('id');
  //   $('#'+idtable+' tbody tr').each(function() 
  //   {
  //     var chk=$(this).find('#chkComplete');
  //     chk.prop('checked', ele.checked);
  //   });
  // }
</script>   