<?php
//include '../header.php';
include '../db.php';
session_start();
$_SESSION['loginError']= "";
$email = $conn->real_escape_string($_POST['email']);//email Eingabe speichern
//Passwort und E-Mail mit Datenbank vergleichen
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$hash = $row['password'];
if(password_verify($_POST['password'], $hash)){
	/*if(remember){//Platzhalter
		setcookie('email', $email, 'password', $password, time()+60*60*365);
	}*/
	$_SESSION['id'] = $row['id'];
	$_SESSION['username'] = $row['username'];
	$_SESSION['email'] = $email;
	header("Location: ../index.php");
	}else{	$_SESSION['loginError']= "E-Mail oder Passwort ist falsch";
		header("location: ../start.php");
	}
?>
