<?php
/**
 * Created by PhpStorm.
 * User: Johan.VOLAND
 * Date: 29.03.2018
 * Time: 08:10
 */

ob_start();
$titre = 'Rent A Snow - Ajouter au panier';
?>

<h2>Ajouter au panier</h2>

<!-- Test du formulaire -->
<?php if (isset($addPanier))
{
    echo "Votre snow a été ajouté au panier";
}
else {
    ?>

    <!-- Afficher le snow sélectionné -->
    <?php $ligne=$selectSnow->fetch(); ?>
    <h4>Snow sélectionné</h4>
    <table class="table">
        <tr>
            <td><strong>ID</strong></td>
            <td><strong>marque</strong></td>
            <td><strong>boots</strong></td>
            <td><strong>type</strong></td>
            <td><strong>disponibilité</strong></td>
        </tr>
        <tr>
            <td><?=$ligne['idsurf']?></td>
            <td><?=$ligne['marque']?></td>
            <td><?=$ligne['boots']?></td>
            <td><?=$ligne['type']?></td>
            <td><?=$ligne['disponibilite']?></td>
        </tr>
    </table>

    <!-- Formulaire pour les données de la location -->
    <br/><br/>
    <h4>Formulaire à remplir</h4>
    <form class="form" method="post" action="index.php?action=vue_addPanier">
        <table class="table">
            <tr>
                <td>Nombre de jours :</td>
                <td><input type="text" placeholder="Entrez le nombre de jours" name="nbreDeJours" value="<?= @$_POST['nbreDeJours'] ?>"></td>

                <td>Quantité :</td>
                <td><input type="text" placeholder="Entrez la quantité voulue" name="quantite" value="<?= @$_POST['quantite'] ?>"></td>
            </tr>
            <tr>
                <td>idLocation :</td>
                <td><input type="text" placeholder="Entrez un ID pour la location" name="idlocation" value="<?= @$_POST['idlocation'] ?>"></td>

                <td><input type="submit" value="confirmer"></td>
            </tr>
        </table>
    </form>

    <?php
}
$contenu=ob_get_clean();
require "gabarit.php";