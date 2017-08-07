<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Add User</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>NIK</label>
          <input id="txtNIK" type="number" onkeyup="this.value = this.value.replace(/\D/, '')" class="form-control" placeholder="NIK (Number only)">
        </div>
        <div class="form-group">
          <label>Username</label>
          <input id="txtUsername" type="text" class="form-control" placeholder="Username">
        </div>      
        <div class="form-group">
          <label>Fullname</label>
          <input id="txtFullname" type="text" class="form-control" placeholder="Fullname">
        </div>
        <div class="form-group">
          <label>Role</label>
          <select class="form-control" id="selectRole">
            <?php foreach ($dataRole as $key => $value): ?>
              <option value="<?php echo $value->IdRole; ?>"><?php echo $value->Role; ?></option>
            <?php endforeach ?>          
          </select>
        </div>
        Default Password : 12345 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button id="btnSaveUser" type="button" class="btn btn-danger">Save New User</button>
      </div>
  </div>
</div>
<script>
  $('#btnSaveUser').on('click', function() 
  {
    if($('#txtNIK').val()==''||$('#txtUsername').val()==''||$('#txtFullname').val()=='')
    {
      alert('Silahkan lengkapi data yang diperlukan');
    }
    else if(cekUsernameSama($('#txtUsername').val())=='1')
    {
      alert('Username yang anda pilih sudah digunakan. Silahkan masukkan Username baru.');
    }
    else
    {
      InsertNewUser($('#txtNIK').val(),$('#txtUsername').val(),$('#txtFullname').val(),$('#selectRole').val());
    }
  });
  function cekUsernameSama(username)
  {
    var hasil='';
    $.ajax({
              url: "<?php echo base_url();?>Master_User/cekUsernameSama",
              method:"POST",
              data : { username: username},
              async: false,
              success: function (response) 
              {
                hasil=response;
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Error: " + errorThrown); 
              }
          });
    return hasil;
  }
  function InsertNewUser(nik, username, fullname, role)
  {
    var hasil='';
    $.ajax({
              url: "<?php echo base_url();?>Master_User/insertUser",
              method:"POST",
              data : { nik:nik,username: username,fullname:fullname,role:role},
              success: function (response) 
              {
                $('#myModal').modal('hide'); getUser();operation='';
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Error: " + errorThrown); 
              }
          });
    return hasil;
  }
</script>