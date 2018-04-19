<?php
/**
 * Created by PhpStorm.
 * User: Pascal.BENZONANA
 * Date: 12.05.2017
 * Time: 09:36
 * Updated : Nicolas.Glassey
 * Date : 14.02.2018
 */

ob_start();
$titre = 'Rent A Snow - Nos snows';

?>

<article>
  <header>
    <h2>Nos snows</h2>

      <!-- Bouton Ajout -->
<?php if (isset($_SESSION['login']) && $_SESSION['typeUser'] == "Vendeur") :?>
      <a href="../index.php?action=vue_add"><img src="../contenu/images/add.png"></a>
<?php endif;?>
      <table class="table textcolor">
      <tr>
      <?php
        // Affichage des entêtes du tableau (-1 pour enlever le champ statut)

        for ($i=0; $i<$afficherSnow->columnCount()-1; $i++)
        {
          $entete = $afficherSnow->getColumnMeta($i);
          echo "<th>" . $entete['name'] . "</th>";
        }
      ?>
      </tr>
      <?php foreach ($afficherSnow as $resultat) :?>
        <!-- Affichage des résultats de la BD -->
          <tr>
              <td><?=$resultat['idsurf'];?></td>
              <td><?=$resultat['marque'];?></td>
              <td><?=$resultat['boots'];?></td>
              <td><?=$resultat['type'];?></td>
              <td><?=$resultat['disponibilite'];?></td>

          <!-- Si un utilisateur est connecté et selon son type d'utilisateur (client ou vendeur), affiche les bouton modifier/supprimer/ajouter au panier -->
          <?php if (isset($_SESSION['login'])) :?>
              <?php if ($_SESSION['typeUser'] == "Vendeur") :?>
              <td><a href="../index.php?action=vue_delete&fid=<?=$resultat['idsurf']?>"><img src="../contenu/images/delete.jpg"></a></td>
              <td><a href="../index.php?action=vue_modif&fid=<?=$resultat['idsurf']?>"><img src="../contenu/images/modif.png"></a></td>
              <?php endif; ?>
              <td><a href="../index.php?action=vue_addPanier&fid=<?=$resultat['idsurf']?>"><img src="../contenu/images/icone-panier.jpg"></a></td>
          </tr>
      <?php endif; endforeach;?>
    </table>
  </header>
</article>
<hr/>

<?php
  $contenu=ob_get_clean();
  require "gabarit.php";