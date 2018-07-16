<?php
include_once 'header.php';
?>
<div class="dernierfilm">
	<h1 class="abonnement">Abonnement</h1>
	<div class="abonnement">

		<?php
		$search = ($_POST['search']);
		$retour = $conn->query("SELECT * FROM `abonnement` ORDER BY prix ASC");	
		while ($row = $retour->fetch()) {
			echo "<div class='resultatabonnement'>";
			echo "<h3>".$row['nom']. "</h3>
			<p>".$row['resum']."</p>
			<p>Prix: ".$row['prix']."€</p>";
			if($row['duree_abo'] == 1){
				echo "<p>Durée: ".$row['duree_abo']." jour</p>";
			}else{
				echo "<p>Durée: ".$row['duree_abo']." jours</p>";
			}
			echo "</div>";
		}
		?>
	</div>
</div>
</body>
</html>