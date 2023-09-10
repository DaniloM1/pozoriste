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
    <title>Document</title>
    <link rel="stylesheet" href="csshtml/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
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
        <a style='float:right' href="home.php">Admin deo</a>
        <?php 
    if(isset($_SESSION['ime'])){
    echo "<a style='float:right; margin-top: 15px;' href='login.php?odjava'>Odjava</a><br>";
    }else{
    echo "<a style='float:right; margin-top: 15px;' href='login.php?odjava'>Prijava</a><br>";
    }
    ?>
    </ul>
</nav>
<!-- <?php 
echo "<div class='container'>Dobro došao, ".$_SESSION['ime']."<br>";
echo "<a href='login.php?odjava'>Odjava</a><br>"."<br>";?> -->
    <div class="container">
    <div class="form-floating mb-4">

   
<!-- <a href="index.html">Pocetna</a> -->
<br>

    <?php
    if (isset($_GET['id_predstave'])) {
        $id_predstave = $_GET['id_predstave'];

        // echo "Uspešno ste rezervisali predstavu sa ID: " . $id_predstave;
        $sql = "SELECT naziv_predstave, datum_predstave, cena_karte, id_predstave, broj_mesta FROM predstave where id_predstave='$id_predstave'";
 $result = $db->query($sql);
 
 // Prikaz rezultata u HTML formatu
 if ($result->num_rows > 0) {
     echo "<table class='table'>";
     echo "<tr><th>Naziv predstave</th><th>Trajanje predstave</th><th>Cena karte</th> <th>Broj dostupnih mesta</th> <th>izaberite broj karata</th></tr>";
     while ($row = $result->fetch_assoc()) {
      echo " <form action='rez.php' method='get' >";
         echo "<tr class='thead-dark'>";
         echo "<td>" . $row["naziv_predstave"] . "</td>";
         echo "<td>" . $row["datum_predstave"] . "</td>";
         echo "<td>" . $row["cena_karte"] . "</td>";
         echo"<td>" . $row["broj_mesta"] . "</td> ";
         echo"<td>" . "<input name='mesta' id='mesta' type='number' min='1' max='10' value='1';>" . "</td> ";
         echo"<td>" . "<button name='btn' value='$id_predstave'>Rezervisi</button>". "</td> ";
         echo "</tr>";
         echo "<table>";
        //  echo "</form>";
        
     }
   
     
     

 }else {

    echo "Greška: Predstava ID nije pravilno prosleđen.";
    } 

 
    }
   
    ?>

    <?php
   

 
    if (isset($_GET['btn'])){
        $mesta=$_GET['mesta'];
        $idPredstave=$_GET['btn'];
        $datum= date( 'Y-m-d H:i:s', strtotime('now') );
       
    

$upit="INSERT INTO rezervacija (id_korisnika, id_predstave, datum_rezervacije, broj_karata) VALUES('$_SESSION[id]', '$idPredstave', '$datum','$mesta')";
$rez=mysqli_query($db, $upit) ;
echo "<div class='alert alert-success' >Uspesno ste rezervisali<br></div>";
echo "<div class='d-grid gap-2'>
<a class='btn btn-success'  name='log' href='mojerezervacije.php'>Pogledajte vase rezervacije</a>
</div>";

$upitt="UPDATE predstave
SET broj_mesta = broj_mesta-$mesta
WHERE id_predstave='$idPredstave';";
$rezz=mysqli_query($db, $upitt) ;
   
};


      
    ?>

</div>
</div>
<div style='float:right;'>
<?php
echo "<div class='container'>Dobro došao, ".$_SESSION['ime'].$_SESSION['status']."<br>";
echo "<a href='login.php?odjava'>Odjava</a><br>";
?>


</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>