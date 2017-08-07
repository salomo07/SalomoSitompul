<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Edit Role</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>ID Role</label>
          <input id="txtIDRole" type="text" class="form-control" value="<?php echo $dataRole->IdRole;?>" disabled>
        </div>
        <div class="form-group">
          <label>Nama Role</label>
          <input id="txtRole" type="text" onkeyup="cekRoleSama(this.value)" class="form-control" placeholder="Role Name (Unique)" value="<?php echo $dataRole->Role;?>">
        </div>      
        <div class="form-group">
          <label>Keterangan</label>
          <textarea id="txtKeterangan" class="form-control" placeholder="Keterangan Role"><?php echo $dataRole->Keterangan;?></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button id="btnEditRole" onclick="EditRole($('#txtIDRole').val(), $('#txtRole').val(),$('#txtKeterangan').val())" type="button" class="btn btn-danger">Save New Role</button>
      </div>
  </div>
</div>
<script>
  function cekRoleSama(role)
  {
    $.ajax({
              url: "<?php echo base_url();?>Master_Role/cekRoleSama",
              method:"POST",
              data : { role: role},
              async: false,
              success: function (response) 
              {
                if(response=='1')
                {
                  alert('Nama Role tidak boleh sama.');
                }
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Error: " + errorThrown); 
              }
          });
  }
  function EditRole(id,role, keterangan)
  {
    $.ajax({
        url: "<?php echo base_url();?>Master_Role/editRole",
        method:"POST",
        data : {id:id, role:role,keterangan: keterangan},
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