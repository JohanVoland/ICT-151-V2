<?php
/**
 * Created by PhpStorm.
 * User: Johan.VOLAND
 * Date: 21.03.2018
 * Time: 15:24
 */

ob_start();
$titre = 'Rent A Snow - Modification';
$ligne=$selectSnow->fetch();
?>

<header>
    <h2>Modification</h2>

    <form class="form" method="post" action="index.php?action=vue_modif">
        <table class="table">
            <tr>
                <td>marque :</td>
                <td><input type="text" placeholder="Entrez la marque du snow" name="modifmarque" value="<?= @$ligne['marque'] ?>"></td>
                <!-- La partie php permet de sélectionné les données déjà inscrites -->

                <td>boots :</td>
                <td><input type="text" placeholder="Entez le type de boots" name="modifBoots" value="<?= @$ligne['boots'] ?>"></td>
            </tr>
            <tr>
                <td>type :</td>
                <td><input type="text" placeholder="Entrez le type de snow" name="modifType" value="<?= @$ligne['type'] ?>"></td>

                <td>disponibilite :</td>
                <td><input type="text" placeholder="Entrez le nombre de snows disponibles" name="modifDispo" value="<?= @$ligne['disponibilite'] ?>"></td>
            </tr>
            <tr>
                <td>ID :</td>
                <td><input type="text" placeholder="Entrez un ID" name="modifID" value="<?= @$ligne['idsurf']?>" readonly></td>

                <td><input type="submit" value="confirmer"></td>
            </tr>
        </table>
    </form>
    </header>
<?php
$contenu=ob_get_clean();
require "gabarit.php";