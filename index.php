<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="style.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
   </head>
<body>

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
          <form method="POST" action="new_page.php">
            <div class="title">Login</div>
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" id="loginEmail" name="loginEmail" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="loginPassword" name="loginPassword" placeholder="Enter your password" required>
              </div>
              <div class="text"><a href="reset_pass.php">Forgot password?</a> <br>
              </div>
              <div class="button input-box">
                <input type="submit" value="Login" name="login">
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Sigup now</label></div>
            </div>
        </form>
      </div>
        <div class="signup-form">
        <form method="POST">
          <div class="title">Signup</div>
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" id="firstname" name="firstName" placeholder="Enter your name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" id="email"  name="email" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Signup" name="singup">
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </div>
      </form>
    </div>
    </div>
    </div>
  </div> 
  


<?php    
include('connect.php');

if($_SERVER['REQUEST_METHOD']=="POST"){

  if (isset($_POST['login'])){ 
    if ($_POST["loginEmail"] == null || $_POST["loginPassword"] == null){ //pokud pole nejsou vypln??na, vyp????e to hl????ku
      echo "Pole mus?? b??t vypln??na!";
    } else {
      $loginEmail = $_POST["loginEmail"];
      $loginPassword = $_POST["loginPassword"];

      //ZOBRAZOVAC?? DOTAZ Z DATAB??ZE users -> LOGIN
      //hled?? shodu v datab??zi se zadan??m emailem a heslem
      $selectionQuery = "SELECT * FROM users WHERE email LIKE '$loginEmail' AND password LIKE '$loginPassword'";
      $selectionResult = mysqli_query($conn,$selectionQuery);
      //prom??nn?? na ov????en??, jestli se v datab??zi nach??z?? n??jak?? po??et shodn??ch z??znam?? s takov??mi zadan??mi ??daji
      $selectionResultCount = mysqli_num_rows($selectionResult);
    
      //pokud je alespo?? jeden takovej z??znam tak se provede prvn?? echo, jinak druh??
      if($selectionResultCount >= 1){
        echo "??sp????n?? jsi se p??ihl??sil/a!";
      } else {
        echo "Takov?? u??ivatel neexistuje!";
      }
    }
  }

  if (isset($_POST['singup'])){ //??. 68 -> name="singup"
    if ($_POST["firstName"] == null || $_POST["email"] == null || $_POST["password"] == null){ 
      echo "Vypl??t?? pros??m v??echny ??daje!";
    } else {
      $name = $_POST["firstName"]; 
      $email = $_POST["email"];
      $passwd = $_POST["password"];

      
      $insertQuery = "INSERT INTO users(name,email,password) VALUES('$name','$email','$passwd')";
      $insertResult = mysqli_query($conn,$insertQuery); 

      //ov????en??, jestli se data vkl??daj?? do datab??ze
      if(!$insertResult){
        echo "<script type='text/javascript'>
          window.alert('Registrace se nezda??ila');
        </script>";
      } else {
        echo "<script type='text/javascript'>
          window.alert('??sp????n?? jsi se zaregistroval!');
        </script>";
      }
    }
  }
  //T??mhle zamez??me odesl??n?? stejn??ch dat do datab??ze v p????pad?? refreshe str??nky
 
  echo "<script type='text/javascript'> 
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
  </script>";

  mysqli_close($conn); //p????kaz co uzav??e datab??zi, aby nedoch??zelo k n??jak??m necht??n??m zm??n??m
}
?>
</body>
</html>