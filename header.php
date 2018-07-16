<?php
include_once 'dossier/connexion.php';
?>

<!DOCTYPE html>
<html lang="en">
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