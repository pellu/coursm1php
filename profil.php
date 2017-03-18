<?php
// Ce fichier et un peu la boite à outil pour les pages
require_once('inc/init.inc.php');

if(!userConnecte()){
	header('location:connexion.php');
}

// extract() me permet de transformer les valeurs d'un array en variables... pratique, non ?
extract($_SESSION['membre']);

// Cela permet de pouvoir faire une modification sur un fichier qui ce générera sur toutes mes pages de mon site
require_once('inc/header.inc.php');
?>

<h1>Profil de <?= $pseudo ?></h1>

<div class="profil_img">
	<img src="img/default.jpg"/>
</div>

<div class="profil_infos">
	<ul>
		<li>Pseudo : <b><?= $pseudo ?></b></li>
		<li>Prénom : <b><?= $prenom ?></b></li>
		<li>Nom : <b><?= $nom ?></b></li>
	</ul>
</div>

<div class="profil_adresse">
	<ul>
		<li>Adresse : <b><?= $adresse ?></b></li>
		<li>Code Postal : <b><?= $code_postal ?></b></li>
		<li>Ville : <b><?= $ville ?></b></li>
	</ul>
</div>


<?php
// Cela permet de pouvoir faire une modification sur un fichier qui ce générera sur toutes mes pages de mon site
require_once('inc/footer.inc.php');
?>