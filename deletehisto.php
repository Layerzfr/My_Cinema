<?php
include 'edithistorique.php';

?>
<?php
$film = $_GET['film'];
$id = $_GET['id'];
$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$retour = $conn->query('DELETE FROM historique_membre where id_membre ='.$id.' and id_film ='.$film.'');

?>