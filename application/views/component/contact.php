<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section id="contact">
    <section class="container contact-wrap">
        <section class="row">
            <div class="title-box"><h1 class="block-title wow animated rollIn">
            <span class="bb-top-left"></span>
            <span class="bb-bottom-left"></span>
            Contact
            <span class="bb-top-right"></span>
            <span class="bb-bottom-right"></span>
            </h1></div>
        </section>
    </section>
    <section class="address">
        <div class="container">
            <div class="col-sm-12">
                <ul class="address-list">
                    <li><i class="ion-ios-location" style="background-color: rgb(255, 102, 0);"></i> <span>RT 03 Purwosari. Village Penerokan. Districts Bajubang. Regency Batanghari. Province Jambi.<br> Zip Code : 36611</span></li>
                    <li><i class="ion-ios-telephone" style="background-color: #63cfea;"></i> <span>+6281288643757</span></li>
                    <li><i class="ion-email" style="background-color: #6ecba9;"></i> <span>sitompulsalomo@gmail.com</span></li>
                    <li><i class="ion-earth" style="background-color: #ff6969;"></i> <span><a href="http://www.salomositompul.com/">www.salomositompul.com</a></span></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="mailbox">
        <div class="container">
            <div class="col-sm-12">
                <!-- <form name="sentMessage" id="contactForm" novalidate> -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea class="form-control" style="height: 150px" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                                <div id="success"></div>
                                <button type="submit" onclick="sentMessage()" class="btn btn-default btn-block" ><i class="ion-paper-airplane"></i></button>
                            </div>
                        </div>
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
</section>
<script>
    function sentMessage() 
    {
        if($('#name').val()==''||$('#email').val()==''||$('#phone').val()==''||$('#message').val()=='')
        {
            alert('Silahkan lengkapi inputan terlebih dahulu');
        }
        else
        {
            var obj={name:$('#name').val(),email:$('#email').val(),phone:$('#phone').val(),message:$('#message').val()}
            $.ajax({
              url: "<?php echo base_url();?>Home/sendMessage",
              method:"POST",
              data : { obj:obj },
              success: function (response) 
              {
                console.log(response)
                alert('Pesan anda telah tersimpan, terimakasih')
                location.reload();
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) 
              { 
                alert("Error: " + errorThrown); 
              }
          });
        }
    }
</script>