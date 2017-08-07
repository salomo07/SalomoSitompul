<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Delete Role</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>ID Role</label>
          <input id="txtIDRole" type="text" class="form-control" value="<?php echo $dataRole->IdRole;?>" disabled>
        </div>
        <div class="form-group">
          <label>Nama Role</label>
          <input id="txtRole" type="text" onkeyup="cekRoleSama(this.value)" class="form-control" placeholder="Role Name (Unique)" value="<?php echo $dataRole->Role;?>" disabled>
        </div>      
        <div class="form-group">
          <label>Keterangan</label>
          <textarea id="txtKeterangan" class="form-control" placeholder="Keterangan Role" disabled><?php echo $dataRole->Keterangan;?></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button id="btnEditRole" onclick="DeleteRole($('#txtIDRole').val())" type="button" class="btn btn-danger">Delete Role</button>
      </div>
  </div>
</div>
<script>
  function DeleteRole(id)
  {
    $.ajax({
        url: "<?php echo base_url();?>Master_Role/deleteRole",
        method:"POST",
        data : {id:id},
        success: function (response) 
        {
          $('#myModal').modal('hide'); getRole();operation='';
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          alert("Error: " + errorThrown); 
        }
    });
  }
</script>