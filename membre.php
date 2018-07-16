<?php
include 'header.php';
?>
<div class="dernierfilm">
	<h3 class="soustitre">Afficher le profil d'un utilisateur</h3>
	<div class="client">
		<form action="user.php" method="GET">
			<input name="client" class="champ" type="text" placeholder="Rechercher le nom d'un client.."/>
			<button type="submit" name="submit">Rechercher</button>
		</form>
	</div>
</div>
</body>
</html>