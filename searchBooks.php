<?php
include('./DbConnect.php');
require_once('Books.php');

$conn = new DbConnect(); 
$dbConnection = $conn->connect(); 

$instanceBooks = new Books($dbConnection);

$error = '';
$selectedBooks = []; // Inicializace prázdného pole pro výsledky knih

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {
    // Kontrola, zda byl alespoň jeden z parametrů zadán
    if (
        (isset($_GET['jmeno']) && $_GET['jmeno'] !== '') || 
        (isset($_GET['prijmeni']) && $_GET['prijmeni'] !== '') || 
        (isset($_GET['nazev_knihy']) && $_GET['nazev_knihy'] !== '') || 
        (isset($_GET['isbn']) && $_GET['isbn'] !== '')
    ) {
        $selectedJmeno = $_GET['jmeno'];
        $selectedPrijmeni = $_GET['prijmeni'];
        $selectedNazev = $_GET['nazev_knihy'];
        $selectedIsbn = $_GET['isbn'];

        // Výsledky vyhledávání
        $selectedBooks = $instanceBooks->filterBooks($selectedJmeno, $selectedPrijmeni, $selectedNazev, $selectedIsbn);
        
        // Pokud není nalezena žádná kniha
        if (empty($selectedBooks)) {
            $error = 'Kniha nenalezena. Opakujte vyhledávání.';
        }
    } else {
        // Pokud nebylo zadáno žádné vyhledávací kritérium
        $error = 'Prosím, zadejte alespoň jedno vyhledávací kritérium.';
    }
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
        <form action="searchBooks.php" method="get" class="p-4 rounded shadow bg-light">
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label for="jmeno" class="form-label">Jméno autora</label>
            <input type="text" id="jmeno" name="jmeno" class="form-control" placeholder="Vyhladání dle jména autora">
        </div>
        <div class="col-md-6">
            <label for="prijmeni" class="form-label">Příjmení autora</label>
            <input type="text" id="prijmeni" name="prijmeni" class="form-control" placeholder="Vyhladání dle příjmení autora">
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label for="nazev_knihy" class="form-label">Název knihy</label>
            <input type="text" id="nazev_knihy" name="nazev_knihy" class="form-control" placeholder="Vyhledání dle názvu knihy">
        </div>
        <div class="col-md-6">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" id="isbn" name="isbn" class="form-control" placeholder="Vyhledání dle ISBN">
        </div>
    </div>
    <?php if (!empty($error)): ?>
        <p class="text-danger"><?= $error ?></p>
    <?php endif; ?>
    <div class="text-end">
        <input class="btn btn-primary btn-lg" type="submit" value="Vyhledat">
    </div>
</form>

        <?php if(!empty($selectedBooks)): ?>
            <div class="table-responsive mt-4">
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
        </tbody>
    </table>
</div>

        <?php endif ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
