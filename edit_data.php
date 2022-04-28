<a href="index.php">Back to main page</a> <!--Link na hlavní stránku-->

<form method="POST">
  <input type="submit" value="Show data" name="show">
  <h2>Edit user's account</h2>
  <p><b>Enter user's original data</b></p>
  <label for="oldName">User's old Name: </label>
  <input type="text" name="oldName" id="oldName"> <br> <br>
  <label for="oldEmail">User's old Email:</label>
  <input type="text" name="oldEmail" id="oldEmail"> <br> <br>
  <label for="oldPasswd">User's old Password: </label>
  <input type="text" name="oldPasswd" id="oldPasswd"> <br> <br> 

  <p><b>Enter user's new data</b></p>
  <label for='newName'>User's new Name: </label>
  <input type='text' name='newName' id='newName'> <br> <br>
  <label for='newEmail'>User's new Email:</label>
  <input type='text' name='newEmail' id='newEmail'> <br> <br>
  <label for='newPasswd'>User's new Password: </label>
  <input type='text' name='newPasswd' id='newPasswd'> <br> <br>
  <input type="submit" value="Edit" name="edit"> 
  
</form>

<form method="POST">
  <h2>Delete user's account</h2>
  <p><b>Enter user's data which you want to delete</b></p>
  <label for="deletingName">User's Name: </label>
  <input type="text" name="deletingName" id="deletingName"> <br> <br>
  <label for="deletingEmail">User's Email:</label>
  <input type="text" name="deletingEmail" id="deletingEmail"> <br> <br>
  <label for="deletingPasswd">User's Password: </label>
  <input type="text" name="deletingPasswd" id="deletingPasswd"> <br> <br> 
  <input type="submit" value="Delete" name="delete">
</form>

<form method="POST">
  <h2>Create user's account</h2>
  <p><b>Enter user's data to create an account</b></p>
  <label for="creatingName">User's Name: </label>
  <input type="text" name="creatingName" id="creatingName"> <br> <br>
  <label for="creatingEmail">User's Email:</label>
  <input type="text" name="creatingEmail" id="creatingEmail"> <br> <br>
  <label for="creatingPasswd">User's Password: </label>
  <input type="text" name="creatingPasswd" id="creatingPasswd"> <br> <br> 
  <input type="submit" value="Create" name="create">
</form>

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