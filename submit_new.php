<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<body>
  
</body>
</html>

<div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
      </div>
      <div class="back">
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
          <form method="POST">
            <div class="title">Old data</div>
            <div class="input-boxes">
            <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="text" id="loginName" name="oldName" placeholder="Enter your old name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" id="loginEmail" name="oldEmail" placeholder="Enter your old email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="loginPassword" name="oldPasswd" placeholder="Enter your old password" required>
              </div>
              <div class="text sign-up-text">Done editing? <label for="flip">Press this</label></div>
              <a href="new_page.php">Back to main page</a>
            </div>
      </div>
        <div class="signup-form">
          <div class="title">New data</div>
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" id="firstname" name="newName" placeholder="Enter your new name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" id="email"  name="newEmail" placeholder="Enter your new email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="newPasswd" placeholder="Enter your new password" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Edit" name="edit">
              </div>
              <div class="text sign-up-text">Wanna edit something? <label for="flip">Press this</label></div>
            </div>
      </form>
    </div>
    </div>
    </div>
  </div> 



<?php
include ('connect.php');
if($_SERVER['REQUEST_METHOD']=="POST"){

  if(isset($_POST['edit'])){
    //prom??nn?? se star??mi daty
    $oldName = $_POST["oldName"];
    $oldEmail = $_POST["oldEmail"];
    $oldPasswd = $_POST["oldPasswd"];
    //prom??nn?? s nov??mi daty
    $newName = $_POST["newName"];
    $newEmail = $_POST["newEmail"];
    $newPasswd = $_POST["newPasswd"];

    //Dotaz co ov????uje jestli tam ty star?? data opravdu v datab??zi jsou
    $select = "SELECT * FROM users WHERE name LIKE '$oldName' AND email LIKE '$oldEmail' AND password LIKE '$oldPasswd'";
    $result = mysqli_query($conn,$select);

    //Ov????ovac?? v??pis
    if ($result){
      echo "Takove udaje se v databazi opravdu nachazi <br>";
    } else {
      echo "Takove udaje se v databazi nenachazi <br>";
    }

    //Dotaz co upravuje ur??it?? data v datab??zi na nov??, prvn?? ????st je nastavov??n?? nov??ch hodnot, druh?? je podm??nka, aby se vyfiltrovaly spr??vn?? ????dky
    $edit = "UPDATE users
    SET name = '$newName', email = '$newEmail', password = '$newPasswd'
    WHERE name LIKE '$oldName' AND email LIKE '$oldEmail' AND password LIKE '$oldPasswd'";
    $editResult = mysqli_query($conn,$edit);

    //Ov????ovac?? v??pis
    if ($editResult) {
      echo "Data se ??sp????n?? zm??nila! <br>";
    } else {
      echo "Data se nepovedlo zm??nit! <br>";
    }
  }
}
echo "<script type='text/javascript'> 
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>";

mysqli_close($conn); //p????kaz co uzav??e datab??zi, aby nedoch??zelo k n??jak??m necht??n??m zm??n??m

?>
