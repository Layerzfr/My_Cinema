<?php
include_once 'header.php';
?>
<div class="dernierfilm">
	<h2 class="dernierfilm">
		Quels films passent ce soir ?
	</h2>
	<h3 class="dernierfilm">
		Les 5 films les plus récents:
	</h3>		
	<?php
	$limite = 5;
	$retour = $conn->query("SELECT *, genre.nom as nomgenre, distrib.nom as nomdistrib from film left outer join genre on film.id_genre = genre.id_genre left outer join distrib on film.id_distrib = distrib.id_distrib ORDER BY film.date_debut_affiche DESC  limit " . $limite);
	
	while ($row = $retour->fetch()) {
		echo "<div class='resultatfilm'>
		<h3>".$row['titre']. "</h3>";
		if($row['resum'] == ""){
			echo "<h5> Resumé inconnu</h5>";
		}else {
			echo "<h5> Résumé: ".$row['resum']."...</h5>";
		}
		if($row['duree_min'] == 0){
			echo"<p>Durée: inconnue</p>";
		}
		else{
			echo "<p>Durée: ".$row['duree_min']." minutes</p>";
		}
		if($row['date_debut_affiche'] == "0000-00-00"){
			echo "<p> Date de sortie inconnue";
		}else{
			echo "<p>Date de sortie: ".$row['date_debut_affiche']."</p>";
		}
		if($row['annee_prod'] == 0){
			echo "<p>Année de production inconnue";
		}else{
			echo "<p>Année de production: ".$row['annee_prod']."</p>";
		}
		if($row['nomgenre'] == NULL){
			echo "<p>Genre inconnu</p>";
		}else{
			echo "<p>Genre: ".$row['nomgenre']."</p>";
		}
		if($row['nomdistrib'] == NULL){
			echo "<p>Distribution inconnu</p>";
		}else{
			echo "<p>Distribution: ".$row['nomdistrib']."</p>";
		}
		echo "</div>";
	}
	
	?>
</div>
</body>
</html>