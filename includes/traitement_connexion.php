<?php
/*Connexion à la base de données*/
$bdd = mysql_connect("localhost", "root", "");
mysql_select_db("projet",$bdd);
    
/*La methode de récupération des données est POST. On l'utilise donc ici et on verifie que les champs ne soient pas vide.*/
if(!empty($_POST["membre_pseudo"]) && !empty($_POST["membre_mdp"]) && isset($_POST["submit"])) {

  extract($_POST);
  $sql = "select membre_mdp from membres where membre_pseudo='".$membre_pseudo."'";
  $req = mysql_query($sql) or die("Oups! Erreur SQL !<br>".$sql."<br>".mysql_error());

  $data = mysql_fetch_assoc($req);

  if( $data["membre_mdp"] != md5($membre_mdp) ) {
    header("Location: ../connexion.php");
    exit;
  } else {
    /*Si le mot de passe et le pseudo correspondent on démarre une session.
    On ne s'occupe donc pas de retransmettre les données entre chaques pages.*/
    session_start();
    $_SESSION["membre_pseudo"] = $membre_pseudo;
    $sql = "UPDATE projet.membres SET membre_derniere_visite =".time()." WHERE membres.membre_pseudo = '".$membre_pseudo."'";
    $req = mysql_query($sql) or die("Oups! Erreur SQL !<br>".$sql."<br>".mysql_error());
    
    header("Location: ../index.php");
    exit;
  }
} else {
    header("Location: ../connexion.php");
    exit;
}
?>