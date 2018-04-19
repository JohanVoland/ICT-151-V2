<?php
/**
 * Created by PhpStorm.
 * User: Johan.VOLAND
 * Date: 19.04.2018
 * Time: 09:10
 */

ob_start();
$titre = 'Rent A Snow - Modification du panier';
$ligne=$selectLocationSurf->fetch();
?>

<header>
    <h2>Modification du panier</h2>
    <form class="form" method="post" action="index.php?action=vue_modif_panier">
        <table class="table">
            <tr>
                <td>idLocationSurf</td>
                <td>idsurf</td>
                <td>idLocation</td>
                <td>nbrejours</td>
                <td>quantite</td>
            </tr>
            <tr>
                <td><input type="text" name="modifPanieridLocationSurf" value="<?= $ligne['idLocationSurf'] ?>" readonly></td>
                <td><input type="text" name="modifPanieridsurf" value="<?= $ligne['idsurf']?>" readonly></td>
                <td><input type="text" name="modifPanieridLocation" value="<?= $ligne['idLocation']?>" readonly></td>
                <td><input type="text" name="modifPaniernbreJours" value="<?=$ligne['nbreJours']?>"></td>
                <td><input type="text" name="modifPanierquantite" value="<?=$ligne['quantite']?>"></td>
            </tr>
            <tr>
                <td><input type="submit" value="confirmer"></td>
            </tr>
        </table>
    </form>
</header>

<?php
$contenu=ob_get_clean();
require "gabarit.php";