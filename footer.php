<div id="footer">
   <div class="inner">


      <nav class="footer_list">	 
      <?php session_start();?>
         <?php if(isset($_SESSION['userNumber']) || isset($_COOKIE['userNumber'])) { ?>
            <ul class="f-list">
               <li><a href="service_int.php">서비스소개</a></li>
               <li><a href="c-service.php">FAQ</a></li>	
            </ul>
         <?php } ?>
         <p class="copyright">Copyright &copy; 2001-2013 HOLLER. All Rights Reserved.</p>
      </nav>

   </div>
</div>