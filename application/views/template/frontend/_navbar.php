   <!-- menu start -->
   <div class="menu_side">
       <div id="navbar_menu">
           <ul class="first-ul">
               <li>
                   <a href="<?= base_url('frontend/home') ?>">Home</a>
               </li>
               <li><a href="<?= base_url('peta_persebaran   ') ?>">Peta Persebaran</a></li>
               <?php if ($this->session->userdata('logged_in')) {  ?>
                   <li><a href="<?= base_url('home') ?>">User Panel</a></li>
               <?php } else { ?>
                   <li><a href="<?= base_url('auth/login') ?>">Login</a></li>
               <?php } ?>
           </ul>
       </div>
   </div>
   <!-- menu end -->