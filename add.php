<?php

//Výpis aut
include('./DbConnect.php');
require_once('Books.php');

//tvorba instance pro připojení do db a volání metody, která vytvoří připojení
$conn = new DbConnect(); 
$dbConnection = $conn->connect(); 

//tvorba instance Cars, jako parametr konstruktoru předáme připojení do db
$instanceBooks = new Books($dbConnection);

$limit = '';

//hlídání zda je v globálním poli klíč add - pokud ano, zavolá se metoda addCar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jmeno = $_POST['jmeno'];
    $prijmeni = $_POST['prijmeni'];
    $nazev_knihy = $_POST['nazev_knihy'];
    $popis_knihy = $_POST['popis_knihy'];
    $isbn = $_POST['isbn'];

    $result = $instanceBooks->addBook($jmeno, $prijmeni, $nazev_knihy, $popis_knihy, $isbn);

    if ($result) {
        $limit = "Kniha byla úspěšně přidána.";
    } else {
        $limit = "Nelze přidat novou knihu. Byl dosažen limit 100 knih. Pro přidání dalších nejdříve některé odstraňte.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Přidání nové knihy</title>
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
            <h2 class="h2">Přidání nové knihy</h2>
            <form action="add.php" method="post" class="p-4 rounded shadow bg-light">
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label for="jmeno" class="form-label">Jméno autora</label>
            <input type="text" id="jmeno" name="jmeno" class="form-control" required placeholder="Zadejte jméno autora">
        </div>
        <div class="col-md-6">
            <label for="prijmeni" class="form-label">Příjmení autora</label>
            <input type="text" id="prijmeni" name="prijmeni" class="form-control" required placeholder="Zadejte příjmení autora">
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label for="nazev_knihy" class="form-label">Název knihy</label>
            <input type="text" id="nazev_knihy" name="nazev_knihy" class="form-control" required placeholder="Zadejte název knihy">
        </div>
        <div class="col-md-6">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" id="isbn" name="isbn" class="form-control" required placeholder="Zadejte ISBN knihy">
        </div>
    </div>
    <div class="mb-3">
        <label for="popis_knihy" class="form-label">Popis knihy</label>
        <textarea id="popis_knihy" name="popis_knihy" class="form-control" required placeholder="Krátký popis knihy" rows="4"></textarea>
    </div>
    <div class="text-end">
        <input type="submit" value="Přidat" class="btn btn-primary btn-lg" name="add">
        <p class="text-danger my-2"><?= $limit ?></p>
    </div>
</form>
       
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>