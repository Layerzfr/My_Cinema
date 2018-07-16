<?php

include 'header.php';

?>
<div class="dernierfilm">
	<h3 class="soustitre">Afficher le profil d'un utilisateur</h3>
	<div class="client">
		<form action="user.php" method="POST">
			<input name="client" class="champ" type="text" placeholder="Rechercher le nom d'un client.."/>
			<button type="submit" name="submit">Rechercher</button>
		</form>
	</div>
</div>
<?php
$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$select = $_POST['subs'];
$retour = $conn->query("UPDATE membre LEFT OUTER JOIN fiche_personne on membre.id_fiche_perso=fiche_personne.id_perso SET id_abo='$select' WHERE fiche_personne.nom='$nom' AND fiche_personne.prenom='$prenom' ");
echo "<div class='dernierfilm' id='confirm'>";
echo "<p>Abonnement modifié!</p>";
echo "<a href='membre.php'>Retour</a>";
echo "</div>";


?>
</body>
</html>