<?php
/**
 * Created by PhpStorm.
 * User: Johan.VOLAND
 * Date: 14.03.2018
 * Time: 15:45
 */

ob_start();
$titre = 'Rent A Snow - Ajouter un snow';
?>

    <h2>Ajouter un snow</h2>

<!-- Test du formulaire -->
<?php
if (isset($ajouterSnow))
{
    echo "Votre snow a été créé.";
}
else {
    ?>

    <form class="form" method="post" action="index.php?action=vue_add">
        <table class="table">
            <tr>
                <td>marque :</td>
                <td><input type="text" placeholder="Entrez la marque du snow" name="fmarque"
                           value="<?= @$_POST['fmarque'] ?>"></td>
                <!-- La partie php permet d'empêcher de tout retaper en cas d'erreur -->

                <td>boots :</td>
                <td><input type="text" placeholder="Entez le type de boots" name="fboots"
                           value="<?= @$_POST['fboots'] ?>"></td>
            </tr>
            <tr>
                <td>type :</td>
                <td><input type="text" placeholder="Entrez le type de snow" name="ftype"
                           value="<?= @$_POST['ftype'] ?>"></td>

                <td>disponibilite :</td>
                <td><input type="text" placeholder="Entrez le nombre de snows disponibles" name="fdispo"
                           value="<?= @$_POST['fdispo'] ?>"></td>
            </tr>
            <tr>
                <td>ID :</td>
                <td><input type="text" placeholder="Entrez un ID" name="fid" value="<?= @$_POST['fid'] ?>"></td>

                <td><input type="submit" value="confirmer"></td>
            </tr>
        </table>
    </form>

    <?php
}
$contenu=ob_get_clean();
require "gabarit.php";
?>