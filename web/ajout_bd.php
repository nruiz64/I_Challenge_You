<?php
 
/*
 Requete HTTP Post 
 */
 
// tableau de reponse JSON
$reponse = array();
 
// tester si les champs sont valides
//if (isset($_POST['editTextPseudo']) && isset($_POST['editTextAge']) && isset($_POST['editTextEmail']) && isset($_POST['editTextPassword']) && isset($_POST['editTextSexe'])) {
 if (isset($_POST['editTextPseudo']) && isset($_POST['editTextEmail']) && isset($_POST['editTextPassword'])) {
    $valeur_pseudo = $_POST['editTextPseudo'];
    $valeur_age = $_POST['editTextAge'];
    $valeur_email = $_POST['editTextEmail'];   
	$valeur_password = $_POST['editTextPassword'];
	$photo_profil = $_POST['nomImage'];
	$valeur_password = md5($valeur_password);
	
	$valeur_sexe = $_POST['editTextSexe'];
 
    // inclure la classe de connexion
    require_once __DIR__ . '/connexion.php';
 
    // connxion à la base
    $db = new CONNEXION_DB ();
 
    // requéte pour insérer les données
   // $resultat = mysql_query("INSERT INTO utilisateur(mail, password, pseudo,age,sexe) VALUES('$valeur_email', '$valeur_password', '$valeur_pseudo', '$valeur_age','$valeur_sexe')");
 $resultat = mysql_query("INSERT INTO utilisateur(mail, password, pseudo,sexe,age,dateInscription,totalPoints,avatar) 
 VALUES('$valeur_email', '$valeur_password', '$valeur_pseudo','$valeur_sexe','$valeur_age',NOW(),0,'$photo_profil')");
    // tester si les données sont bien insérées
    if ($resultat) {
        // Données bien insérées
        $reponse["success"] = 1;
        $reponse["message"] = "Données bien insérées";
 
       // afficher  la reponse JSON
        echo json_encode($reponse);
    } else {
        // failed to insert row
        $reponse["success"] = 0;
        $reponse["message"] = "Oops! Erreur d'insertion.";
 
      // afficher  la reponse JSON
        echo json_encode($reponse);
    }
} else {
    // Champ(s) manquant(s)
    $reponse["success"] = 0;
    $reponse["message"] = "Champ(s) manquant(s)";
 
    // afficher  la reponse JSON
    echo json_encode($reponse);
}
?>
