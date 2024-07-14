
<?php
include 'db.php';

$article_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$query = $pdo->prepare("SELECT * FROM Article WHERE id = :article_id");
$query->execute(['article_id' => $article_id]);
$article = $query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($article['titre']); ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Actualités polytechniciennes</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="articles.php?categorie=1">Sport</a></li>
            <li><a href="articles.php?categorie=2">Santé</a></li>
            <!-- Ajoutez d'autres liens de catégories ici -->
        </ul>
    </nav>
    <main>
        <?php if ($article): ?>
            <h2><?php echo htmlspecialchars($article['titre']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($article['contenu'])); ?></p>
            <p>Créé le : <?php echo $article['dateCreation']; ?></p>
            <?php if ($article['dateModification']): ?>
                <p>Modifié le : <?php echo $article['dateModification']; ?></p>
            <?php endif; ?>
        <?php else: ?>
            <p>Article non trouvé.</p>
        <?php endif; ?>
    </main>
</body>
</html>