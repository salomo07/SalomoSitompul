<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PSG IT Inventory</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php $this->load->view('/template/link');?>  
  <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
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
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Master User</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body" style="overflow: auto;">
        <br><center><div id="txtMsg"></div></center>
        <div class="col-md-12">
          <table id="tblUser" class="table table-bordered table-hover dataTable"  role="grid" aria-describedby="example_info" width="100%">
              <thead>
                  <tr>
                      <th><center>Id User</center></th>
                      <th><center>Nik</center></th>                    
                      <th><center>Username</center></th>
                      <th><center>Fullname</center></th>
                      <th><center>Role</center></th>
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
            <div class="col-md-4"><button id="btnAddUser" onclick="getModalAddUser()" class="btn btn-danger btn-block">Add User</button></div>
            <div class="col-md-4"><button id="btnEditUser" onclick="alert('Silahkan pilih Data User yang akan diubah.');operation='Edit';" class="btn btn-danger btn-block">Edit User</button></div>
            <div class="col-md-4"><button id="btnDeleteUser" onclick="alert('Silahkan pilih Data User yang akan dihapus.');operation='Delete';" class="btn btn-danger btn-block">Delete User</button></div>
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

<script> 
getUser();
operation='';
function getUser()
{
  $('#txtMsg').html('Sedang memuat data...');
  $.ajax({
        url: "<?php echo base_url();?>Master_User/getUser",
        success: function (response) 
        {
          var table=$('#tblUser').DataTable();table.destroy();
          $('#tblUser').html(response);
          $('#tblUser').DataTable( {
            "paging":   true,
            "ordering": true,
            "info":     false
          } );
          $('#txtMsg').html('');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
  });
}
function getModalAddUser()
{ 
  $.ajax({
        url: "<?php echo base_url();?>Master_User/getModalAddUser",
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
function getModalEditUser(idUser)
{ 
  $.ajax({
        url: "<?php echo base_url();?>Master_User/getModalEditUser",
        method:"POST",
        data : { idUser: idUser},
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
function getModalDeleteUser(idUser)
{
  $.ajax({
        url: "<?php echo base_url();?>Master_User/getModalDeleteUser",
        method:"POST",
        data : { idUser: idUser},
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
function rowClick(element)
{
  if(operation=='Edit')
  {    
    getModalEditUser($(element).find('td').eq(0).text());
  }
  if(operation=='Delete')
  {  
    getModalDeleteUser($(element).find('td').eq(0).text());
  }
}
</script>  
