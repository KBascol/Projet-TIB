<?php

session_start();

// Connexion à la base de données
$bdd = mysql_connect("localhost", "root", "");
mysql_select_db("projet",$bdd);

if( !empty($_POST["new_pseudo"]) && !empty($_POST["new_mdp"]) && $_POST["new_mdp"]===$_POST["new_mdp_conf"] && !empty($_POST["new_mail"]) ){
    //On test le pseudo. Il doit etre unique.
    if (strlen($_POST["new_pseudo"]) < 3 || strlen($_POST["new_pseudo"]) > 20) {
        echo ("<p>Le pseudo n'est pas valide.</p> <a href='../enregistrement.php'>Retour</a>");
        exit;
    } else {
        $sql = "SELECT * FROM membres WHERE membre_pseudo = '".mysql_real_escape_string($_POST["new_pseudo"])."'";
        $result = mysql_query($sql) or die("Oups! Erreur SQL !<br>".$sql."<br>".mysql_error());
        if(mysql_num_rows($result) > 0){
            echo ("<p>Le pseudo est déjà pris, choisissez en un autre svp.</p> <a href='../enregistrement.php'>Retour</a>");
            exit;
        }
    }
    //Fin test du pseudo.
    
    //On test le mot de passe. Il doit y avoir au moins un chiffre et une majuscule. Il doit y avoir plus de 6 caractères et moins de 40.
    if(strlen($_POST["new_mdp"]) < 6) {
        echo ("<p>Le mot de passe est trop court</p> <a href='../enregistrement.php'>Retour</a>");
        exit;
    } else if (strlen($_POST["new_mdp"]) > 40) {
        echo ("<p>Le mot de passe est trop long</p> <a href='../enregistrement.php'>Retour</a>");
        exit;
    } else {
        if(!preg_match('#[0-9]{1,}#', $_POST["new_mdp"])) {
            echo ("<p>Le mot de passe doit contenir au moins un chiffre.</p> <a href='../enregistrement.php'>Retour</a>");
            exit;
        } else if(!preg_match('#[A-Z]{1,}#', $_POST["new_mdp"])) {
            echo ("<p>Le mot de passe doit contenir au moins une majuscule.</p> <a href='../enregistrement.php'>Retour</a>");
            exit;
        }
    }
    //Fin du test du mot de passe.
    
    //On test l'adresse mail. Elle doit etre unique.
    if($_POST["new_mail"] == '') {
        echo ("<p>L'adresse mail n'est pas valide.</p> <a href='../enregistrement.php'>Retour</a>");
            exit;
    } else if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $_POST["new_mail"])) {
        echo ("<p>L'adresse mail n'est pas valide.</p> <a href='../enregistrement.php'>Retour</a>");
        exit;
    } else {
        $sql = "SELECT * FROM membres WHERE membre_mail = '".mysql_real_escape_string($_POST["new_mail"])."'";
        $result = mysql_query($sql) or die("Oups! Erreur SQL !<br>".$sql."<br>".mysql_error());
        if(mysql_num_rows($result) > 0) {
            echo ("<p>Vous êtes déjà inscrit avec cette adresse mail.</p> <a href='../enregistrement.php'>Retour</a>");
            exit;
        }
    }
    //Fin du test de l'adresse mail.
    
    //On insert le nouveau membre dans la base de données.
    $insertion = mysql_query("INSERT INTO membres VALUES(NULL, '".mysql_real_escape_string($_POST["new_pseudo"])."',
                '".md5($_POST["new_mdp"])."', '".mysql_real_escape_string($_POST["new_mail"])."',
                ".time().", '',
                '', '',
                '', '',
                '', '',
                '', '',
                ".time().", 0)");
                
    echo ("<p>Vous êtes maintenant inscrit sur notre site! <br/>Vous pouvez maintenant vous connecter !</p> <a href='../index.php'>Acceuil</a>");
    session_destroy();
    
} else {
    echo ("<p>Vous n'avez pas remplit tout les champs ou fait une erreur dans les mots de passe.</p> <a href='../enregistrement.php'>Retour</a>");
    exit;
}

?>