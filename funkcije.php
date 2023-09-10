<?php
//Konekcija na bazu
$server="localhost";
$kor="root";
$pas="";
$dbime="pozoriste";

$db=mysqli_connect($server, $kor, $pas, $dbime);





function odjava()
{
//Ako se korisnik odjavljuje, uništavaju se promenljive sesije, sesija i kolačići
setcookie("id", "", time()-1);
setcookie("email", "", time()-1);
setcookie("ime", "", time()-1);
setcookie("status", "", time()-1);
unset($_SESSION['id']);
unset($_SESSION['email']);
unset($_SESSION['ime']);
unset($_SESSION['status']);
session_destroy();
}
function prijava()
{
//Ako korisnik nije prijavljen odmah se prosleđuje na stranicu za prijavu
if(!isset($_SESSION['id'])) header("Location: login.php");
}


function proveraKolacica()
{
//Ako kolačići postoje generišu se promenljive sesije za dalji rad
if(isset($_COOKIE['id']) and isset($_COOKIE['email']) and isset($_COOKIE['ime'])and isset($_COOKIE['status']))
{
$_SESSION['id']=$_COOKIE['id'];
$_SESSION['email']=$_COOKIE['email'];
$_SESSION['ime']=$_COOKIE['ime'];
$_SESSION['status']=$_COOKIE['status'];
}
}


?>