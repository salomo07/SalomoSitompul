<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<thead style="font-size:13px">
  <tr>
    <th><center>Id User</center></th>
    <th><center>Nik</center></th>                    
    <th><center>Username</center></th>
    <th><center>Fullname</center></th>
    <th><center>Role</center></th>
  </tr>
</thead>
<tbody style="font-size:13px">
  <?php foreach ($dataUser as $key => $detail): ?>
    <tr onclick="rowClick(this)">  
      <td><?php echo $detail->Id;?></td>
      <td><center><?php echo $detail->Nik;?></center></td>
      <td><center><?php echo $detail->Username;?></center></td>
      <td><center><?php echo $detail->Fullname;?></center></td>
      <td><center><?php echo $detail->Role;?></center></td>
    </tr>
<?php endforeach ?>
</tbody>