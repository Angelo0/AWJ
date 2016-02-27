<?php
//retinem in variabile datele pentru update

$nume = $_POST['nume'];
$prenume = $_POST['prenume'];
$sex = $_POST['sex'];
$varsta = $_POST['varsta'];
$greutate = $_POST['greutate'];


 
 // conecteaza la baza de date "Farmacie" 
$conn = new mysqli('localhost', 'root', 'andrei123', 'Farmacie');

// verifica conexiunea
if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}

// interogare sql Insert
$sql = "INSERT INTO `Client`(`Nume`, `Prenume`, `Sex`, `varsta`, `Greutate`) VALUES ('$nume','$prenume','$sex','$varsta','$greutate')";

// executa interogarea si verifica pentru erori
if (!$conn->query($sql)) {
  echo 'Error: '. $conn->error;
}
 echo include 'home.php';

$conn->close();


?>