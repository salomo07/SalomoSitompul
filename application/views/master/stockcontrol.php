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
          <h3 class="box-title">Stock Control</h3>
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
          <div class="form-group">
          <label>Tanggal Transaksi :</label>
          <div class="radio" id="rgSwitchSumber" onchange="rgSwitchSumberChange()">
            <form>
              <label>
                <input type="radio" name="rgSwitchSumber" id="optionradioOff" value="produk" checked="">
                Master Product
              </label>
              <label> </label>
              <label>
                <input type="radio" name="rgSwitchSumber" value="item" id="optionradioOn">
                Master Item
              </label>
              <label></label>
            </form>
          </div>
          <table id="tblStockControl" class="table table-bordered table-hover dataTable"  role="grid" aria-describedby="example_info" width="100%">
            <thead>
              <tr>
                <th><center>Id Item / Id Product</center></th>
                <th><center>Nama / Deskripsi</center></th>                   
                <th><center>Stock Update</center></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>
        <div class="box-footer">
          <div class="col-md-12">
            <div class="col-md-4"><button id="btnAddStock" onclick="addStock()" class="btn btn-danger btn-block">Add Stock</button></div>
            <div class="col-md-4"><button id="btnEditUser" onclick="alert('Silahkan pilih Data User yang akan diubah.');operation='Edit';" class="btn btn-danger btn-block">Edit Stock</button></div>
            <div class="col-md-4"><button id="btnDeleteUser" onclick="alert('Silahkan pilih Data User yang akan dihapus.');operation='Delete';" class="btn btn-danger btn-block">Delete Stock</button></div>
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
<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
<script> 
getStockControl();
getUnionIdItem();
operation='';
var selectIdItem='';
var arrayObject='';
function getStockControl()
{
  $('#txtMsg').html('Sedang memuat data...');
  $.ajax({
        url: "<?php echo base_url();?>Stock_Control/getStockControl",
        dataType:'JSON',
        success: function (response) 
        {
          var html='';$('#tblStockControl tbody').html('');
          for (var i = 0; i < response.length; i++) 
          {
            html=html+'<tr><td><input type="hidden" id="txtId" value="'+response[i].Id+'"><center>'+response[i].IdItem+'</center></td><td><center>'+response[i].NamaItem+'</center></td><td><center>'+response[i].StokAwal+'</center></td></tr>';            
          }
          if(response.length==0){$('#tblStockControl tbody').html('<tr><td></td><td></td></tr>');}
          else{$('#tblStockControl tbody').html(html);}
          $('#txtMsg').html('');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
  });
}
function rgSwitchSumberChange()
{
  getUnionIdItem();
}
function getUnionIdItem()
{
  var sumber='';
  if($("input[name='rgSwitchSumber']:checked").val()=='produk')
  {
    sumber='Product';
  }
  else
  {
    sumber='Item';
  }
  $('#selectIdItem').html('');
  $.ajax({
        url: "<?php echo base_url();?>Stock_Control/getUnionIdItem",
        dataType:'JSON',
        method:'POST',
        data:{'sumber':sumber},
        success: function (response) 
        {
          arrayObject=response;
          selectIdItem='<select id="selectIdItem" class="form-control select2" onchange="getNameItemFull()"> ';
          for (var i = 0; i < response.length; i++) 
          {
            selectIdItem=selectIdItem+'<option value="'+response[i].ItemID+'">'+response[i].ItemID+'</option>';            
          }
          selectIdItem=selectIdItem+'</select>';
          $('#txtMsg').html('');
          $('#selectIdItem').html(selectIdItem);
          getNameItemFull();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
  });
}
function addStock()
{
  if($('#btnAddStock').text()!='Save')
  {
    $('#tblStockControl tbody tr:last').after('<tr><td><center>'+selectIdItem+'</center></td><td><center><input class="form-control" type="text" id="txtNama" placeholder="Nama" disabled></center></td><td><center><input class="form-control" type="text" id="txtQty" placeholder="Qty Stock"></center></td></tr><script>$(".select2").select2();<'+'/script>');
    $('#btnAddStock').text('Save');
  }
  else
  {
    $.ajax({
        url: "<?php echo base_url();?>Stock_Control/insertStockControl",
        method:"POST",
        data : { iditem: $('#selectIdItem').val(),'stok':$('#txtQty').val()},
        success: function (response) 
        {console.log(response);
          getStockControl();$('#btnAddStock').text('Add Stock');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
  });
  }
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
function getNameItemFull()
{
  for (var i = 0; i < arrayObject.length; i++) 
  {
    if(arrayObject[i].ItemID==$('#selectIdItem').val())
    {
      $('#txtNama').val(arrayObject[i].Name);
    }
  }
}
</script>  
