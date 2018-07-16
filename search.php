<?php
include_once 'header.php';
?>
<div class="dernierfilm">
	<h2>Résultat de la recherche</h2>
</div>
<div>
	<?php
	$search = ($_GET['search']);
	$genre = $_GET['genre'];
	$distrib = $_GET['distrib'];
	$page = isset($_GET['p']) ? ($_GET['p']) : 0;
	$items = isset($_GET['i']) ? ($_GET['i']) : 10;
	echo "<div class='dernierfilm'>";
	if($page > 0){
		echo "<form action='search.php?search=".$search."&genre=".$genre."&distrib=".$distrib."&i=".$items."&p=".($page - 1)."' class='formulaire' method='POST'>";
		echo "<button type='submit' name='prec' class='leftbutton'>Page précédente</button>";
		echo "</form>";
	}
	echo "<form action='search.php?search=".$search."&genre=".$genre."&distrib=".$distrib."&i=".$items."&p=".($page + 1)."' class='formulaire' method='POST'>";
	echo "<button type='submit' name='suiv' class='rightbutton'>Page suivante</button>";
	echo"</form>";
	echo"</div>";
	echo"</div>";

	if($genre != "none" && $distrib !="none" ){
		$retour = $conn->query("SELECT *, genre.nom as nomgenre, distrib.nom as nomdistrib from film left outer join genre on film.id_genre = genre.id_genre left outer join distrib on film.id_distrib = distrib.id_distrib WHERE (CONVERT(`titre` USING utf8) LIKE '%$search%') and film.id_genre=$genre and film.id_distrib=$distrib ORDER BY titre ASC  LIMIT ".($page*$items).",".$items);
	}else if ($genre != "none" && $distrib == "none"){
		$retour = $conn->query("SELECT *, genre.nom as nomgenre, distrib.nom as nomdistrib from film left outer join genre on film.id_genre = genre.id_genre left outer join distrib on film.id_distrib = distrib.id_distrib WHERE (CONVERT(`titre` USING utf8) LIKE '%$search%') and film.id_genre=$genre ORDER BY titre ASC  LIMIT ".($page*$items).",".$items);
	}else if($genre == "none" && $distrib != "none"){
		$retour = $conn->query("SELECT *, genre.nom as nomgenre, distrib.nom as nomdistrib from film left outer join genre on film.id_genre = genre.id_genre left outer join distrib on film.id_distrib = distrib.id_distrib WHERE (CONVERT(`titre` USING utf8) LIKE '%$search%') and film.id_distrib=$distrib ORDER BY titre ASC  LIMIT ".($page*$items).",".$items);
	}
	else{
		$retour = $conn->query( "SELECT *, genre.nom as nomgenre, distrib.nom as nomdistrib from film left outer join genre on film.id_genre = genre.id_genre left outer join distrib on film.id_distrib = distrib.id_distrib WHERE (CONVERT(`titre` USING utf8) LIKE '%$search%') ORDER BY titre ASC  LIMIT ".($page*$items).",".$items);
	}
	while ($row = $retour->fetch()) {
		echo "<div class='dernierfilm'>";
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
			echo "<p>Distribution inconnue</p>";
		}else{
			echo "<p>Distribution: ".$row['nomdistrib']."</p>";
		}
		echo "</div>";
		echo "</div>";
	}
	?>
</body>
</html>