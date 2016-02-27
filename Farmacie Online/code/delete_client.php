<?php
//retinem in variabile datele pentru update

$id = $_POST['id'];


 
 // conecteaza la baza de date "Farmacie" 
$conn = new mysqli('localhost', 'root', 'andrei123', 'Farmacie');

// verifica conexiunea
if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}

// interogare sql Insert
$sql = "DELETE FROM  `Client` WHERE id_client = '$id'";


// executa interogarea si verifica pentru erori
if (!$conn->query($sql)) {
  echo 'Error: '. $conn->error;
}
 echo include 'home.php';

$conn->close();


?>