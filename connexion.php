<?php
// Ce fichier et un peu la boite à outil pour les pages
require_once('inc/init.inc.php');

if(userConnecte()){
	header('location:profil.php');
}

// Traitements pour la connexion :
if($_POST){
	debug($_POST);

	$resultat = $pdo -> prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
	$resultat -> bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
	$resultat -> execute();

	if($resultat -> rowCount() > 0 ){ // Cela signifie que le pseudo existe bien dans ma BDD
		$membre = $resultat -> fetch(PDO::FETCH_ASSOC); // Le fetch() ùe permet de récupérer les info du membre sous forme de tableau de données ARRAY.

		if($membre['mdp'] == md5($_POST['mdp'])){ // Tout est OK, le pseudo existe et en plus le MDP tapé correspond bien au MDP dans la BDD
			/*$_SESSION['membre']['pseudo'] = $membre['pseudo'];
			$_SESSION['membre']['pseudo'] = $membre['prenom'];*/

			// Plus pratique
			foreach ($membre as $indice => $valeur) {
				$_SESSION['membre'][$indice] = $valeur;
			}

			// debug($_SESSION);
			header("location:profil.php");
		}
		else{
			$msg .= '<div class="erreur">Erreur de mot de passe !</div>';
		}
	}
	else{
		$msg .= '<div class="erreur">Erreur de pseudo !</div>';
	}

}

// Cela permet de pouvoir faire une modification sur un fichier qui ce générera sur toutes mes pages de mon site
require_once('inc/header.inc.php');
?>

<h1>Connexion</h1>
<?= $msg ?>

<form action="" method="post">
	<label>Pseudo :</label><br>
	<input type="text" name="pseudo"><br><br>

	<label>Mot de passe :</label><br>
	<input type="password" name="mdp"><br><br>

	<input type="submit" value="Inscription">
</form>

<?php
// Cela permet de pouvoir faire une modification sur un fichier qui ce générera sur toutes mes pages de mon site
require_once('inc/footer.inc.php');
?>