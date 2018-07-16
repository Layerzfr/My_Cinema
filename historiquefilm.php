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
<div class="dernierfilm">
	<?php
	$nom = ($_GET['nom']);
	$prenom = ($_GET['prenom']);
	$id = ($_GET['id']);
	$page = isset($_GET['p']) ? ($_GET['p']) : 0;
	$items = isset($_GET['i']) ? ($_GET['i']) : 5;
	if($page > 0){
		echo "<form action='historiquefilm.php?nom=".$nom."&prenom=".$prenom."&id=".$id."&i=".$items."&p=".($page - 1)."' class='formulaire' method='POST'>";
		echo "<button type='submit' name='prec' class='leftbutton'>Page précédente</button>";
		echo "</form>";
	}
	echo "<form action='historiquefilm.php?nom=".$nom."&prenom=".$prenom."&id=".$id."&i=".$items."&p=".($page +1)."' class='formulaire' method='POST'>";
	echo "<button type='submit' name='suiv' class='rightbutton'>Page suivante</button>";
	echo"</form>";
	$retour = $conn->query("SELECT * from historique_membre left outer join membre on historique_membre.id_membre=membre.id_membre left outer join film on historique_membre.id_film =film.id_film left outer join fiche_personne on membre.id_fiche_perso = fiche_personne.id_perso where(CONVERT(`nom` USING utf8) LIKE '$nom') or (CONVERT(`prenom` USING utf8) LIKE '$prenom') order by historique_membre.date DESC LIMIT ".($page*$items).",".$items);
	$retour2 = $retour;

	echo "<div class='histo'>";
	echo "<h3>Nom: " . $nom . "</h3>";
	echo "<h3>Prenom: " . $prenom . "</h3>";
	echo "<form action='edithistorique.php?nom=".$nom."&prenom=".$prenom."&id=".$id."' method='POST'>";
	echo "<button type='submit' name='edit'>Editer l'historique</button>";
	echo "</form>";
	while($row = $retour->fetch()){
		echo "<div class='film'>";
		echo "<p>Film: " . $row["titre"] . "</p>";
		echo "<p>Vu le: " . substr($row["date"],0,-9) . "</p>";
		echo "<p>Avis: " . $row['avis'] . "</p>";	
		echo "<form action='avis.php?nom=".$nom."&prenom=".$prenom."&id=".$id."&idfilm=".$row['id_film']."' method='POST'>";
		echo "<button type='submit' name='avis'>Modifier/ Ajouter un avis à ce film</button>";
		echo "</form>";
		echo "</div>";
	}
	echo "</div>";

	?>
</div>
</body>
</html>