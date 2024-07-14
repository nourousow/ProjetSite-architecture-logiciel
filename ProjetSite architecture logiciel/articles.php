
<?php
include 'db.php';

$categorie_id = isset($_GET['categorie']) ? (int)$_GET['categorie'] : 0;

$query = $pdo->prepare("SELECT * FROM Article WHERE categorie = :categorie_id");
$query->execute(['categorie_id' => $categorie_id]);
$articles = $query->fetchAll(PDO::FETCH_ASSOC);

$query = $pdo->prepare("SELECT libelle FROM Categorie WHERE id = :categorie_id");
$query->execute(['categorie_id' => $categorie_id]);
$categorie = $query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Articles de la catégorie <?php echo htmlspecialchars($categorie['libelle']); ?></title>
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
      <li><a href="articles.php?categorie=3">Education</a></li>  
      <li><a href="articles.php?categorie=4">Politique</a></li>            
     </ul>
    </nav>
  <main>
    <h2>Articles de la catégorie <?php echo htmlspecialchars($categorie['libelle']); ?></h2>
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
      <p>Il n'y a pas d'articles dans cette catégorie.</p>
    <?php endif; ?>
  </main>
</body>
</html>
