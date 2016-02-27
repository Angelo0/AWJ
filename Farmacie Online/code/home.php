<!DOCTYPE html>
<html ng-app="blog">
<head>
  <title>Home</title>
  <link rel="stylesheet" media="all" href="css/bootstrap.min.css">
  <link rel="stylesheet" media="all" href="css/custom.css">
</head>
<body>
<div class="container">
<table class = "table table-bordered">
	<tr>
		<center><font size = '6'>Medicamente</font></center>
	</tr>

	<tr>
	<th>ID</th>
	<th>Denumire</th>
	<th>Producator</th>
	<th>Administrare</th>
	<th>Stoc</th>
	<th>Pret</th>
	</tr>
	
<?php 
$conn = new mysqli('localhost', 'root', 'andrei123', 'Farmacie');

// verifica conexiunea
if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}

$sql1  = "SELECT * FROM Medicament";
$sql2  = "SELECT * FROM Client";
$sql3  = "SELECT * FROM Factura";
$sql4  = "SELECT * FROM Efec_secundar";
$sql5  = "SELECT * FROM Reteta";
$sql6  = "SELECT * FROM Efect/Medicament";
$sql7  = "SELECT * FROM Medicament/Reteta";
// executa interogarea si retine datele returnate
$result = $conn->query($sql1);

while($row = $result->fetch_assoc()){

	//Afisare elemente din baza de date
	echo "<tr>";
	echo "<td>" . $row['id_med']."</td>";
	echo "<td>" . $row['Denumire']."</td>";
	echo "<td>" . $row['Producator']."</td>";
	echo "<td>" . $row['Mod_administrare']."</td>";
	echo "<td>" . $row['Stoc']."</td>";
	echo "<td>" . $row['Pret']."</td>";
	echo "<td>";

	//Implementare update 
    $adresa = $row['id_med'];
	echo '<form class="form-inline" action ="update_medicament1.php" method="POST">';
	echo '<div class="form-group">';
    echo '<button type="submit" class="btn btn-default">Update</button>';
    echo '<input type="hidden" name="id" value="'.$adresa.'" >';
      echo '</div>';
      echo '</form>';

	
    echo  "</td>";
	echo "</tr>";
}
	echo "<tr>";
	$insert = 'insert_med1.html';
	echo '<font size="4">';
	echo '<a href="'.$insert.'">';
    echo '<span class="label label-primary">
             Adauga un medicament
              <span class="glyphicon glyphicon-folder-edit"></span>
            </span>';
	echo '</a>';
    echo  "</td>";

    $delete = 'delete_med.html';
	echo '<a href="'.$delete.'">';
    echo '<span class="label label-danger">
            Sterge un medicament
              <span class="glyphicon glyphicon-folder-remove"></span>
            </span>';
	echo '</a>';
    echo  "</td>";
    echo "</font";
    echo "</tr>";

	echo "</table>";
echo "</div>";
?>

<!--Tabelul Clienti -->
	<div class="container">
<table class = "table table-bordered">
	<tr>
		<center><font size = '6'>Clienti</font></center>
	</tr>

	<tr>
	<th>ID</th>
	<th>Nume</th>
	<th>Prenume</th>
	<th>Sex</th>
	<th>Varsta</th>
	<th>Greutate</th>
	</tr>
<?php

$result = $conn->query($sql2);

while($row = $result->fetch_assoc()){

	//Afisare elemente din tabel
	echo "<tr>";
	echo "<td>" . $row['id_client']."</td>";
	echo "<td>" . $row['Nume']."</td>";
	echo "<td>" . $row['Prenume']."</td>";
	echo "<td>" . $row['Sex']."</td>";
	echo "<td>" . $row['varsta']."</td>";
	echo "<td>" . $row['Greutate']."</td>";
	echo "<td>";

	//Implementare update 
    $adresa = $row['id_client'];
	echo '<form class="form-inline" action ="update_client1.php" method="POST">';
	echo '<div class="form-group">';
    echo '<button type="submit" class="btn btn-default">Update</button>';
    echo '<input type="hidden" name="id" value="'.$adresa.'" >';
      echo '</div>';
      echo '</form>';

	
    echo  "</td>";
	echo "</tr>";
}
	//Implementare Insert
	echo "<tr>";
	$insert = 'insert_client1.html';
	echo '<font size="4">';
	echo '<a href="'.$insert.'">';
    echo '<span class="label label-primary">
             Adauga un Client
              <span class="glyphicon glyphicon-folder-edit"></span>
            </span>';
	echo '</a>';
    echo  "</td>";

    //Implementare Delete
    $delete = 'delete_client.html';
	echo '<a href="'.$delete.'">';
    echo '<span class="label label-danger">
            Sterge un Client
              <span class="glyphicon glyphicon-folder-remove"></span>
            </span>';
	echo '</a>';
    echo  "</td>";
    echo "</font";
    echo "</tr>";

	echo "</table>";
	echo "</div";
?>

<!--Tabelul Factura -->
<div class="container">
<table class = "table table-bordered">
	<tr>
		<center><font size = '6'>Factura</font></center>
	</tr>

	<tr>
	<th>ID_factura</th>
	<th>ID_Client</th>
	<th>Data</th>
	<th>Plata</th>

	</tr>
<?php

$result = $conn->query($sql3);

while($row = $result->fetch_assoc()){

	//Afisare elemente din tabel
	echo "<tr>";
	echo "<td>" . $row['id_factura']."</td>";
	echo "<td>" . $row['id_client']."</td>";
	echo "<td>" . $row['data']."</td>";
	echo "<td>" . $row['plata']."</td>";
	echo "</tr>";
	echo '</div>';
}

?>

<!--Tabelul Efect -->
<div class="container">
<table class = "table table-bordered">
	<tr>
		<center><font size = '6'>Efect</font></center>
	</tr>

	<tr>
	<th>ID</th>
	<th>Efect Secundar</th>
	</tr>
<?php

$result = $conn->query($sql4);

while($row = $result->fetch_assoc()){

	//Afisare elemente din tabel
	echo "<tr>";
	echo "<td>" . $row['id_efect']."</td>";
	echo "<td>" . $row['Efect']."</td>";
	echo "</tr>";
	echo '</div>';
}

?>

<!--Tabelul Reteta -->
<div class="container">
<table class = "table table-bordered">
	<tr>
		<center><font size = '6'>Reteta</font></center>
	</tr>

	<tr>
	<th>ID Reteta</th>
	<th>ID Client</th>
	<th>Diagnostic</th>
	<th>Data eliberarii</th>
	</tr>
<?php

$result = $conn->query($sql5);

while($row = $result->fetch_assoc()){

	//Afisare elemente din tabel
	echo "<tr>";
	echo "<td>" . $row['id_reteta']."</td>";
	echo "<td>" . $row['id_client']."</td>";
	echo "<td>" . $row['diagnostic']."</td>";
	echo "<td>" . $row['data_eliberarii']."</td>";
	echo "</tr>";
	echo '</div>';
}

?>
</body></html>