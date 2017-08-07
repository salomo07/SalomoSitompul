<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('/component/header');?> 
<body id="home">

    <!-- ****************************** Preloader ************************** -->

    <div id="preloader"></div>

    <?php $this->load->view('/component/sidebarmenu');?>
    <?php $this->load->view('/component/headermenu');?>
    <?php $this->load->view('/component/banner');?>
    <?php $this->load->view('/component/skills');?>
    <?php $this->load->view('/component/projects');?>
    <?php $this->load->view('/component/workexperience');?>
    <?php $this->load->view('/component/about');?>
    <?php $this->load->view('/component/contact');?>


    <section id="footer">
        <section class="container">
            <section class="row">
                <div class="col-sm-12">
                    <p class="copyright">Salomo Sitompul &copy; Copyright Reserved 2017</p>
                </div>
            </section>
        </section>
    </section>

    <?php $this->load->view('/component/script');?>
    
    
</body>
</html>
