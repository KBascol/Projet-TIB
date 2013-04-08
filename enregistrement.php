<?php include "includes/head.php";

if ( empty($_SESSION["ouverte"])){
    session_start();
    $_SESSION["ouverte"] = true ;
}

if (isset($_SESSION["membre_pseudo"])) {
//Si le membre est déjà connecté on le ramçne sur l'index.
    header ("Location: index.php");
} else {
?>
    <form method="post" action="includes/traitement_enregistrement.php">
        <label for="new_pseudo">Pseudo :</label><br/> <input type="text" name="new_pseudo"  maxlength="20"/><br/>
        <label for="new_mdp">Mot de passe:</label><br/> <input type="password" name="new_mdp" max_length="40"/><br/>
        <label for="new_mdp_conf">Confirmation du mot de passe:</label><br/> <input type="password" name="new_mdp_conf" max_length="40"/><br/>
        <label for="new_mail">Adresse Mail:</label><br/> <input type="mail" name="new_mail" max_length="100"/><br/>
        
        <input type="submit" value="Continuer"/>
    </form>

<?php 
}
?>

<?php include "includes/close.php";