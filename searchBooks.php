<?php
include('./DbConnect.php');
require_once('Books.php');

$conn = new DbConnect(); 
$dbConnection = $conn->connect(); 

$instanceBooks = new Books($dbConnection);

if(isset($_GET['jmeno']) || isset($_GET['prijmeni']) || isset($_GET['nazev_knihy']) || isset($_GET['isbn'])){
    $selectedJmeno = $_GET['jmeno'];
    $selectedPrijmeni = $_GET['prijmeni'];
    $selectedNazev = $_GET['nazev_knihy'];
    $selectedIsbn = $_GET['isbn'];
    $selectedBooks = $instanceBooks->filterBooks($selectedJmeno, $selectedPrijmeni, $selectedNazev, $selectedIsbn);
} else {
    $selectedBooks = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Vyhledávání knih</title>
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
        <h2>Vyhledávání</h2>
        <form action="searchBooks.php" method="get">
            <input type="text" name="jmeno" class="form-control my-2" placeholder="Vyhladání dle jména autora">
            <input type="text" name="prijmeni" class="form-control my-2" placeholder="Vyhladání dle příjmení autora">
            <input type="text" name="nazev_knihy" class="form-control my-2" placeholder="Vyhledání dle názvu knihy">
            <input type="text" name="isbn" class="form-control my-2" placeholder="Vyhledání dle ISBN">
            <input class="btn btn-primary" type="submit" value="Vyhledat">
        </form>
        <?php if(!empty($selectedBooks)): ?>
        <table class="table mt-4">
            <tr>
                <th>ID</th>
                <th>Jméno autora</th>
                <th>Příjmení autora</th>
                <th>Název knihy</th>
                <th>Popis knihy</th>
                <th>ISBN</th>
            </tr>
            <?php foreach ($selectedBooks as $book): ?>
            <tr>
                <td><?php echo $book['id'] ?></td>
                <td><?php echo $book['jmeno'] ?></td>
                <td><?php echo $book['prijmeni'] ?></td>
                <td><?php echo $book['nazev_knihy'] ?></td>
                <td><?php echo $book['popis_knihy'] ?></td>
                <td><?php echo $book['isbn'] ?></td>
            </tr>
            <?php endforeach ?>
        </table>
        <?php endif ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
