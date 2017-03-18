<?php
require_once('inc/init.inc.php');

$resultat=$pdo->query("SELECT DISTINCT(categorie) FROM produit");
$cat=$resultat->fetchAll(PDO::FETCH_ASSOC);

$resultat=$pdo->query("SELECT * FROM produit");
$produits=$resultat->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['categorie']) && !empty($_GET['categorie'])){
	$resultat=$pdo->prepare("SELECT * FROM produit WHERE categorie=:cat");
	$resultat->bindParam(':cat', $_GET['categorie'], PDO::PARAM_STR);
	$resultat->execute();
	if($resultat->rowCount() > 0){
		$produits=$resultat->fetchAll(PDO::FETCH_ASSOC);
	}else{
		$resultat=$pdo->query("SELECT * FROM produit");
		$produits=$resultat->fetchAll(PDO::FETCH_ASSOC);
	}
}else{
	$resultat=$pdo->query("SELECT * FROM produit");
	$produit=$resultat->fetchAll(PDO::FETCH_ASSOC);
}
require_once('inc/header.inc.php');
?>
<div class="boutique-gauche">
	<ul>
		<?php foreach ($cat as $key => $value) : ?>
			<li><a href="?categorie=<?= $value['categorie'] ?>"><?= $value['categorie'] ?></a></li>
		<? endforeach; ?>
	</ul>
</div>
<div class="boutique-droite">
<h1>Boutique</h1>
	<?php foreach ($produits as $value) : ?>
	<div class="boutique-produit">
		<h3><?= $value['titre'] ?></h3>
		<a href="fiche_produit.php?id=<?= $value['id_produit'] ?>"><img src="photo/<?= $value['photo'] ?>" height="100"></a>
		<p style="font-weight: bold;font-size: 20px;color: red"><?= $value['prix'] ?> €</p>
		<p style="height: 45px"><?= $value['description'] ?></p>
		<a style="padding: 10px;border: 2px solid red;border-radius: 3px;text-align: center;margin: 20px 0;font-weight: bold;" href="fiche_produit.php?id=<?= $value['id_produit'] ?>">Lien produit</a>
	</div>
	<? endforeach; ?>
</div>
<?php
require_once('inc/footer.inc.php');
?>