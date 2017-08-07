<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<thead style="font-size:12px">
  <tr>
    <th><center>Id Role</center></th>
    <th><center>Role</center></th>                    
    <th><center>Keterangan</center></th>
  </tr>
</thead>
<tbody style="font-size:12px">
  <?php foreach ($dataRole as $key => $detail): ?>
    <tr onclick="rowClick(this)">  
      <td><center><?php echo $detail->IdRole;?></center></td>
      <td><center><?php echo $detail->Role;?></center></td>
      <td><center><?php echo $detail->Keterangan;?></center></td>
    </tr>
<?php endforeach ?>
</tbody>