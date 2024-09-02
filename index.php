<?php 
//Výpis aut
include('./DbConnect.php');
require_once('Books.php');

//tvorba instance pro připojení do db a volání metody, která vytvoří připojení
$conn = new DbConnect(); 
$dbConnection = $conn->connect(); 

//tvorba instance Cars, jako parametr konstruktoru předáme připojení do db
$instanceBooks = new Books($dbConnection);
$books = $instanceBooks->getBooks();

//pokud jsme odeslali form pomocí metody get a jsou zadány tyto hodnoty v asoc poli _GET, spustí se část podmínky za if
//index.php?brand=neco&model=neco&reg=neco
if(isset($_GET['jmeno']) || isset($_GET['prijmeni']) || isset($_GET['nazev_knihy']) || isset($_GET['isbn'])){
    $selectedJmeno = $_GET['jmeno'];
    $selectedPrijmeni = $_GET['prijmeni'];
    $selectedNazev = $_GET['nazev_knihy'];
    $selectedIsbn = $_GET['isbn'];
    $selectedBooks = $instanceBooks->filterBooks($selectedJmeno, $selectedPrijmeni, $selectedNazev, $selectedIsbn);
//pokud jsme nic neodeslali, pak tabulka vypisuje všechna auta
} else {
    $selectedBooks = $books;
}

//mazání auta
//index.php?delete=10
if(isset($_GET['delete'])){
    $bookId = $_GET['delete'];
    $instanceBooks->deleteBook($bookId);
    header("Location: index.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>E-Knihovna</title>
</head>
<body>

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Knihy</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Seznam všech knih</a>
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
        <div class="conatiner">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Jméno autora</th>
                    <th>Příjmení autora</th>
                    <th>Název knihy</th>
                    <th>Popis knihy</th>
                    <th>ISBN</th>
                    <th colspan="2">Akce</th>
                </tr>
                <?php 
                    foreach ($selectedBooks as $book):
                ?>
                    <tr>
                        <td><?php echo $book['id'] ?></td>
                        <td><?php echo $book['jmeno'] ?></td>
                        <td><?php echo $book['prijmeni'] ?></td>
                        <td><?php echo $book['nazev_knihy'] ?></td>
                        <td><?php echo $book['popis_knihy'] ?></td>
                        <td><?php echo $book['isbn'] ?></td>
                        <td>
                            <a class="btn btn-warning" href="index.php?delete=<?php echo $book['id'] ?>">Odstranit</a>
                        </td>
                    </tr>
                <?php
                    endforeach
                ?>

            </table>
        </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>