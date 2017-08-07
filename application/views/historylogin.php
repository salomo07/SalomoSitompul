<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PSG IT Inventory</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php $this->load->view('/template/link');?>  
  <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
</head>
<link rel="stylesheet" href="assets/plugins/jQueryUI/jquery-ui.css">
<style type="text/css">
.ui-autocomplete {
    max-height: 200px;
    overflow-y: auto;
    overflow-x: hidden;
  }
</style>
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
          <div class="box" style="border-top-color: #ff9933" ;="">
            <div class="box-header with-border">
              <h3 class="box-title">History of Login</h3>
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
                    <label>Date range:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="rangeLogLogin" onchange="getHistoryLogin()"></input>
                    </div>
                  </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Username</label><br>
                      <input class="form-control" id="txtSearchUsername" onkeyup="searchUsername(this.value)" placeholder="Username">
                    </div>
                  </div>
                </div>
              </div>
              <br><br><br><center><div id="txtMsg"></div></center>
              <div class="col-md-12" style="overflow: auto;">
                <table id="tblHistoryLog" class="table table-bordered table-hover dataTable" role="grid" width="100%">
                  <thead>
                    <tr>
                      <th><center>Id User</center></th>
                      <th><center>Username</center></th>
                      <th><center>Role</center></th>
                      <th><center>IP</center></th>
                      <th><center>Host</center></th>
                      <th><center>Waktu In</center></th>
                      <th><center>Waktu Out</center></th>
                      <th><center>Token</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
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
            <div class="box-footer">
              <div class="col-md-12">
                <div class="col-md-6"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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

<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jQueryUI/jquery-ui.min.js"></script>
<script>
  var start = moment().subtract(30, 'days');
  var end = moment();

  function cb(start, end) 
  {
    $('#rangeLogLogin').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
  }

  $('#rangeLogLogin').daterangepicker({
      locale: {
        format: 'DD-MM-YYYY'
      },
      startDate: start,
      endDate: end,
      ranges: {
         'Today': [moment(), moment()],
         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         'Last 7 Days': [moment().subtract(6, 'days'), moment()],
         'Last 30 Days': [moment().subtract(30, 'days'), moment()],
         'This Month': [moment().startOf('month'), moment().endOf('month')],
         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
  }, cb);
  cb(start, end);
  function getHistoryLogin()
  {    
    $.ajax({
      url: "<?php echo base_url();?>HistoryLogin/getHistoryLogin",
      method:"POST",
      data : {range:$('#rangeLogLogin').val(),username:$('#txtSearchUsername').val()},
      success: function (response) 
      {
        console.log(response);
        var table=$('#tblHistoryLog').DataTable();table.destroy();
          $('#tblHistoryLog').html(response);
          $('#tblHistoryLog').DataTable( {
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
  function searchUsername(element)
  {
    $.ajax({
      url: "<?php echo base_url();?>HistoryLogin/getUsername",
      method:"POST",
      dataType:'JSON',
      data : {key:element},
      success: function (response) 
      {
        var username=[];
        for (var i = 0; i < response.length; i++) 
        {
          username.push(response[i].Username);
        }
        $('#txtSearchUsername').autocomplete({
          source: username,
          select: function (a, b) {
            getHistoryLogin();
          }
        }); 
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Error: " + errorThrown); 
      }
    });
  }
</script>
 