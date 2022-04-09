<?php
$firstName = $_POST['firstName'];
$email = $_POST['email'];
$password= $_POST['password'];


$conn = new mysqli = ('localhost', 'root', '','SOFICO');
if($conn->connect_error){
    die('Connection Failed : ' .$conn->connec_error);
} else
  $stmt = $conn->prepare ("insert into registraion(firstName, email, password)
  values (?, ?, ?)");
    $stmt->bind_param("sss", $firstName, $email, $password);
$stmt->execute();
echo "Registration was successful";
$stmt->close();
$conn->close();




?>