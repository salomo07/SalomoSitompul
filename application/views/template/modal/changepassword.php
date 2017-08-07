<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Old Password</label>
          <input id="txtId" type="hidden" value="<?php echo $idUser;?>" class="form-control" placeholder="Password lama">
          <input id="txtOld" type="password" class="form-control" placeholder="Password lama">
        </div>      
        <div class="form-group">
          <label>New Password</label>
          <input id="txtNew" type="password" class="form-control" placeholder="Password baru">
        </div>
        <div class="form-group">
          <label>Verify Password</label>
          <input id="txtVerify" type="password" class="form-control" placeholder="Ulangi password baru">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button id="btnChangePassword" onclick="changepassword($('#txtOld').val(), $('#txtNew').val(), $('#txtVerify').val(),$('#txtId').val())" type="button" class="btn btn-danger">Change Password</button>
      </div>
  </div>
</div>
<script>
  function changepassword(old, newpass, verify,id)
  {
    if(verify!=newpass)
      {alert('Password baru yang anda masukkan tidak sama');}
    else
    {
      $.ajax({
              url: "<?php echo base_url();?>Home/changePassword",
              method:"POST",
              data : {id:id, old:old,newpass: newpass},
              success: function (response) 
              {
                console.log(response);
                if(response=='Password lama salah'){alert(response);}
                else{$('#myModal').modal('hide'); alert('Password berhasil diubah.');}
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Error: " + errorThrown); 
              }
          });
    }
  }
</script>