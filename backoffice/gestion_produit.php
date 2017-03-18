<?php
require_once('../inc/init.inc.php');
require_once('../inc/header.inc.php');

if(!userAdmin()){
	header('location:../connexion.php');
}
?>
<h1>Gestion des produits</h1>
<?php
$resultat=$pdo->query("SELECT * FROM produit");
$produits=$resultat->fetchAll(PDO::FETCH_ASSOC);
?>
<table border="1">
	<tr>
		<?php for($i =0; $i < $resultat -> columnCount(); $i ++) : ?>
			<?php $colonne = $resultat -> getColumnMeta($i); ?>
			<th><?= $colonne['name'] ?></th>
		<?php endfor; ?>
		<th colspan="2">Actions</th>

	</tr>
	<?php foreach ($produits as $indice => $valeur) : ?>
		<tr>
			<?php foreach ($valeur as $indice2 => $valeur2) : ?>
				<?php if($indice2 == 'photo') : ?>
					<td><img src="<?= RACINE_SITE.'photo/'.$valeur2 ?>" height="80"></td>
				<?php else : ?>
					<td><?= $valeur2; ?></td>
				<?php endif; ?>
			<?php endforeach; ?>
			<td><a href="formulaire_produit.php?id=<?= $valeur['id_produit'] ?>"><img src="<?= RACINE_SITE ?>img/edit.png"></a></td>
			<td><a href="supprimer_produit.php?id=<?= $valeur['id_produit'] ?>"><img src="<?= RACINE_SITE ?>img/delete.png"></a></td>
		</tr>
	<?php endforeach; ?>
</table>
<a href="formulaire_produit.php" style="display: inline-block;padding: 10px;border: 2px solid red;border-radius: 3px;text-align: center;margin: 20px 0;font-weight: bold;">Ajouter un produit</a>
<?php
require_once('../inc/footer.inc.php');
?>