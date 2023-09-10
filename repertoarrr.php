<?php
session_start();
require_once ("funkcije.php");
proveraKolacica();
prijava();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width", initial-scale="1.0">
    <title>Bioskop - Repertoar</title>
    <link rel="stylesheet" href="csshtml/style.css">
    
</head>
<body>
<nav>
    <a href="index.html " class="logo"> <img class="logo" src="imghtml/logooo-removebg-preview.png" width="50" height="50" alt=""> </a>

    <ul>
        
        <li ><a href="index.html" >Pocetna</a></li>
        <li ><a href="repertoarrr.php" class="active">Repertoar</a</li>
        <li ><a href="galerija.html" >Galerija</a></li>
        <li ><a href="kontakt.html" >Kontakt</a></li>
        <li><a href="mojerezervacije.php">Rezervacije</a></li>
        
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

<div class="container">
    
<div class="row">
    <h2> Najnoviji repertoar!!</h2>
    <div class="container">
        <div class="row"> 
      <div class="col-4 meni">
          <h3>Bal pod maskama </h3>
         <img src="imghtml/bal_pod_maskama_plakat.jpg"  class="col-9" alt="" href="rezervacija.html">
      </div>
      <div class="col-4 meni">
          <h3>Aleksanar</h3>
      <img src="imghtml/Aleksanar.jpg" class="col-9"  height="88%" alt="" href="rezervacija.html">
      </div>
      <div class="col-4 meni ">
          <h3>Atiila</h3>
          <img src="imghtml/poster.jpg" class="col-9" alt="" href="home.php">
          </div>
          </div> 
      </div>

    <div>
        <h3 class="container">Starije repertoar</h3>
    </div>
<hr>

<?php
$sql = "SELECT naziv_predstave, datum_predstave,opis_predstave, cena_karte, id_predstave, imgPutanja FROM predstave";
$result = $db->query($sql);

// Prikaz rezultata u HTML formatu
if ($result->num_rows > 0) {
    
    
    while ($row = $result->fetch_assoc()) {
        echo " <div class='container' style='margin: 5px;'>";
        // echo "<div class='row'>";
        echo" <div class='col-3' style='margin-right: 22px;'> <img src='".$row['imgPutanja']."' alt='baner ' width='140' height='209'> </div>";
     echo "<form action='rez.php' method='get'>";
     echo"<div class='col-5 manja style='margin-right: 22px;''> <h3><b>".$row['naziv_predstave']."</b></h3><br>";
     echo"<br>";
     echo $row['opis_predstave'];
     echo "</div>";
     echo "<div class='col-7 kod'>

        Radnim danima u ".date('H:i', strtotime($row['datum_predstave']))."
        <br>
        <br>
        <B>Sala levo</B>
        <br>
        8.6 <i class='fas fa-star'></i>
        <br>";
        echo "<a style='color:black;' href='rez.php?id_predstave=". $row["id_predstave"] ."'>Rezerviši</a>";
        echo "<br><br>";
        echo "<a style='color:black;' href='recenzije.php?id_predstave=". $row["id_predstave"] ."'>Recenzije</a>";
        echo " </div>";
        
        echo "</div>";
        echo "<hr>";
        // echo "</div>";
        echo "</form>";
        // echo "<button class='btn btn-primary'><a style='color:black;' href='rez.php?id_predstave=". $row["id_predstave"] ."'>Rezerviši</a></button>";
        
    }
    
   
    
} else {
    echo "Nema rezultata.";
}



?>

</div>
</div>
<hr>

<script src="js/all.min.js">

</script>
</body>

</html>