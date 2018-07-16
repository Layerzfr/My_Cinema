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
	echo "<button type='submit' id='buttonavis' name='submit-del'>Ajouter cet avis au film</button>";
	echo "</form>";
	$retour = $conn->query("UPDATE historique_membre set avis ='$avis' where id_membre =$id and id_film =$idfilm");
	?>
</div>
</body>
</html>