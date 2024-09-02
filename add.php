<?php

//Výpis aut
include('./DbConnect.php');
require_once('Books.php');

//tvorba instance pro připojení do db a volání metody, která vytvoří připojení
$conn = new DbConnect(); 
$dbConnection = $conn->connect(); 

//tvorba instance Cars, jako parametr konstruktoru předáme připojení do db
$instanceBooks = new Books($dbConnection);

//hlídání zda je v globálním poli klíč add - pokud ano, zavolá se metoda addCar
if(isset($_POST['add'])){
    $bookId = $_POST['id'];
    $jmeno = $_POST['jmeno'];
    $prijmeni = $_POST['prijmeni'];
    $nazev_knihy = $_POST['nazev_knihy'];
    $popis_knihy = $_POST['popis_knihy'];
    $isbn = $_POST['isbn'];
    $instanceBooks->addBook($jmeno, $prijmeni, $nazev_knihy, $popis_knihy, $isbn);
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
            <form action="add.php" method="post">
                
                <input type="text" name="jmeno" value="" class="form-control my-2" required placeholder="Zadejte jméno autora">
                <input type="text" name="prijmeni" value="" class="form-control my-2" required placeholder="Zadejte příjmení autora">
                <input type="text" name="nazev_knihy" value="" class="form-control my-2" required placeholder="Zadejte název knihy">
                <input type="text" name="popis_knihy" value="" class="form-control my-2" required placeholder="Krátký popis knihy">
                <input type="text" name="isbn" value="" class="form-control my-2" required placeholder="Zadejte ISBN knihy">
                <input type="submit" value="Přidat" class="btn btn-primary my-2" name="add">
            </form>        
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>