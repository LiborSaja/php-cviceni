<?php
include('./DbConnect.php');
require_once('Books.php');

$conn = new DbConnect(); 
$dbConnection = $conn->connect(); 

$instanceBooks = new Books($dbConnection);
$books = $instanceBooks->getBooks();
$bookCount = $instanceBooks->getBookCount(); // Získání počtu knih

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Seznam knih</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Knihošpajzka</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">O webu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="listBooks.php">Seznam všech knih</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="searchBooks.php">Vyhledávání knih</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add.php">Přidání nové knihy</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2>Seznam všech knih</h2>
        <p>Celkový počet knih v databázi: <?= $bookCount ?></p>
        <div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Jméno autora</th>
                <th>Příjmení autora</th>
                <th>Název knihy</th>
                <th>Popis knihy</th>
                <th>ISBN</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
            <tr>
                <td><?php echo $book['id'] ?></td>
                <td><?php echo $book['jmeno'] ?></td>
                <td><?php echo $book['prijmeni'] ?></td>
                <td><?php echo $book['nazev_knihy'] ?></td>
                <td><?php echo $book['popis_knihy'] ?></td>
                <td><?php echo $book['isbn'] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
