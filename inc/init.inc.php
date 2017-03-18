<?php
// CONNEXION À LA BDD
$pdo = new PDO('mysql:host=localhost;dbname=coursm1php', 'root', '', array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
	PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8'
));

// SESSION START
session_start();

// VARIABLES
$msg = '';

// CHEMIN
define('RACINE_SITE', '/coursm1php/');
define('RACINE_SERVEUR', $_SERVER["DOCUMENT_ROOT"]);

// AUTRES INCLUSIONS
require_once('fonction.inc.php');
?>