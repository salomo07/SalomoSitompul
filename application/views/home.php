<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PSG IT Inventory</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php $this->load->view('/template/link');?>  
  <!-- <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css"> -->
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
      <!-- <?php if ($info==true): ?>
      <div class="col-md-12">
        <center><label>Info : Kolom No SKEP & Tgl SKEP sudah ditiadakan, sebagai gantinya data tersebut dapat diinput didalam kolom Keterangan</label></center><br>
        <center><label>Note : Kolom No Pabean tidak boleh mengandung tulisan petik (') atau (")</label></center>
      </div>
      <div class="col-md-12">        
        <div class="col-md-12" style="overflow: auto;"><center><img src="<?php echo base_url();?>assets/img/Transaksi IT Inventory.PNG" usemap="#KH"></center>
        </div>
      </div>
      <?php endif ?> -->
    </section>
  </div>

  <footer class="main-footer">
    <center>Copyright &copy; PT. PSG 2016.</center>
  </footer>
  <div id="myModal" class="modal fade" tabindex="-1" role="dialog"></div>
<div class="control-sidebar-bg"></div>
</div>
</body>
</html>
<?php $this->load->view('/template/script');?> 

<!-- <script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script> -->
<script>
  var ipuser='<?php echo $ipuser ?>';console.log(ipuser.search('192.168.'));
  var res = ipuser.search('192.168.');
  if(res.length>=0){$('#ahCCTV').attr('href','https://192.168.2.12:7070');$('#aaCCTV').attr('href','https://192.168.2.12:7070');}
  else {$('#ahCCTV').attr('href','https://222.124.139.235:7070/');$('#aaCCTV').attr('href','https://222.124.139.235:7070/');}
</script>
 