<?php 
$conn = new mysqli('localhost', 'root', 'andrei123', 'Farmacie');

// verifica conexiunea
if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}
$result = $conn->query($sql);

 $id = $_POST['id'];
  $sql = "SELECT * FROM `Medicament` WHERE id_med = '$id'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
</head>
<body>
<div class="container">
<table class = "table table-bordered">
<tr>
<form class="form-inline" action ="update_medicament2.php" method="POST">
<input type="hidden"  name="id" 
     value="<?php echo $_POST['id'];?>" > 
 <td>
 <div class="form-group">
    <label>Denumire</label>

    <input type="text" class="form-control" name="denumire" 
     value="<?php echo $row['Denumire'];?>" > 
  </div></td>

  <td>
  <div class="form-group">
    <label>Producator</label>
    <input type="text" class="form-control" name="producator"
    value="<?php echo $row['Producator'];?>" >
  </div></td>

   <td>
  <div class="form-group">
    <label>Administrare</label>
    <input type="text" class="form-control" name="administrare"
    value="<?php echo $row['Mod_administrare'];?>" >
  </div></td>

    <td>
  <div class="form-group">
    <label>Stoc</label>
    <input type="text" class="form-control" name="stoc"
    value="<?php echo $row['Stoc'];?>" >
  </div></td>

    <td>
  <div class="form-group">
    <label>Pret</label>
    <input type="text" class="form-control" name="pret" 
    value="<?php echo $row['Pret'];?>" >
  </div></td>

  <td><button type="submit" class="btn btn-default">Trimite</button></td>

</form>
</tr></table></div>
</body>
</html>