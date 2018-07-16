<?php

include 'header.php';

?>
<div class="dernierfilm">
	<?php
	$id = $_GET['id'];
	$nom = $_GET['nom'];
	$prenom = $_GET['prenom'];
	$avis = $_POST['textarea'];
	$idfilm = $_GET['idfilm'];
	echo "<form action='avissuccess.php?nom=".$nom."&prenom=".$prenom."&id=".$id."&idfilm=".$idfilm."' method='POST'>";
	echo "<textarea name='textarea' rows='10' cols='50'></textarea>";
	echo "<button type='submit' name='submit-del'>Ajouter cet avis au film</button>";
	echo "</form>";
	$retour = $conn->query("UPDATE historique_membre set avis ='$avis' where id_membre =$id and id_film =$idfilm");
	?>
</div>
<div class="dernierfilm">
	<?php
	$avis = $_POST['avis'];
	$id = $_GET['id'];
	$idfilm = $_GET['idfilm'];
	$prenom = $_GET['prenom'];
	$nom = $_GET['nom'];
	echo "<p>Avis ajouté</p>";
	echo "<a href='historiquefilm.php?nom=".$nom."&prenom=".$prenom."&id=".$id."'>Retour à l'historique de ".$prenom." ".$nom."</a>";

	?>	
</div>
</body>
</html>