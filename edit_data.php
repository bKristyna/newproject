<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style2.css">
  <title>Document</title>
  
</head>
<body>
<a href="new_page.php">Back to main page</a> <!--Link na hlavní stránku-->
</body>
</html>


<h2>Administrator section</h2>
<div class="container">
    <div class="cover">
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
          <form method="POST">
            <div class="title">Enter user's original data</div>
            <div class="input-boxes">
            <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="text" id="loginName" name="oldName" placeholder="User's old Name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" id="loginEmail" name="oldEmail" placeholder="User's old Email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="loginPassword" name="oldPasswd" placeholder="User's old Password" required>
              </div>
              </div>
      </div>
      <div class="forms">
        <div class="form-content">
          <div class="login-form">
          <form method="POST">
            <div class="title">Enter user's new data</div>
            <div class="input-boxes">
            <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="text" id="loginName" name="oldName" placeholder="User's new Name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" id="loginEmail" name="oldEmail" placeholder="User's new Email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="loginPassword" name="oldPasswd" placeholder="User's new Password" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Save" name="save">
              </div>
            </div>
      </div>
        <div class="signup-form">
          <div class="title">Delete user's account</div>
          <p><b>Enter user's data which you want to delete</b></p>
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" id="firstname" name="newName" placeholder="User's Name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" id="email"  name="newEmail" placeholder="User's Email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="newPasswd" placeholder="User's Password" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Delete" name="delete">
              </div>
             
            </div>
         </form>
      </div>
        <div class="signup-form">
        <form method="POST">
          <div class="title">Create user's account</div>
          <p><b>Enter user's data to create an account</b></p>
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
                <input type="submit" value="Create" name="create">
              </div>
        </div>
      </form>
    </div>
    </div>
    </div>
  </div> 





<?php
include ('connect.php');
if($_SERVER['REQUEST_METHOD']=="POST"){
  //Pokud se zmáčklo tlačítko "edit"
  if(isset($_POST['edit'])){
    //proměnné se starými daty
    $oldName = $_POST["oldName"];
    $oldEmail = $_POST["oldEmail"];
    $oldPasswd = $_POST["oldPasswd"];
    //proměnné s novými daty
    $newName = $_POST["newName"];
    $newEmail = $_POST["newEmail"];
    $newPasswd = $_POST["newPasswd"];

    //Dotaz co ověřuje jestli tam ty staré data opravdu v databázi jsou
    $select = "SELECT * FROM users WHERE name LIKE '$oldName' AND email LIKE '$oldEmail' AND password LIKE '$oldPasswd'";
    $result = mysqli_query($conn,$select);

    //Ověřovací výpis
    if ($result){
      echo "Nalezena shoda s údaji v databázi <br>";
    } else {
      echo "Takove udaje se v databazi nenachazi <br>";
    }

    //Dotaz co upravuje určitá data v databázi na nová, první část (začíná SET) je nastavování nových hodnot, 
    //druhá je podmínka (začíná WHERE), aby se vyfiltrovaly správné řádky
    $edit = "UPDATE users
    SET name = '$newName', email = '$newEmail', password = '$newPasswd'
    WHERE name LIKE '$oldName' AND email LIKE '$oldEmail' AND password LIKE '$oldPasswd'";
    $editResult = mysqli_query($conn,$edit);

    //Ověřovací výpis
    if ($editResult) {
      echo "Data se úspěšně změnila! <br>";
    } else {
      echo "Data se nepovedlo změnit! <br>";
    }
  }
  //Pokud se zmáčklo tlačítko "show"
  if(isset($_POST['show'])){
    //Dotaz co vybere vše z databáze (protože chceme zobrazit všechna data)
    $showQuery = "SELECT * FROM users";
    $showResult = mysqli_query($conn,$showQuery);

    //vypíšu si tag tabulky s hlavičkama pro přehlednost
    echo "<table border = 1>";
    echo "<tr> <th>name</th> <th>email</th> <th>password</th> </tr>";

    //Cyklus ve kterém vytvářím pole, které obsahuje jednotlivé data databáze jako hodnoty (jednotlivá jména, emaily, hesla)
    //každou z těchto hodnot vkládá do buňky tabulky podle specifikace - [name], [email], [password]
    //specifikuje se to, aby se vědělo kam co patří, jelikož jsem si první sloupec udělal pro "name" (ř.97 -> první <th></th>), tak do první buňky 
    //vkládám data z pole, která byly v databázi ve sloupci name. Vkládá se to po řádcích databáze, takže celej jeden záznam
    //se vloží v jedné iteraci (jedno proběhnutí cyklu), proto to tak hezky funguje
    while ($row = mysqli_fetch_array($showResult)){
      echo "<tr> <td>$row[name]</td> <td>$row[email]</td> <td>$row[password]</td> </tr>";
    } 

    echo "</table>";
  }
  //Pokud se zmáčklo tlačítko "delete"
  if(isset($_POST['delete'])){
    $delName = $_POST['deletingName'];
    $delEmail = $_POST['deletingEmail'];
    $delPasswd = $_POST['deletingPasswd'];  

    //Dotaz co maže data v databázi se shodným jménem, heslem a emailem
    $deletingQuery = "DELETE FROM users WHERE name LIKE '$delName' AND email LIKE '$delEmail' AND password like '$delPasswd'";
    $deletingResult = mysqli_query($conn,$deletingQuery);

    //Ověřovací výpis
    if ($deletingResult) {
      echo "Data se úspěšně smazala";
    } else {
      echo "Taková data se v databázi nenacházejí!";
    }
  }
  //Pokud se zmáčklo tlačítko "create"
  if(isset($_POST['create'])){
    $createName = $_POST['creatingName'];
    $createEmail = $_POST['creatingEmail'];
    $createPasswd = $_POST['creatingPasswd'];

    $creatingQuery = "INSERT INTO users (name,email,password) VALUES ('$createName','$createEmail','$createPasswd')";
    $creatingResult = mysqli_query($conn,$creatingQuery);

    if ($creatingResult){
      echo "Uživatel úspěšně zaregistrován!";
    } else {
      echo "Uživatele se nepodařilo zaregistrovat!";
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

