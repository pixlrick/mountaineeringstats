<?php
include '../header.php';
include '../db.php';
$_SESSION['uploadError'] = "";
$user_id = $_SESSION['id'];
$sport = "";
$path = "";
$content = "";

include '../db.php';
	if($_POST['sport'] != "null"){
		if($_POST['sport'] == "jogging"){
			$sport="jogging";
		}
		if($_POST['sport'] == "hiking"){
			$sport="hiking";
		}
		if($_POST['sport'] == "biking"){
			$sport="biking";
		}
		if($_POST['sport'] == "skiing"){
			$sport="skiing";
		}
		if($_POST['sport'] == "hochtour"){
			$sport="hochtour";
		}
		if($_POST['sport'] == "skitour"){
			$sport="skitour";
		}
	}else{
		$_SESSION['uploadError']="Bitte wähle eine Sportart aus";
		header("loacation: ../upload.php");
	}

	if(isset($_POST['upload']) && isset($_FILES['xml'])){
		$extension = pathinfo($_FILES['xml']['name'], PATHINFO_EXTENSION);
		echo $extension;//test

		if($extension == "gpx"){
			$type = "gpx";
			$path='activities/gpx/'.$_FILES['xml']['name'];
			echo $path;//test

			$path_inc = '../'.$path;
			copy($_FILES['xml']['tmp_name'], $path_inc);
			$file = simplexml_load_file($path_inc);
			echo $file;
		}else{
			$_SESSION['uploadError']="Bitte lade eine XML Datei hoch.";
			header("location: ../upload.php");
		}
	}else{
		$_SESSION['uploadError']="Bitte lade eine Datei hoch.";
		header("location: ../upload.php");
	}

	$time = date("Y-m-d H:i:s");
	$sql = "INSERT INTO activities (sport,type, user_id, time, path) VALUES ($sport','$type','$user_id','$time',$path)";
	$result = $conn->query($sql);

	$_SESSION['uploadError']="";
	header("location: ../profile.php");
?>
