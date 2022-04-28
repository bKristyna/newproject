<html>
  <body>
    <form method="post" action="send_link.php">
      <p>Enter Email Address To Send Password Link</p>
      <input type="text" name="email">
      <input type="submit" name="submit_email">
    </form>
  </body>
</html>

<?php
include ('connect.php');
if($_GET['key'] && $_GET['reset'])
{
  $email=$_GET['key'];
  $pass=$_GET['reset'];
  
  $select=mysqli_query ($conn,"select email,password from user where md5(email)='$email' and md5(password)='$pass'");
  if(mysqli_num_rows($select)==1)
  {
?>
    <form method="post" action="submit_new.php">
    <input type="hidden" name="email" value="<?php echo $email;?>">
    <p>Enter New password</p>
    <input type="password" name='password'>
    <input type="submit" name="submit_password">
    </form>
    
  <?php }
}
?>