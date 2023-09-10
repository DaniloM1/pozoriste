<?php

session_start();
require_once ("funkcije.php");
proveraKolacica();
prijava();
if (isset($_SESSION['status']) && $_SESSION['status'] === 'admin') {

} else {
  
  header("Location: index.html");
  exit(); // Opciono, zaustaviti dalje izvršavanje skripta
}


echo "<div class='container'>Dobro došao, ".$_SESSION['ime']."<br>";
echo "<a href='login.php?odjava'>Odjava</a><br>";

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<li ><a href="index.html" class="active">Pocetna</a></li>
  <div class='center'>
  <img src="imghtml/logooo-removebg-preview.png" width="200" height="200" alt="" >
  </div>
   
<div class="container">

<div class="form-floating mb-4">
<form method="POST" action="home.php">
    <input type="text" name="termin" placeholder="Unesite termin pretrage">
    <input type="submit" name="pretraga" value="Pretraži">
</form>
<?php if (isset($_POST['pretraga'])) {
    $termin = $_POST['termin'];

    // SQL upit za pretragu predstava na osnovu unetog termina
    $query = "SELECT naziv_predstave, datum_predstave, cena_karte, id_predstave FROM predstave WHERE naziv_predstave LIKE '%$termin%'";

    // Izvršavanje upita
    $resultttt = mysqli_query($db, $query);

    // Prikaz rezultata pretrage
    if ($resultttt && mysqli_num_rows($resultttt) > 0) {
      echo "<table>";
      echo "<tr><th>Naziv predstave</th><th>Trajanje predstave</th><th>Cena karte</th></tr>";
        while ($row = mysqli_fetch_assoc($resultttt)) {
          echo " <form action='home.php' method='get' >";
          echo "<tr class='thead-dark'>";
          echo "<td>" . $row["naziv_predstave"] . "</td>";
          echo "<td>" . $row["datum_predstave"] . "</td>";
          echo "<td>" . $row["cena_karte"] . "</td>";
          echo "<td><button class='btn btn-primary'><a style='color:black;' href='home.php?id_predstave=". $row["id_predstave"] ."'>Pogledajte rezervacije</a></button></td>";
          echo "</tr>";
         
      }
      echo "</table>";
      echo "<button > SMANJI</button>";
     
      echo "</form>";
    } else {
        echo "Nema rezultata za uneti termin.";
    }
}?>

<h3>Sve predstave</h3>
  <?php 
 
 $sql = "SELECT naziv_predstave, datum_predstave, cena_karte, id_predstave FROM predstave";
 $result = $db->query($sql);
 
 // Prikaz rezultata u HTML formatu
 if ($result->num_rows > 0) {
     echo "<table class='table'>";
     echo "<tr><th>Naziv predstave</th><th>Trajanje predstave</th><th>Cena karte</th></tr>";
     while ($row = $result->fetch_assoc()) {
      echo " <form action='home.php' method='get' >";
         echo "<tr class='thead-dark'>";
         echo "<td>" . $row["naziv_predstave"] . "</td>";
         echo "<td>" . $row["datum_predstave"] . "</td>";
         echo "<td>" . $row["cena_karte"] . "</td>";
         echo "<td><button class='btn btn-primary'><a style='color:black;' href='home.php?id_predstave=". $row["id_predstave"] ."'>Pogledajte rezervacije</a></button></td>";
         echo "</tr>";
        
     }
     echo "</table>";
     echo "<button > SMANJI</button>";
    
     echo "</form>";
 } else {
     echo "Nema rezultata.";
 }

?>
<?php
if(isset($_GET['id_predstave'])){
  $id_predstave=$_GET['id_predstave'];


    $sql = "SELECT id_rezervacije, ime, email, naziv_predstave, datum_predstave, cena_karte, broj_karata FROM predstave, rezervacija, korisnik where korisnik.id_korisnika=rezervacija.id_korisnika and predstave.id_predstave =rezervacija.id_predstave and rezervacija.id_predstave=$id_predstave";
$result= $db->query($sql);

// Prikaz rezultata u HTML formatu
if (!empty($result) && $result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<tr><th>Ime</th> <th>Email</th>  <th>Naziv predstave</th><th>Datum predstave</th><th>Cena karte</th><th>broj_karata</th></tr>";
 while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["ime"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td>" . $row["naziv_predstave"] . "</td>";
    echo "<td>" . $row["datum_predstave"] . "</td>";
    echo "<td>" . $row["cena_karte"] . "</td>";
    echo "<td>" . $row["broj_karata"] . "</td>";
    echo"<form  method='get' >";
    echo "<td>"."<button name='Izbrisi' value='".$row['id_rezervacije']."'_*?href='home.php?id_predstave=".$id_predstave."'>Izbrisi</button>"."</td>";
    //echo "<td>" . $row["suma"] . "</td>";
    echo "</tr>";
    echo "</form>";

 }
}
 }
if(isset($_GET['Izbrisi'])){
  $id_izbrisi=$_GET['Izbrisi'];
 $q="DELETE FROM `rezervacija` WHERE id_rezervacije='$id_izbrisi'";
 $resultat= $db->query($q);
 echo "Uspesno ste obrisali rezervaciju";
}
?>





</div>
</div>
</div>
</form>

</div>
<!-- Forma za unos predstava -->
<div class='container'>
<?php
 echo "<h3>Unos Predstava</h3>";
 echo "<div class='container' >";
 echo "<form action='home.php' method='post'>";
  echo "<h4>Unesite naizv predstave</h4>";
  echo "<input type='text' size='10'  name='naziv'required>";
  echo "<h4>Unesite opis predstave</h4>";
  echo "<textarea  rows='10' cols='40' name='opis'required> </textarea>";
  echo "<h4>Unesite datum predstave</h4>";
  echo "<input type='datetime-local' size='10'  name='datum'required>";
  echo "<h4>Unesite cenu predstave</h4>";
  echo "<input type='number' min='1' size='5'  name='cena'required>";
  echo "<h4>Unesite broj mesta</h4>";
  echo "<input type='number' min='1' size='5'  name='brmesta'required>";
  echo "<h4>Unesite img putanju</h4>";
  echo "<input type='text' size='10'  name='img'required>";
  echo "<br>";
  echo "<input type='submit' size='10'  name='btnPosalji' value='Posalji'>";
  echo "<form>";
  echo "</div> ";

 ?>
  <?php
 if(isset($_POST['btnPosalji'])){
  $naziv=$_POST['naziv'];
  $opis=$_POST['opis'];
  $datum=$_POST['datum'];
  $cena=$_POST['cena'];
  $broj=$_POST['brmesta'];
  $img=$_POST['img'];
  $datumformated=date('Y-m-d H:i:s.', strtotime($datum));
  echo $datumformated;

  $upit="INSERT INTO PREDSTAVE (naziv_predstave, opis_predstave, datum_predstave, cena_karte, broj_mesta, imgPutanja) values('$naziv', '$opis','$datumformated', '$cena', '$broj', '$img' )";
  $result = mysqli_query($db, $upit);
  echo "<div class='alert alert-success' >Uspesno ste se dodali predstavu!!<br></div>";

 }
 
 ?>
 </div>
</body>

<?php

?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
          