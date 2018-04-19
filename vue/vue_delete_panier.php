<?php
/**
 * Created by PhpStorm.
 * User: Johan.VOLAND
 * Date: 19.04.2018
 * Time: 10:28
 */

ob_start();
$titre = 'Rent A Snow - Suppression panier';
?>

<header>
    <h2>Supression</h2>
    <p>Votre article a été supprimé</p>
</header>

<?php
$contenu=ob_get_clean();
require "gabarit.php";