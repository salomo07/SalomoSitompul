<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Add Role</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Role</label>
          <input id="txtRole" onchange="cekRoleSama(this.value)" type="text" class="form-control" placeholder="Role Name (Unique)">
        </div>
        <div class="form-group">
          <label>Departemen</label>
          <select class="form-control select2" id="selectDept">
            <?php echo '<option value="">---</option>'; ?>
            <?php foreach ($dept as $key => $value): ?>
              <?php echo '<option value="'.$value->Id.'">'.$value->DeptName.'</option>'; ?>
            <?php endforeach ?>
          </select>
        </div>      
        <div class="form-group">
          <label>Keterangan</label>
          <textarea id="txtKeterangan" class="form-control" placeholder="Keterangan Role"></textarea>
        </div>
        <div class="form-group"><input id="chkKepala" type="checkbox">  Kepala bagian</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button id="btnSaveRole" onclick="InsertNewRole($('#txtRole').val(), $('#txtKeterangan').val())" type="button" class="btn btn-danger">Save New Role</button>
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
              {//console.log(response);
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
  function InsertNewRole(role, keterangan)
  {console.log($('#selectDept').val());
    if($('#selectDept').val()==''){alert('Silahkan pilih nama departemen...');}
    else{
    $.ajax({
              url: "<?php echo base_url();?>Master_Role/insertRole",
              method:"POST",
              data : { role:role,keterangan: keterangan,kepala:$('#chkKepala').is(':checked'),'dept':$('#selectDept').val()},
              success: function (response) 
              {//console.log(response);
                $('#myModal').modal('hide'); getRole();operation='';
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Error: " + errorThrown); 
              }
          });
    }
  }
</script>