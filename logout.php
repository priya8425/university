
  <?php
  session_start();
  echo "<script type='text/javascript'>alert('logout sucessfully!');
  window.location.href='admin/pages/examples/login.php';</script>";
   session_destroy(); 
   
   ?>
   