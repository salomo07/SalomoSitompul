<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Edit User</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>NIK</label>
          <input id="txtNIK" type="number" onkeyup="this.value = this.value.replace(/\D/, '')" class="form-control" placeholder="NIK (Number only)" value="<?php echo $dataUser->Nik; ?>" disabled>
        </div>
        <div class="form-group">
          <label>Username</label>
          <input id="txtUsername" type="text" class="form-control" placeholder="Username" value="<?php echo $dataUser->Username; ?>" disabled>
        </div>      
        <div class="form-group">
          <label>Fullname</label>
          <input id="txtFullname" type="text" class="form-control" placeholder="Fullname" value="<?php echo $dataUser->Fullname; ?>">
        </div>
        <div class="form-group">
          <label>Role</label>
          <select class="form-control" id="selectRole">
            <?php foreach ($dataRole as $key => $value): ?>
              <option value="<?php echo $value->IdRole; ?>" <?php if($dataUser->IdRole==$value->IdRole){echo 'selected';} ?>><?php echo $value->Role; ?></option>
            <?php endforeach ?>          
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button id="btnEditUser" onclick="EditUser();" type="button" class="btn btn-danger">Save Changes</button>
      </div>
  </div>
</div>
<script>
  function EditUser(fullname, role)
  {
    if($('#txtNIK').val()==''||$('#txtUsername').val()==''||$('#txtFullname').val()=='')
    {
      alert('Silahkan lengkapi data yang diperlukan');
    }
    else
    {
      $.ajax({
          url: "<?php echo base_url();?>Master_User/editUser",
          method:"post",
          data : { id:<?php echo $dataID;?>,fullname:''+$('#txtFullname').val(),role:$('#selectRole').val()},
          success: function (response) 
          {
            $('#myModal').modal('hide');getUser();operation='';alert('Data User berhasil diubah.');
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Error: " + errorThrown); 
          }
      });
    }
    
  }
</script>