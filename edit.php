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
<div class="dernierfilm" id="confirm">
	<?php

	$nom = $_GET['nom'];
	$prenom = $_GET['prenom'];
	$retour = $conn->query("UPDATE membre LEFT OUTER JOIN fiche_personne on membre.id_fiche_perso=fiche_personne.id_perso SET id_abo=NULL WHERE fiche_personne.nom='$nom' AND fiche_personne.prenom='$prenom' ");
	echo "<p>Abonnement supprimé!</p>";
	echo "<a href='membre.php'>Retour</a>";

	?>
</div>
</body>
</html>