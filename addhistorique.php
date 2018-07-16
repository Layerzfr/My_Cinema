<?php
include_once 'dossier/connexion.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>My Cinema</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<header>
		<div class="top">
			<h1>
				Mon cinema
			</h1>
			<a href="index.php">
				Accueil
			</a>
			<a href="abonnement.php">
				Abonnement
			</a>
			<a href="reduction.php">
				Réductions
			</a>
			<a href="membre.php">
				Utilisateurs
			</a>
			<div class="search">
				<form action="search.php" class="formulaire" method="GET">
					<input name="search" class="champ" type="text" placeholder="Rechercher un film..."/>
					<button type="submit" name="submit-search">Rechercher</button>
					<select name="genre">
						<option value="none">all genre</option>
						<?php
						include_once "dossier/connexion.php";
						$retour = $conn->query('SELECT * FROM genre');
						$i=0;
						while ($row = $retour->fetch()){
							echo "<option value ='" . $i . "'>" . $row['nom'] ."</option>";
							$i++;
						}
						?>
					</select>
					<select name="distrib">
						<option value="none">all distrib</option>
						<?php
						include "dossier/connexion.php";
						$retour = $conn->query('SELECT * FROM distrib');
						$i=0;
						while ($row = $retour->fetch()){
							echo "<option value ='" . $i . "'>" . $row['nom'] ."</option>";
							$i++;
						}
						?>
					</select>
					<select name="i">
						<option value="5">5</option>
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="20">20</option>
						<option value="25">25</option>
					</select>
				</form>
			</div>
		</div>
	</header>
<?php
$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$id = $_GET['id'];
$genre = $_GET['genre'];
$distrib = $_GET['distrib'];
$items = isset($_GET['i']) ? ($_GET['i']) : 5;
$page = isset($_GET['p']) ? ($_GET['p']) : 0;
$search = $_GET['search'];
?>

<div class="dernierfilm">
	<div class="resultatfilm">
		<h2>Ajouter un film à l'historique de <?php echo $prenom . " " . $nom ?> </h2>
		<?php
		echo "<form action='addhistorique.php?nom=".$nom."&prenom=".$prenom."&id=".$id."&p=".$page."&i=".$items."&search=".$search."&genre=".$genre."&distrib=".$distrib."' method='GET'>";
		?>
		<select class="non" name="prenom">
			<?php
			echo "<option value='".$prenom."'>".$prenom."</option>";
			?>
		</select>
		<select class="non" name="nom">
			<?php
			echo "<option value='".$nom."'>".$nom."</option>";
			?>
		</select>
		<select class="non" name="id">
			<?php
			echo "<option value='".$id."'>".$id."</option>";
			?>
		</select>

		<input name="search" class="champ" type="text" placeholder="Rechercher un film..."/>
		<button type="submit" name="submit-search">Rechercher</button>
		<select name="genre">
			<option value="none">all genre</option>
			<?php
			include_once "dossier/connexion.php";
			$retour = $conn->query('SELECT * FROM genre');
			$i=0;
			while ($row = $retour->fetch()){
				echo "<option value ='" . $i . "'>" . $row['nom'] ."</option>";
				$i++;
			}
			?>
		</select>
		<select name="distrib">
			<option value="none">all distrib</option>
			<?php
			include "dossier/connexion.php";
			$retour = $conn->query('SELECT * FROM distrib');
			$i=0;
			while ($row = $retour->fetch()){
				echo "<option value ='" . $i . "'>" . $row['nom'] ."</option>";
				$i++;
			}
			?>
		</select>
		<select name="i">
			<option value="5">5</option>
			<option value="10">10</option>
			<option value="15">15</option>
			<option value="20">20</option>
			<option value="25">25</option>
		</select>
	</form>
	<?php
	if($page > 0){
		echo "<form action='addhistorique.php?search=".$search."&nom=".$nom."&prenom=".$prenom."&id=".$id."&genre=".$genre."&distrib=".$distrib."&i=".$items."&p=".($page - 1)."' class='formulaire' method='POST'>";
		echo "<button type='submit' name='prec' class='leftbutton'>Page précédente</button>";
		echo "</form>";
	}
	echo "<form action='addhistorique.php?search=".$search."&nom=".$nom."&prenom=".$prenom."&id=".$id."&genre=".$genre."&distrib=".$distrib."&i=".$items."&p=".($page + 1)."' class='formulaire' method='POST'>";
	echo "<button type='submit' name='suiv' class='rightbutton'>Page suivante</button>";
	echo"</form>";
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

		echo "<div class='resultatfilm'>
		<h3>".$row['titre']. "</h3>";
		echo "<h4>Id Film: ".$row['id_film']."</h4>";
		if($row['duree_min'] == 0){
			echo"<p>Durée: inconnue</p>";
		}
		else{
			echo "<p>Durée: ".$row['duree_min']." minutes</p>";
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
		$retour2 = $conn->query("SELECT count(id_film) as count from historique_membre where id_film=".$row['id_film']." and id_membre=".$id."");
		$row2 = $retour2->fetch();
		if($row2['count'] == 0){

			echo "<form action='addsuccess.php?nom=".$nom."&prenom=".$prenom."&id=".$id."&p=".$page."&i=".$items."&search=".$search."&genre=".$genre."&distrib=".$distrib."&idfilm=".$row['id_film']."' method='POST'>";
			echo "<button type='submit' name='suiv' >Ajouter le film</button>";
			echo"</form>";
		}else{
			echo"<p>Film déjà dans l'historique</p>";
		}
		echo "</div>";
	}
	?>
</div>
</body>
</html>