<?php
/**
 * Created by PhpStorm.
 * User: Johan.VOLAND
 * Date: 22.03.2018
 * Time: 08:40
 */

ob_start();
$titre = 'Rent A Snow - Panier';
?>

<!-- Contenu -->
<h2>Votre panier</h2>
    <table class="table textcolor">
        <tr>
            <?php
            // Affichage des entêtes du tableau (-1 pour enlever le champ statut)

            for ($i=0; $i<$afficherPanier->columnCount()-1; $i++)
            {
                $entete = $afficherPanier->getColumnMeta($i);
                echo "<th>" . $entete['name'] . "</th>";
            }
            ?>
        </tr>
        <!-- Affichage des données de la table tbllocationsurf -->
        <?php foreach ($afficherPanier as $objet) :?>
        <tr>
            <td><?=$objet['idLocationSurf'];?></td>
            <td><?=$objet['idsurf'];?></td>
            <td><?=$objet['idLocation'];?></td>
            <td><?=$objet['nbreJours'];?></td>
            <td><?=$objet['quantite'];?></td>

            <!-- Boutons pour la modification/suppression -->
            <td><a href="../index.php?action=vue_modif_panier&idLocation=<?=$objet['idLocationSurf']?>"><img src="../contenu/images/modif.png"></a></td>
            <td><a href="../index.php?action=vue_delete_panier&idLocation=<?=$objet['idLocationSurf']?>"><img src="../contenu/images/delete.jpg"></a></td>
        </tr>
        <?php endforeach; ?>
    </table>

<?php
$contenu=ob_get_clean();
require "gabarit.php";