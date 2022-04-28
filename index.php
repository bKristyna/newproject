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


<nav>
            <div class="col-md-9">
            <ul>  
    <li><a href="submit_new.php">Edit my account</a></li>  
    <li><a href="edit_data.php">Edit all users</a></li>  
            </ul>
            </div>
            </div>
       </nav>





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
          <form method="POST" action="submit_new.php">
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
    if ($_POST["loginEmail"] == null || $_POST["loginPassword"] == null){ //pokud pole nejsou vyplněna, vypíše to hlášku
      echo "Pole musí být vyplněna!";
    } else {
      $loginEmail = $_POST["loginEmail"];
      $loginPassword = $_POST["loginPassword"];

      //ZOBRAZOVACÍ DOTAZ Z DATABÁZE users -> LOGIN
      //hledá shodu v databázi se zadaným emailem a heslem
      $selectionQuery = "SELECT * FROM users WHERE email LIKE '$loginEmail' AND password LIKE '$loginPassword'";
      $selectionResult = mysqli_query($conn,$selectionQuery);
      //proměnná na ověření, jestli se v databázi nachází nějaký počet shodných záznamů s takovými zadanými údaji
      $selectionResultCount = mysqli_num_rows($selectionResult);
    
      //pokud je alespoň jeden takovej záznam tak se provede první echo, jinak druhé
      if($selectionResultCount >= 1){
        echo "Úspěšně jsi se přihlásil/a!";
      } else {
        echo "Takový uživatel neexistuje!";
      }
    }
  }

  if (isset($_POST['singup'])){ //ř. 68 -> name="singup"
    if ($_POST["firstName"] == null || $_POST["email"] == null || $_POST["password"] == null){ 
      echo "Vyplňtě prosím všechny údaje!";
    } else {
      $name = $_POST["firstName"]; 
      $email = $_POST["email"];
      $passwd = $_POST["password"];

      
      $insertQuery = "INSERT INTO users(name,email,password) VALUES('$name','$email','$passwd')";
      $insertResult = mysqli_query($conn,$insertQuery); 

      //ověření, jestli se data vkládají do databáze
      if(!$insertResult){
        echo "<script type='text/javascript'>
          window.alert('Registrace se nezdařila');
        </script>";
      } else {
        echo "<script type='text/javascript'>
          window.alert('Úspěšně jsi se zaregistroval!');
        </script>";
      }
    }
  }
  //Tímhle zamezíme odeslání stejných dat do databáze v případě refreshe stránky
 
  echo "<script type='text/javascript'> 
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
  </script>";

  mysqli_close($conn); //příkaz co uzavře databázi, aby nedocházelo k nějakým nechtěným změnám
}
?>
</body>
</html>