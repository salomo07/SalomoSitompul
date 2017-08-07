<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PSG IT Inventory</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php $this->load->view('/template/link');?>  
  <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
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
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Master Role</h3>
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
          <table id="tblRole" class="table table-bordered table-hover dataTables" role="grid" aria-describedby="example_info" width="100%">
              <thead>
                  <tr>
                      <th><center>Id Role</center></th>
                      <th><center>Role</center></th>                    
                      <th><center>Keterangan</center></th>
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
        <div class="box-footer">
          <div class="col-md-12">
            <div class="col-md-4"><button id="btnAddRole" onclick="getModalAddRole()" class="btn btn-danger btn-block">Add Role</button></div>
            <div class="col-md-4"><button id="btnEditRole" onclick="alert('Silahkan pilih Data Role yang akan diubah.');operation='Edit';" class="btn btn-danger btn-block">Edit Role</button></div>
            <div class="col-md-4"><button id="btnDeleteRole" onclick="alert('Silahkan pilih Data Role yang akan diubah.');operation='Delete';" class="btn btn-danger btn-block">Delete Role</button></div>
          </div>
        </div>
      </div>
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Master Akses Menu</h3>
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
          <table id="tblAksesMenu1" class="table table-bordered table-hover dataTables"  role="grid" aria-describedby="example_info" width="100%">
              <thead>
                  <tr>
                      <th><center>Id Role</center></th>
                      <th><center>Role</center></th>                    
                      <th><center>Keterangan</center></th>
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
          <br>
          <div class="col-md-12">            
            <div class="col-md-12"><center><label>Tambah Akses Menu</label></center></div>
            <div class="col-md-9">
              <div class="col-md-6">
                <select class="form-control select2" id="selectRoleAkses">
                  <option value="">--Silahkan pilih Role--</option>
                  <?php foreach ($dataRole as $key => $value): ?>
                    <option value="<?php echo $value->IdRole; ?>"><?php echo $value->Role; ?></option>
                  <?php endforeach ?>          
                </select>
              </div>
              <div class="col-md-6">
                <select class="form-control select2" id="selectMenuAkses" >
                  <option value="">--Silahkan pilih Menu--</option>
                  <?php foreach ($dataNamaMenu as $key => $value): ?>
                    <option value="<?php echo $value->IdMenu; ?>"><?php echo $value->NamaMenu; ?></option>
                  <?php endforeach ?>          
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <button id="btnAddMenubyUser" onclick="addAksesMenu()" class="btn btn-block btn-default ">Add Akses Menu</button>
            </div>
          </div>
          <div class="col-md-12">   <br>         
            <div class="col-md-12"><center><label>Tambah Akses SubMenu</label></center></div>
            <div class="col-md-3">
              <select class="form-control select2" id="selectRoleAkses2">
                <option value="">--Silahkan pilih Role--</option>
                <?php foreach ($dataRole as $key => $value): ?>
                  <option value="<?php echo $value->IdRole; ?>"><?php echo $value->Role; ?></option>
                <?php endforeach ?>          
              </select>
            </div>
            <div class="col-md-3">
              <select onchange="getSubMenuAkses(this.value)" class="form-control select2" id="selectMenuAkses2" >
                <option value="">--Silahkan pilih Menu--</option>
                <?php foreach ($dataNamaMenu as $key => $value): ?>
                  <option value="<?php echo $value->IdMenu; ?>"><?php echo $value->NamaMenu; ?></option>
                <?php endforeach ?>          
              </select>
            </div>
            <div class="col-md-3">
              <select class="form-control select2" id="selectSubMenuAkses2" >
                <option value="">--Silahkan pilih SubMenu--</option>
                <?php foreach ($dataNamaSubMenu as $key => $value): ?>
                  <option value="<?php echo $value->IdMenu; ?>"><?php echo $value->NamaMenu; ?></option>
                <?php endforeach ?>          
              </select>
            </div>
            <div class="col-md-3">
              <button id="btnAddMenubyUser" onclick="addAksesSubMenu()" class="btn btn-block btn-default ">Add Akses SubMenu</button>
            </div>
          </div>
        </div>
        </div>
        <div class="box-footer">
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
<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>


<script> 
getRole();
getAksesMenu();
operation='';

function getRole()
{ 
  $('#txtMsg').html('Sedang memuat data...');
  $.ajax({
        url: "<?php echo base_url();?>Master_Role/getRole",
        success: function (response) 
        {
          var table=$('#tblRole').DataTable();table.destroy();
          $('#tblRole').html(response);
          $('#tblRole').DataTable( {
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
function getAksesMenu()
{ 
  $('#txtMsg').html('Sedang memuat data...');
  $.ajax({
        url: "<?php echo base_url();?>Master_Role/getAksesMenu",
        success: function (response) 
        {
          var table=$('#tblAksesMenu1').DataTable();table.destroy();
          $('#tblAksesMenu1').html(response);
          $('#tblAksesMenu1').DataTable( {
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
function getModalAddRole()
{
  $.ajax({
        url: "<?php echo base_url();?>Master_Role/getModalAddRole",
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
function getModalEditRole(idRole)
{
  $.ajax({
        url: "<?php echo base_url();?>Master_Role/getModalEditRole",
        method:"POST",
        data : { idRole: idRole},
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
function getModalDeleteRole(idRole)
{
  $.ajax({
        url: "<?php echo base_url();?>Master_Role/getModalDeleteRole",
        method:"POST",
        data : { idRole: idRole},
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
    getModalEditRole($(element).find('td').eq(0).text());
  }
  if(operation=='Delete')
  {  
    getModalDeleteRole($(element).find('td').eq(0).text());
  }
}
function getSubMenuAkses(val)
{  
  $.ajax({
        url: "<?php echo base_url();?>Master_Role/getSubMenu",
        method:"POST",
        data : { 'idmenu': val},
        dataType:"json",
        success: function (response) 
        {
          var html='';
          for (var i =0; i < response.length; i++) 
          {
             html=html+'<option value="'+response[i].IdMenu2+'">'+response[i].NamaMenu2+'</option>';
          }
          $('#selectSubMenuAkses2').html('');
          $('#selectSubMenuAkses2').html(html);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
  });
}
function addAksesSubMenu()
{
  var role=$('#selectRoleAkses2').val();
  var menu=$('#selectMenuAkses2').val();
  var submenu=$('#selectSubMenuAkses2').val();
  if(role==''||menu==''||submenu==''){alert('Silahkan pilih role & menu akses & sub menu yang akan diakses.');}
  else
  {
    $.ajax({
          url: "<?php echo base_url();?>Master_Role/addAksesSubMenu",
          method:"POST",
          data : { role: role,menu:menu,submenu:submenu},
          success: function (response) 
          {
            if(response=='sama'){alert('Maaf Role & Menu yang diakses sudah ditambahkan sebelumnya');}
            else
            {
              alert('Akses SubMenu telah berhasil ditambahkan.');
              getAksesMenu();
            }
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Error: " + errorThrown); 
          }
    });
  }
}
function addAksesMenu()
{
  var role=$('#selectRoleAkses').val();
  var menu=$('#selectMenuAkses').val();
  if(role==''||menu==''){alert('Silahkan pilih role & menu akses.');}
  else
  {
    $.ajax({
          url: "<?php echo base_url();?>Master_Role/addAksesMenu",
          method:"POST",
          data : { role: role,menu:menu},
          success: function (response) 
          {
            if(response!=''){alert('Maaf Role & Menu yang diakses sudah ditambahkan sebelumnya');}
            else
            {
              getAksesMenu();
            }
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Error: " + errorThrown); 
          }
    });
  }
}
$(".select2").select2();
</script>   