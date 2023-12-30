<?php
if (session_status() === PHP_SESSION_NONE) {
  // Start the session
  session_start();
}

?>

<footer class="main-footer">
    <strong>Copyright &copy; 2022-2024 <a href="https://Bijay.io">Bijay.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
     
    </div>
  </footer>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</div>
<?php
 if(isset($_SESSION['status'])&& $_SESSION['status'] != '')
 {
  ?>
   <script>
     swal(
      {
        title : '<?php echo $_SESSION['status']; ?>',
        icon :   '<?php echo $_SESSION['status_code']; ?>',
        button :"Ok"
      }
     )
   </script>
  <?php
  unset($_SESSION['status']);
 }

?>



</body>
</html>