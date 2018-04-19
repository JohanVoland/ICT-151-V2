<?php
/**
 * Created by PhpStorm.
 * User: Pascal.BENZONANA
 * Date: 08.05.2017
 * Time: 09:15
 * Updated : Nicolas.Glassey
 * Date : 14.02.2018
 */


// ---------------------------------------------------------------------------------------------------------------------
// getBD()
// Fonction : connexion avec le serveur : instancie et renvoie l'objet PDO
// Sortie : $connexion

function getBD()
{
  // connexion au server de BD MySQL et à la BD
  $connexion = new PDO('mysql:host=localhost; dbname=snows', 'JohanVoland', 'yolostr@t');
  // permet d'avoir plus de détails sur les erreurs retournées
  $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $connexion;
}

// ---------------------------------------------------------------------------------------------------------------------
// Fonctions liées aux snows

// Récupérer toutes les information de la BD
function getSnows()
{
  // Connexion à la BD et au serveur
  $connexion = getBD();

  // Création de la string pour la requête
  $requete = "SELECT * FROM tblsurfs ORDER BY idsurf;";
  // Exécution de la requête
  $afficherSnow = $connexion->query($requete);
  return $afficherSnow;
}

// ---------------------------------------------------------------------------------------------------------------------
// Connexion à un compte utilisateur lors de la connexion au login

function getLogin()
{
    // Connexion à la BD
    $connexion = getBD();

    // Requête pour sélectionner la personne loguée
    if ($_POST['fUserType'] == 'Client')
    {
        $requete = "SELECT * FROM tblclients WHERE login= '".$_POST['fLogin']."' AND passwd='".$_POST['fPass']."';";
    }
    else
    {
        $requete = "SELECT * FROM tblvendeurs WHERE login= '".$_POST['fLogin']."' AND passwd='".$_POST['fPass']."';";
    }

    // Exécution de la requête et renvoi des résultats
    $login = $connexion->query($requete);

    return $login;
}

// ---------------------------------------------------------------------------------------------------------------------
// Ajouter un nouveau snow dans la BD (ATTENTION il y a de petites notes)

function add($variableGlobal) // NOTE : le $variableGlobal entre parenthèse permet de récup. les variables du $_POST
{
    // Connexion à la BD
    $connexion = getBD();

    // NOTE : les varables sont facultatives à cause du $variableGlobal en haut on peut mettre directement $variableGlobal['fmarque'] dans la requête SQL
    // Récupérer les entrées du formulaire
    $marque = @$_POST['fmarque'];
    $boots = @$_POST['fboots'];
    $type = @$_POST['ftype'];
    $dispo = @$_POST['fdispo'];
    $fid = @$_POST['fid'];
    $statut = null;

    // Définition de la requête
    $req = "INSERT INTO tblsurfs (idsurf, marque, boots, type, disponibilite, statut) VALUES ('$fid', '$marque', '$boots', '$type', '$dispo', '$statut')";

    // Application de la requête
    $ajouterSnow = $connexion->exec($req);

    // Sert en fait surtout pour vérifier l'application variable
    return $ajouterSnow;
}

// ---------------------------------------------------------------------------------------------------------------------
// Supprimer un snow de la BD

function deleteSnow()
{
    // Connexion à la BD
    $connexion = getBD();

    // Récupération de l'ID
    $ID = $_GET['fid'];

    $req_suppr = "DELETE FROM tblsurfs WHERE idsurf='".$ID."'";
    $connexion->exec($req_suppr);
}

// ---------------------------------------------------------------------------------------------------------------------
// Modifie les informations d'un snow de la BD

function modifSnow()
{
    // Connexion à la BD
    $connexion = getBD();

    // Récupération des champs
    $marque = $_POST['modifmarque'];
    $boots = $_POST['modifBoots'];
    $type = $_POST['modifType'];
    $dispo = $_POST['modifDispo'];
    $ID = $_POST['modifID'];


    // Création de la requête
    $requete = "UPDATE tblsurfs SET marque='".$marque."',boots='".$boots."', type='".$type."',disponibilite='".$dispo."' WHERE idsurf='".$ID."';";

    // Application de la requête
    $connexion->exec($requete);
}

// ---------------------------------------------------------------------------------------------------------------------
// Sélectionner un seul snow selon son ID

function selectSnow()
{
    $ID = $_SESSION['idSnow'];
    $connexion= getBD();
    $requete= "SELECT * FROM tblsurfs WHERE idsurf='".$ID."';";

    $selectSnow = $connexion->query($requete);

    return $selectSnow;
}

// ---------------------------------------------------------------------------------------------------------------------
// Sélectionner les données relatives au panier dans la BD

function getPanier()
{
    // Connexion à la BD
    $connexion = getBD();

    // Création de la requête
    $req = "SELECT * FROM tbllocationsurf ORDER BY idLocationSurf";

    // Application de la requête
    $afficherPanier = $connexion->query($req);

    return $afficherPanier;
}

// ---------------------------------------------------------------------------------------------------------------------
// Ajouter un article dans le panier

// Ajouter un article dans le panier
function addPanierBD()
{
    // Connexion à la BD
    $connexion = getBD();

    // Récupérer les données du formulaire
    $nbreDeJours = $_POST['nbreDeJours'];
    $quantite = $_POST['quantite'];
    $idlocation = $_POST['idlocation'];
    // $idLocationSurf = $_SESSION['idLocationSurf'];

    $idSnow = $_SESSION['idSnow'];

    // Création de la requête
    $requete = "INSERT INTO tbllocationsurf (idsurf, idLocation, nbreJours, quantite) VALUES ('$idSnow', '$idlocation', '$nbreDeJours', '$quantite')";

    // Application de la requête
    $addPanier = $connexion->exec($requete);

    return $addPanier;
}

// ---------------------------------------------------------------------------------------------------------------------
// Sélectionner un arcticle du panier
function selectLocation()
{
    // Récupération de l'ID de la location
    $ID = $_SESSION['idLocation'];

    // Connexion à la BD
    $connexion = getBD();

    // Définition de la requête
    $requete = "SELECT * FROM tbllocationsurf WHERE idLocationSurf = '".$ID."'";

    // Application de la requête
    $selectLocationSurf = $connexion->query($requete);
    return $selectLocationSurf;
}

// ---------------------------------------------------------------------------------------------------------------------
// Modifier le panier

function modifPanierBD()
{
    // Connexion à la BD
    $connexion = getBD();

    // Récupération des données du formulaire
    $idLocationSurf = $_POST['modifPanieridLocationSurf'];
    $nbrejours = $_POST['modifPaniernbreJours'];
    $quantite = $_POST['modifPanierquantite'];

    // Création de la requête
    $requete = "UPDATE tbllocationsurf SET nbreJours='".$nbrejours."', quantite ='".$quantite."' WHERE idLocationSurf='".$idLocationSurf."';";

    // Application de la requête
    $connexion->exec($requete);
}

// ---------------------------------------------------------------------------------------------------------------------
// Supprimer un article du panier

function deletePanierBD()
{
    // Connexion à la BD
    $connexion = getBD();

    // Récup de l'ID
    $ID = $_GET['idLocation'];

    // Création de la requête
    $req_suppr = "DELETE FROM tbllocationsurf WHERE idLocationSurf ='".$ID."'";

    // Application de la requête
    $connexion->exec($req_suppr);
}