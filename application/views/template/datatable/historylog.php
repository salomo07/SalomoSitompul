<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<thead style="font-size:12px">
  <tr>
    <th><center>Id User</center></th>
    <th><center>Username</center></th>
    <th><center>Role</center></th>
    <th><center>IP</center></th>
    <th><center>Host</center></th>
    <th><center>Waktu In</center></th>
    <th><center>Waktu Out</center></th>
  </tr>
</thead>
<tbody style="font-size:12px">
  <?php foreach ($dataLogLogin as $key => $detail): ?>
    <tr>  
      <td><center><?php echo $detail->IdUser; ?></center></td>
      <td><center><?php echo $detail->Username; ?></center></td>
      <td><center><?php echo $detail->Role; ?></center></td>
      <td><center><?php echo $detail->IP; ?></center></td>
      <td><center><?php echo $detail->Host; ?></center></td>
      <td><center><?php echo $detail->Waktu_In; ?></center></td>
      <td><center><?php echo $detail->Waktu_Out; ?></center></td>
    </tr>
<?php endforeach ?>
</tbody>