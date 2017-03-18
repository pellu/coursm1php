<?php
require_once('inc/init.inc.php');

$resultat=$pdo->query("SELECT DISTINCT(categorie) FROM produit");
$cat=$resultat->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
	$resultat = $pdo -> prepare("SELECT * FROM produit WHERE id_produit = :id");
	$resultat -> bindParam(':id', $_GET['id'], PDO::PARAM_INT);
	$resultat -> execute();

	if($resultat -> rowCount() > 0){
		$produit = $resultat -> fetch(PDO::FETCH_ASSOC);
		extract($produit);
	}else{
		header('location:boutique.php');
	}
}else{
	header('location:boutique.php');
}

$resultat=$pdo->prepare("SELECT * FROM produit WHERE categorie=:categorie AND id_produit!=:id_produit");
$resultat -> bindParam(':categorie', $categorie, PDO::PARAM_STR);
$resultat -> bindParam(':id_produit', $id_produit, PDO::PARAM_STR);
$resultat -> execute();
$produits=$resultat->fetchAll(PDO::FETCH_ASSOC);

require_once('inc/header.inc.php');
?>
<div class="boutique-gauche">
	<ul>
		<?php foreach ($cat as $value) : ?>
			<li><a href="boutique.php?categorie=<?= $value['categorie'] ?>"><?= $value['categorie'] ?></a></li>
		<? endforeach; ?>
	</ul>
</div>
<div class="boutique-droite">
	<h1><?= $titre ?></h1>
	<img src="<?= RACINE_SITE . 'photo/' . $photo ?>">
	<p>Détails du produit : </p>
	<ul>
		<li>Réf : <?= $reference ?></li>
		<li>Catégorie : <?= $categorie ?></li>
		<li>Couleur : <?= $couleur ?></li>
		<li>Taille : <?= $taille ?></li>
		<li>Public : <?php if($public == 'm'){echo 'Homme';}elseif($public == 'f'){echo 'Femme';}else{echo 'Homme et Femme';} ?></li>
		<li>Prix : <b style="color: red; font-size: 20px"><?= $prix ?>€</b></li>
	</ul>

	<p>Description du produit : </p>
	<em><?= $description ?></em>
	<fieldset>
		<legend>Acheter ce produit</legend>
		<form action="" method="post">
			<select style="max-width: 100px; display: inline-block;" name="quantite">
				<option>Quantité</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
			</select>
			<input style="display: inline-block;" type="submit" value="Ajouter au panier">
		</form>
	</fieldset>
	<fieldset>
		<legend>Suggestions de produits :</legend>
		<?php foreach ($produits as $value) : ?>
			<div class="boutique-produit">
				<h3><?= $value['titre'] ?></h3>
				<a href="fiche_produit.php?id=<?= $value['id_produit'] ?>"><img src="photo/<?= $value['photo'] ?>" height="100"></a>
				<p style="font-weight: bold;font-size: 20px;color: red"><?= $value['prix'] ?> €</p>
				<p style="height: 45px"><?= $value['description'] ?></p>
				<a style="padding: 10px;border: 2px solid red;border-radius: 3px;text-align: center;margin: 20px 0;font-weight: bold;" href="fiche_produit.php?id=<?= $value['id_produit'] ?>">Lien produit</a>
			</div>
		<? endforeach; ?>
	</fieldset>
</div>
<?php
require_once('inc/footer.inc.php');
?>