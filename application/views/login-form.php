<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Login | Sistem Informasi </title>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link rel="stylesheet" href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url("public/font-awesome/css/font-awesome.min.css"); ?>">
      <link rel="stylesheet" href="<?php echo base_url("public/ionicons/css/ionicons.min.css"); ?>">
      <link rel="stylesheet" href="<?php echo base_url('public/dist/css/AdminLTE.min.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url('public/plugins/bootstrap-checkbox/awesome-bootstrap-checkbox.min.css'); ?>">
      <link rel="shortcut icon" type="image/png" href="<?php echo base_url("public/image/icon/small-logo.png"); ?>"/>
      <style>
         .login-page { 
            margin-top: -15px;
            height: auto;  
            background: url(<?php echo base_url('public/image/icon/bg-login.jpg'); ?>) no-repeat top fixed;  
           -webkit-background-size: cover;
           -moz-background-size: cover;
           -o-background-size: cover;
           background-size: cover;
         }
         input.form-control { border-radius: 5px; font-size: 1.1em; }
         div.login-box-body { border-radius: 10px;  }
         span.form-control-feedback { background-color: #0093DD; color: white; }
         div.has-feedback > span {  top: 0; left: 0; border-radius: 6px 0px 0px 6px;}
         .padd { padding-left: 40px; }
         .arrow-up {
         width: 0; 
         height: 0; 
         margin:0px 0px 0px 45%; 
         border-left: 10px solid transparent;
         border-right: 10px solid transparent;
         border-bottom: 5px solid white;
         }
         button.btn-login { border-radius: 5px; font-weight:bold; background-color:#0093DD; color: white }
         button.btn-login:hover  { background-color: #2858C4; color: white }
         button.btn-login:focus, button.btn-login:active  { 
         color: white;
         }
         .login-logo { margin-bottom:10px; }
         .logo-width { width: 50%; }
         .lockscreen-footer { font-family: 'Arial', sans-serif; color:#FC9631; }
         span.blue-sipaten { color: #0093DD; }
         .text-red { color: red; }
         .captcha > p { font-size:30px; font-family: sans-serif; font-weight: bold; text-align: center; letter-spacing: 30px; color: #0093DD;  }
         div.box-forgot { padding-top:10px;  }
         a.link-forgot {
            text-decoration: none;
            color: #0093DD;

         }
      div.border{
         border-left: 3pt solid #FF9E02;
         border-right: 3pt solid #FF9E02;
      }
      </style>
   </head>
   <body class="login-page">
      <div class="login-box">
         <div class="login-logo">
            <img width="100%" src="<?php echo base_url("public/image/icon/logo.png"); ?>" alt="Logo Sistem">
         </div>
         <div class="arrow-up"></div>
         <div class="login-box-body border">
            <?php echo $this->session->flashdata('alert'); ?>
            <form action="<?php echo site_url('login?from_url='.$this->input->get('from_url')); ?>" method="post">
               <div class="form-group  has-feedback">
                  <span class="glyphicon glyphicon-user form-control-feedback" style="color: white;"></span>
                  <input type="text" name="nik" class="form-control padd" placeholder="Masukkan NIK" value="<?php echo set_value('nik'); ?>">
                  <?php echo form_error('nik', '<small class="text-red">', '</small>'); ?>
               </div>
               <div class="form-group has-feedback">
                  <span class="glyphicon glyphicon-lock form-control-feedback" style="color: white;"></span>
                  <input type="password" id="login-password" name="password" class="form-control padd" value="<?php echo set_value('password'); ?>" placeholder="Masukkan Password">
                    <div class="checkbox checkbox-success pull-right">
                        <input id="checkbox2" class="styled" type="checkbox" onclick="showpassword()" />
                        <label for="checkbox2">
                            Tampilkan Password
                        </label>
                    </div>
                  <?php echo form_error('password', '<small class="text-red">', '</small>'); ?>
               </div>
               <div class="form-group" style="margin-top: 30px;">
                  <label for="">Kode Captcha :</label>
                  <div class="captcha text-center">
                     <p id="text-captcha"><?php echo $captcha['word']; ?></p>
                  </div>
                  <a href="" id="reload-captcha"><small>Refresh Captcha</small></a>
               </div>
               <div class="form-group has-feedback">
                  <input type="text" class="form-control" name="captcha" placeholder="Kode Captcha" value="<?php echo set_value('captcha'); ?>">
                  <?php echo form_error('captcha', '<small class="text-red">', '</small>'); ?>
               </div>
               <div class="row">
                  <div class="col-xs-12">
                     <button type="submit" class="btn-login btn btn-block">Masuk</button>
                  </div>
                  <div class="col-xs-6 box-forgot pull-right">
                     <a data-toggle="modal" href='#forgot-password' class="link-forgot">Lupa Password?</a>
                  </div>
                  <div class="col-xs-6 box-forgot pull-left">
                     <a href="<?php echo site_url('portal'); ?>" class="link-forgot">Kembali Ke Halaman Utama</a>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <!-- /.login-box -->
      <!-- jQuery 2.2.3 -->
      <script src="<?php echo base_url('public/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
      <!-- Bootstrap 3.3.6 -->
      <script src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js'); ?>"></script>
      <script type="text/javascript">
         $(document).ready(function() {
            $("button#reload-captcha").click(function() {
               $.get("<?php echo site_url("login/captcha_refresh"); ?>", function( data ) 
               {
                  $('#text-captcha').html(data);
               });
            });
         });
         function showpassword() {

            var key_attr = $('#login-password').attr('type');
            if(key_attr != 'text') {
               $('#checkbox2').addClass('show');
               $('#login-password').attr('type', 'text');
            } else {
               $('#checkbox2').removeClass('show');
               $('#login-password').attr('type', 'password');
            }
         };
      </script>
   </body>
</html>

