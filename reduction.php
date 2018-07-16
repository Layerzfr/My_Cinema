<?php
include_once 'header.php';
?>
<div class="dernierfilm">
<h1 class="reduction">Nos réductions</h1>
<div class="search">
	<?php
	$search = ($_POST['search']);
	$retour = $conn->query("SELECT * FROM `reduction`  ORDER BY `pourcentage_reduc` ASC");
	while ($row = $retour ->fetch()) {
		echo "<div class='resultatreduction'>
		<h3>".$row['nom']. "</h3>
		<p>".$row['pourcentage_reduc']."% de réduction</p>
		</div>";
	}
	?>
</div>
</div>
</body>
</html>