<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fan-Motionless in White</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body background="images/back.jpg">
    <nav class="cont">
        <ul class="nav">
            <li><a href="index.html">Головна</a></li>
            <li><a href="members.html">Учасники</a></li>
            <li><a href="history.html">Історія</a></li>
            <li><a href="news.html">Новини</a></li>
            <li><a href="merch.html">Мерч</a></li>
            <li><a href="about.html">Про нас</a></li>
            <li><a href="review.php">Відгуки</a></li>
        </ul>
    </nav>
    <div class="st">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = $_POST['author'];
    $message = $_POST['message'];

    $database = new PDO("sqlite:sqlite/review.db");
    $stmt = $database->prepare("INSERT INTO review (author, message) VALUES (:author, :message)");
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':message', $message);
    $stmt->execute();

    header('Location: index.html'); 
    exit();
}
?>

<?php
$database = new PDO("sqlite:sqlite/review.db");
$stmt = $database->query("SELECT * FROM review ORDER BY date DESC");
$review = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach ($review as $reviews): ?>
    <div class="rev">
        <h3 class="mes"><?php echo $reviews['author']; ?></h3>
        <p class="mess"><?php echo $reviews['message']; ?></p>
        <p class="mess"><?php echo $reviews['date']; ?></p>
    </div>
<?php endforeach; ?>
       
    </div>
</body>
</html>


