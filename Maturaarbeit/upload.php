<?php
$title="GPX Upload";
include 'header.php';
include 'db.php';
?>
<h1>GPX Upload</h1>
<div id="uploadError">
	<?php
		if(isset($_SESSION['uploadError'])){
			echo $_SESSION['uploadError'];
		}
	?>
</div>
<div id="upload">
	<form action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
		<input class="upload" type="text" name="title" placeholder="Titel"><br>
		<input class="upload" type="text" name="description" placeholder="Beschreibung"><br>
		<select name="sport">
			<option selected="selected" value="null">Wähle eine Sportart</option>
			<option value="jogging">Joggen</option>
			<option value="hiking">Wandern</option>
			<option value="biking">Biken</option>
			<option value="skiing">Skifahren</option>
			<option value="skitour">Skitour</option>
			<option value="hochtour">Hochtour</option>
		</select><br>
		<input class="upload" type="hidden" name="MAX_FILE_SIZE" value="50000000"><br> <!-- Maximal 50 Megabyte -->
		<input class="upload" type="file" name="xml" id="xml" placeholder="Aktivität"><br>
		<input class="upload" type="submit" name="upload" value="hochladen"><br><br>
	</form>
</div>

</body>
</html>
