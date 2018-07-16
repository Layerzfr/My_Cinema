<?php
include 'header.php';
$idfilm = $_GET['idfilm'];
$id = $_GET['id'];
$prenom = $_GET['prenom'];
$nom = $_GET['nom'];
$search = $_GET['search'];
$genre = $_GET['genre'];
$distrib= $_GET['distrib'];
$i= $_GET['i'];
$retour = $conn->query("INSERT INTO historique_membre values ($id, $idfilm, current_timestamp,NULL)");
echo "<div class=dernierfilm>";
echo "<p> Film ajouté avec succès !</p>";
echo "<a href='addhistorique.php?prenom=".$prenom."&nom=".$nom."&id=".$id."&search=".$search."&submit-search=&genre=".$genre."&distrib=".$distrib."&i=".$i."'> Retour</a>";
?>
</div>
</body>
</html>