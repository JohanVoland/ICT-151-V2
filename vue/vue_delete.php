<?php
/**
 * Created by PhpStorm.
 * User: Johan.VOLAND
 * Date: 21.03.2018
 * Time: 14:26
 */

ob_start();
$titre = 'Rent A Snow - Suppression';
?>

<header>
    <h2>Suppression du snow</h2>
    <p>Snow supprimé</p>
</header>

<?php
$contenu=ob_get_clean();
require "gabarit.php";