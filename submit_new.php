
<form method="POST">
   
  <p>Enter your original data</p>
    <div class="title">Your old name </div>
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" id="oldName" name="oldName" placeholder="Enter your old name" required>
              </div>
        <br> <br>
  
    <div class="title">Your old email </div>
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" name="oldEmail" id="oldEmail" placeholder="Enter your old email" required>
              </div> <br> <br>

              <div class="title">Your old password </div>
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" name="oldPasswd" id="oldPasswd" placeholder="Enter your old password" required>
              </div> <br> <br>
  
  <p>Enter your new data</p> 
  
   <div class="title">Your new name </div>
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type='text' name='newName' id='newName' placeholder="Enter your new name" required>
              </div> <br> <br>

              <div class="title">Your new email </div>
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type='text' name='newEmail' id='newEmail' placeholder="Enter your new email" required>
              </div> <br> <br>
  

  <div class="title">Your new password </div>
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type='text' name='newPasswd' id='newPasswd' placeholder="Enter your new password" required>
              </div> <br> <br>
  


  <input type="submit" value="Edit" name="edit"> <br> <br>
  </form>
         






<?php
include ('connect.php');
if($_SERVER['REQUEST_METHOD']=="POST"){

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
      echo "Takove udaje se v databazi opravdu nachazi <br>";
    } else {
      echo "Takove udaje se v databazi nenachazi <br>";
    }

    //Dotaz co upravuje určitá data v databázi na nová, první část je nastavování nových hodnot, druhá je podmínka, aby se vyfiltrovaly správné řádky
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
}
echo "<script type='text/javascript'> 
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>";

mysqli_close($conn); //příkaz co uzavře databázi, aby nedocházelo k nějakým nechtěným změnám

?>
