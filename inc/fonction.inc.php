<?php

// création d'une fonction debug pour faire des print_r() :

//déclaration d'une fonction
function debug($arg){
	//Traitements...

	echo '<pre>';
	print_r($arg);
	echo '</pre>';

}

//Fonction utilisateur connecté ou pas
function userConnecte(){
	if(isset($_SESSION['membre'])){
		return TRUE;
	}else{
		return FALSE;
	}
}
//Utilisateur admin ou pas ?
function userAdmin(){
	if(userConnecte() && $_SESSION['membre']['statut'] ==1){
		return TRUE;
	}else{
		return FALSE;
	}
}

?>