<div id="section">
    <h1>Les derniers articles:</h1>
    <?php
    // Connexion à la base de données
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
    } catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }
    
    // On récupère les 5 derniers billets
    $req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_crea, \'%d/%m/%Y\') AS date_creation_fr FROM billets ORDER BY date_crea DESC LIMIT 0, 10');
     
    while ($donnees = $req->fetch()) {
    ?>

    <h3>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>le <?php echo $donnees['date_creation_fr']; ?></em>
    </h3>
     
    <p>
    <?php
    // On affiche le contenu du billet
    echo nl2br(htmlspecialchars($donnees['contenu']));
    ?>
    <br />
    <em><a href="article.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a></em>
    </p>
<?php
    } // Fin de la boucle des billets
    $req->closeCursor();
?>
</div>