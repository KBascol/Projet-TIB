
<?php include "includes/head.php"; /* Ceci est une MAJ oui oui  !^^ */?>

<div id="header">
    <?php
        session_start(); 
        if (isset($_SESSION["membre_pseudo"])) {
    ?>
            <form method="post" action="connexion.php">
            <input type="submit" value="Deconnexion"/>
            </form>
            
            <form method="post" action="monprofil.php">
            <input type="submit" value="Mon profil" />
            </form>
    <?php
            echo ("Bonjour ".$_SESSION["membre_pseudo"]." !");
        } else {
    ?>
            <form method="post" action="enregistrement.php">
            <input type="submit" value="S'enregistrer" />
            </form>
            
            <form method="post" action="connexion.php">
            <input type="submit" value="Connexion"/>
            </form>
    <?php
            echo ("Rejoignez nous !");
        }
    ?>

</div>

<?php include "includes/close.php"; ?>

<div id="aside">
    <h1>Les derniers commentaires:</h1>
</div>

<div if="footer">
</div>
    
<?php include "includes/close.php"; ?>