
<?php

session_start();
require_once ("funkcije.php");
proveraKolacica();
prijava();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="csshtml/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<nav >
    
    <a href="index.html " class="logo"> <img class="logo" src="imghtml/logooo-removebg-preview.png" width="50" height="50" alt=""> </a>
    <ul>
    
        <li ><a href="index.html" >Pocetna</a></li>
        <li ><a href="repertoarrr.php">Repertoar</a> </li>
        <li ><a href="galerija.html" >Galerija</a></li>
        <li ><a href="kontakt.html" >Kontakt</a></li>
        <li><a href="mojerezervacije.php" class="active">Rezervacije</a></li>
        
    </ul>
    <a style='float:right' href="home.php">Admin deo</a>
    <?php 
    if(isset($_SESSION['ime'])){
    echo "<a style='float:right; margin-top: 15px;' href='login.php?odjava'>Odjava</a><br>";
    }else{
    echo "<a style='float:right; margin-top: 15px;' href='login.php?odjava'>Prijava</a><br>";
    }
    ?>
</nav>
<div class='container'>


<?php

if (isset($_SESSION['id'])) {
    $id=$_SESSION['id'];

    // echo "Uspešno ste rezervisali predstavu sa ID: " . $id_predstave;
    $sql = "SELECT naziv_predstave, datum_predstave, cena_karte, broj_karata FROM predstave, rezervacija, korisnik where korisnik.id_korisnika=rezervacija.id_korisnika and predstave.id_predstave=rezervacija.id_predstave and rezervacija.id_korisnika='$id'";
$result= $db->query($sql);

// Prikaz rezultata u HTML formatu
if (!empty($result) && $result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<tr><th>Naziv predstave</th><th>Datum predstave</th><th>Cena karte</th></tr>";
 while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["naziv_predstave"] . "</td>";
    echo "<td>" . $row["datum_predstave"] . "</td>";
    echo "<td>" . $row["cena_karte"] . "</td>";
    //echo "<td>" . $row["suma"] . "</td>";
    echo "</tr>";

 }
}
 }
?>
</div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
<?php
echo "<div style='float:left; display:flex;'>Dobro došao, ".$_SESSION['ime']."<br>";
echo "<a href='login.php?odjava'>Odjava</a><br>";
?>