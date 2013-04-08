<?php include "includes/head.php";
    session_start();
    if (empty($_SESSION["membre_pseudo"])) {
?>
    <form action="includes/traitement_connexion.php" method='post'>
            <label>Pseudo :</label> <input type="text" name="membre_pseudo" maxlength="20">
            <label>Mot de passe :</label> <input type="password" name="membre_mdp" maxlength="40">
            <input type="submit" name="submit" value="Se connecter"> <br/>
    </form>
<?php
    } else {
      $_SESSION = array();
      session_destroy();
      header("Location: index.php");
    }
include "includes/close.php";
?>