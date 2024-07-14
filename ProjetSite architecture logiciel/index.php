
<?php
include 'db.php';

$categories_query = $pdo->query("SELECT * FROM Categorie");
$categories = $categories_query->fetchAll(PDO::FETCH_ASSOC);

$articles_query = $pdo->query("SELECT * FROM Article ORDER BY dateCreation DESC LIMIT 5");
$articles = $articles_query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Actualités polytechniciennes</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Actualités polytechniciennes</h1>
  </header>
  <nav>
    <ul>
      <li><a href="index.php">Accueil</a></li>
      <?php foreach ($categories as $categorie): ?>
          <li><a href="articles.php?categorie=<?php echo $categorie['id']; ?>">
      <?php echo htmlspecialchars($categorie['libelle']); ?>
      </a></li>
      <?php endforeach; ?>
    </ul>
  </nav>
  <main>
    <h2>Dernières actualités</h2>
    <?php if (count($articles) > 0): ?>
      <div class="articles-grid">
        <?php foreach ($articles as $article): ?>
          <div class="article-box">
            <h3><?php echo htmlspecialchars($article['titre']); ?></h3>
            <p><?php echo htmlspecialchars(substr($article['contenu'], 0, 100)); ?>...</p>
            <a href="article.php?id=<?php echo $article['id']; ?>">Lire plus</a>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p>Il n'y a pas d'articles.</p>
    <?php endif; ?>
  </main>
</body>
</html>
