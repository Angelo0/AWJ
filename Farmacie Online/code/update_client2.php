<?php
//retinem in variabile datele pentru update
session_start();
$id = $_POST['id'];
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




// interogare sql UPDATE 
$sql = "UPDATE Client SET Nume='$nume', Prenume='$prenume', Sex='$sex', varsta='$varsta', Greutate='$greutate' WHERE id_client='$id'";

// executa interogarea si verifica pentru erori
if (!$conn->query($sql)) {
  echo 'Error: '. $conn->error;
}
 echo include 'home.php';

$conn->close();


?>