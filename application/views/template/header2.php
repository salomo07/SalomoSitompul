<header class="main-header">
    <a href="<?php echo base_url();?>" class="logo">
      <span class="logo-mini"><img alt="Brand" height="50" width="50" src="assets/img/PSG.png"></span>
      <span class="logo-lg">IT Inventory</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      </a>
      <?php
        $CI =& get_instance();
        $CI->load->model('m_login');
        ?>
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <?php foreach ($daftarmenu as $key => $menu): ?>
            <li><?php echo $menu->IconMenu;?>
              <?php  $daftarmenu2=$CI->m_login->getSubMenuHeader($menu->IdRole,$menu->IdMenu); if (count($daftarmenu2>0)): ?>
                <ul class="dropdown-menu" role="menu">
                  <?php  foreach ($daftarmenu2 as $key => $menu2): ?>
                    <li><?php echo $menu2->IconMenu2; ?></li>
                  <?php endforeach ?>
                </ul>
              <?php endif ?>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="assets/img/PSG.png" style="height: 15px; width:20px;" alt="PSG Logo">
              <span class="hidden-xs"><?php echo $arrayDataUser->Username.' ('.$arrayDataUser->Role.')'; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="assets/img/PSG.png" style="height: 90px; width:90px;" alt="User Image">

                <p>
                  <?php echo $arrayDataUser->Username.' ('.$arrayDataUser->Role.')'; ?>
                </p>
              </li>
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-12 text-center">
                    <a onclick="getPasswordChange(this)" value="<?php echo $arrayDataUser->IdUser;?>">Change Password</a>
                  </div>
                </div>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url().'Home/signout'?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <li>
            <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
          </li> 
        </ul>
      </div>
    </nav>
  </header>
  <script>
    function getPasswordChange(element) 
    {
      $.ajax({
            url: "<?php echo base_url();?>Home/getModalChangePassword",
            method:"POST",
            data : { idUser: $(element).attr('value')},
            success: function (response) 
            {
              $('#myModal').html(response);
              $('#myModal').modal('show');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
              alert("Error: " + errorThrown); 
            }
      });
    }
  </script>