
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
    <link rel="stylesheet" href="csshtml/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
   <?php
   if(isset($_GET['id_predstave'])){
   echo "<form action='recenzije.php' method='get'>";
   echo "<h5>Unesite komentar za predstavu</h5>";
    echo "<textarea  rows='10' cols='40'  name='komentar'required> </textarea>";
    echo "<br>";
    
    echo "<br>";
    echo "<h5>Unesite ocenu predstave 5-10</h5>";
    echo "<input name='ocena' id='ocena' type='number' min='5' max='10' value='5';>";
    echo "<button name='btnPosalji' value='".$_GET['id_predstave']."'>Posalji</button>";
    echo "</form>";
    
        $id=$_GET['id_predstave'];
    
    }
    
   ?>
<?php
 if(isset($_GET['btnPosalji'])){
    $idPr=$_GET['btnPosalji'];
    $idKorisnika=$_SESSION['id'];
    $ocena=$_GET['ocena'];
    $komentar=$_GET['komentar'];

    $upitt="INSERT INTO recenzija(id_korisnika, id_predstave, ocena, komentar) values('$idKorisnika', '$idPr', '$ocena', '$komentar')";
    $rezultt=$db->query($upitt);
 echo "Uspesno ste dodali ocenu i komentar";
 echo "<br>";
 echo "<div class='d-grid gap-2'>
<a class='btn btn-success'  name='log' href='recenzije.php?id_predstave=".$_GET['btnPosalji']."'>Nazad na recenzije</a>
</div>";
    }
?>
   <?php
   if(isset($_GET['id_predstave'])){

   $upit="SELECT ime, naziv_predstave, ocena, komentar from predstave, recenzija, korisnik where korisnik.id_korisnika=recenzija.id_korisnika and predstave.id_predstave=recenzija.id_predstave and recenzija.id_predstave='$id'";
   $result = $db->query($upit);
   if (isset($result->num_rows) && $result->num_rows >0) {
    echo "<div class='container'>";
    echo "<table class='table'>";
    echo "<tr> <th>Ime</th><th>Naziv predstave</th> <th>Ocena</th> <th>Komentar</th> </tr>";
    while ($row = $result->fetch_assoc()) {
       echo "<tr>";
       echo"<td>".$row['ime']."</td>";
        echo"<td>".$row['naziv_predstave']."</td>";
        echo"<td>".$row['ocena']."</td>";
        echo"<td>".$row['komentar']."</td>";
        echo "</tr>";
        
    }}
    echo "</table>";
    echo "</div>";

}
   
   ?>
</body>
</html>