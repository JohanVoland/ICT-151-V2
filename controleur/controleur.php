<?php
/**
 * Created by PhpStorm.
 * User: Pascal.BENZONANA
 * Date: 08.05.2017
 * Time: 09:10
 * Updated : Nicolas.Glassey
 * Date : 14.02.2018
 */

require "modele/modele.php";

// Affichage de la page de l'accueil
function accueil()
{
  require "vue/vue_accueil.php";
}

function erreur($e)
{
  $_SESSION['erreur']=$e;
  require "vue/vue_erreur.php";
}

// ----------------- Fonctions en lien avec l'affichage des snows ------------------------------------------------------

function snows()
{
    $afficherSnow = getSnows(); // pour récupérer les données des snows dans la BD
    require 'vue/vue_snows.php';
}

// ------------------ Fonctions en lien avec le login ------------------------------------------------------------------

function login()
{
    // Si l'utilisateur à écrit des données
    if (isset ($_POST['fLogin']) && isset ($_POST['fPass']))
    {
        // Connexion au compte utilisateur
        $login = getLogin($_POST);
        require "vue/vue_login.php";
    }
    else
    {
        // détruit la session de la personne connectée après avoir appuyé sur Logout
        if (isset($_SESSION['login'])) {
            session_destroy();
            require "vue/vue_accueil.php";
        }
        // Affichage du formulaire de connexion
        else
            require "vue/vue_login.php";
    }
}

// ------------------ Fonctions en lien avec l'ajout de snow -----------------------------------------------------------

function addSnow()
{
    // Si l'utilisateur à écrit des données
    if (isset($_POST['fmarque']) && isset($_POST['fboots']) && isset($_POST['ftype']) && isset($_POST['fdispo']))
    {
        // Ajoute le snow
        $ajouterSnow = add($_POST); // NOTE : le $_POST entre parenthèse permet d'envoyer les valeurs de la variable global $_POST
        require 'vue/vue_add.php';
    }
    else
    {
        // Affiche le formulaire d'ajout
        require "vue/vue_add.php";
    }
}

// ------------------ Fonctions en lien avec la suppression de snows ---------------------------------------------------

function delete()
{
    // Sélection du snow selon son ID
    if (isset($_GET['fid'])) {
        deleteSnow();
        require "vue/vue_delete.php";
    }
    else
    {
        require "vue/vue_snows.php";
    }
}

// ------------------ Fonctions en lien avec la modification de snows --------------------------------------------------

function modif()
{
    // Sélection du snow selon son ID
    if (isset($_GET['fid']))
    {
        // Récupération et inscription du snow sélectionné
        $_SESSION['idSnow'] = $_GET['fid'];
        $selectSnow = selectSnow();
        require "vue/vue_modif.php";
        exit();
    }
    else
    {
        // Effectue le modification du snow
        modifSnow();

        // Affiche la liste des snows
        $afficherSnow = getSnows();
        require "vue/vue_snows.php";
    }
}

// ------------------ Fonctions en lien avec le panier -----------------------------------------------------------------

// Afficher le panier
function afficherPanier()
{
    // Récupération et inscription du snow sélectionné
    $afficherPanier = getPanier();
    require "vue/vue_panier.php";
}

// Ajouter un article dans la panier
function addPanier()
{
    // Si l'utilisateur a écrit des données
    if (isset($_POST['nbreDeJours']) && isset($_POST['quantite']) && isset($_POST['idlocation']))
    {
        $addPanier = addPanierBD();
        require "vue/vue_addPanier.php";
    }
    else
    {
        // Prend l'ID du snow
        $_SESSION['idSnow'] = $_GET['fid'];

        // Augmente de 1 l'ID de location du surf
       // @$_SESSION['idLocationSurf'] ++;

        $selectSnow = selectSnow();
        require "vue/vue_addPanier.php";
    }
}

// Modifier un article du panier
function modifPanier()
{
    // Sélection du snow selon son ID
    if (isset($_GET['idLocation']))
    {
        // Récupération de l'ID de la location
        $_SESSION['idLocation'] = $_GET['idLocation'];

        // Récupération de la location
        $selectLocationSurf = selectLocation();

        require "vue/vue_modif_panier.php";
        exit();
    }
    else
    {
        // Effectue le modification de la location
        modifPanierBD();

        // Affiche le panier
        afficherPanier();
    }
}

// Supprimer un article du panier
function deletePanier()
{
    // Séelction de l'srticle selon son snow
    if (isset($_GET['idLocation']))
    {
        // Application de la fonction
        deletePanierBD();
        require "vue/vue_delete_panier.php";
    }
}