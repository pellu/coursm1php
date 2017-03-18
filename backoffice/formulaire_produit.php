<?php
require_once('../inc/init.inc.php');

if(!userAdmin()){
	header('location:../connexion.php');
}

if($_POST){

	$nom_photo='default.jpg';
	if(isset($_POST['photo_actuelle'])){
		$nom_photo=$_POST['photo_actuelle'];
	}

	if(!empty($_FILES['photo']['name'])){
		$nom_photo=$_POST['reference'].'_'.$_FILES['photo']['name'];

		$chemin_photo= RACINE_SERVEUR.RACINE_SITE.'photo/'.$nom_photo;
		copy($_FILES['photo']['tmp_name'], $chemin_photo);
	}
	
	if(isset($_GET['id'])){
		$resultat=$pdo->prepare('REPLACE INTO produit (id_produit, reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUE (:id_produit, :reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock)');
		$resultat->bindParam(':id_produit', $_GET['id'], PDO::PARAM_INT);
	}else{
		$resultat=$pdo->prepare('INSERT INTO produit (reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUE (:reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock)');
	}

	$resultat->bindParam(':reference', $_POST['reference'], PDO::PARAM_STR);
	$resultat->bindParam(':categorie', $_POST['categorie'], PDO::PARAM_STR);
	$resultat->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
	$resultat->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
	$resultat->bindParam(':couleur', $_POST['couleur'], PDO::PARAM_STR);
	$resultat->bindParam(':taille', $_POST['taille'], PDO::PARAM_STR);
	$resultat->bindParam(':public', $_POST['public'], PDO::PARAM_STR);
	$resultat->bindParam(':photo', $nom_photo, PDO::PARAM_STR);

	$resultat->bindParam(':prix', $_POST['prix'], PDO::PARAM_INT);
	$resultat->bindParam(':stock', $_POST['stock'], PDO::PARAM_INT);

	if($resultat -> execute()){
		header('location:gestion_produit.php');
	}
}

if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
	$resultat=$pdo->prepare("SELECT * FROM produit WHERE id_produit=:id");
	$resultat->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
	$resultat->execute();

	if($resultat->rowCount() > 0){
		$produit_actuel=$resultat->fetch(PDO::FETCH_ASSOC);
		debug($produit_actuel);
		echo $_GET['id'];
	}
}

$reference= (isset($produit_actuel)) ? $produit_actuel['reference'] : '';
$categorie= (isset($produit_actuel)) ? $produit_actuel['categorie'] : '';
$titre= (isset($produit_actuel)) ? $produit_actuel['titre'] : '';
$description= (isset($produit_actuel)) ? $produit_actuel['description'] : '';
$couleur= (isset($produit_actuel)) ? $produit_actuel['couleur'] : '';
$taille= (isset($produit_actuel)) ? $produit_actuel['taille'] : '';
$public= (isset($produit_actuel)) ? $produit_actuel['public'] : '';
$photo= (isset($produit_actuel)) ? $produit_actuel['photo'] : '';
$prix= (isset($produit_actuel)) ? $produit_actuel['prix'] : '';
$stock= (isset($produit_actuel)) ? $produit_actuel['stock'] : '';

$action= (isset($produit_actuel)) ? 'Modifier' : 'Ajouter';

require_once('../inc/header.inc.php');
?>
<h1><?= $action ?> un produit</h1>

<form action="" method="post" enctype="multipart/form-data">
	<label>Référence :</label><br>
	<input type="text" name="reference" value="<?= $reference ?>"><br><br>

	<label>Catégorie :</label><br>
	<input type="text" name="categorie" value="<?= $categorie ?>"><br><br>

	<label>Titre :</label><br>
	<input type="text" name="titre" value="<?= $titre ?>"><br><br>

	<label>Description :</label><br>
	<textarea rows="10" cols="30" name="description"><?= $description ?></textarea><br><br>

	<label>Couleur :</label><br>
	<input type="text" name="couleur" value="<?= $couleur ?>"><br><br>

	<label>Taille :</label><br>
	<input type="text" name="taille" value="<?= $taille ?>"><br><br>

	<label>Public :</label><br>
	<select name="public">
		<option <?php if($public == 'm'){echo "selected";} ?> value="m">Homme</option>
		<option <?php if($public == 'f'){echo "selected";} ?> value="f">Femme</option>
		<option <?php if($public == 'mixte'){echo "selected";} ?> value="mixte">Mixte</option>
	</select><br><br>

	<?php if(isset($produit_actuel)) : ?>3
		<img src="<?= RACINE_SITE.'photo/'.$photo ?>" width="100"><br><br>
		<input type="hidden" name="photo_actuelle" value="<?= $photo ?>">
	<?php endif; ?>
	<label>Photo :</label><br>
	<input type="file" name="photo"><br><br>

	<label>Prix :</label><br>
	<input type="text" name="prix" value="<?= $prix ?>"><br><br>

	<label>Stock :</label><br>
	<input type="text" name="stock" value="<?= $stock ?>"><br><br>
	
	<input type="submit" value="Ajouter">
</form>

<?php
require_once('../inc/footer.inc.php');
?>