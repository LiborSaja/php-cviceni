<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>O webu</title>
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
    <div class="container text-center my-5">
    <div class="p-5 bg-light rounded shadow-lg">
        <pre class="mt-4">
 

    ██╗  ██╗███╗   ██╗██╗██╗  ██╗ ██████╗ ███████╗██████╗  █████╗      ██╗███████╗██╗  ██╗ █████╗     
    ██║ ██╔╝████╗  ██║██║██║  ██║██╔═══██╗██╔════╝██╔══██╗██╔══██╗     ██║╚══███╔╝██║ ██╔╝██╔══██╗    
    █████╔╝ ██╔██╗ ██║██║███████║██║   ██║███████╗██████╔╝███████║     ██║  ███╔╝ █████╔╝ ███████║    
    ██╔═██╗ ██║╚██╗██║██║██╔══██║██║   ██║╚════██║██╔═══╝ ██╔══██║██   ██║ ███╔╝  ██╔═██╗ ██╔══██║    
    ██║  ██╗██║ ╚████║██║██║  ██║╚██████╔╝███████║██║     ██║  ██║╚█████╔╝███████╗██║  ██╗██║  ██║    
    ╚═╝  ╚═╝╚═╝  ╚═══╝╚═╝╚═╝  ╚═╝ ╚═════╝ ╚══════╝╚═╝     ╚═╝  ╚═╝ ╚════╝ ╚══════╝╚═╝  ╚═╝╚═╝  ╚═╝    
                                                                                                       
        </pre>
        <h1 class="display-4">Vítejte v knihošpajzce!</h1>
        <p class="lead mt-4">U nás najdete existující i neexistující knihy všech žánrů a autorů.</p>
        <p>Můžete je vyhledávat nebo přidávat nové knihy do databáze.</p>
        <p class="text-danger">Limit databáze je 100 knih. Pokud je limit naplněn, o čemž budete informováni, odstraňte některé knihy, abyste mohli přidat nové.</p>
        <a href="searchBooks.php" class="btn btn-primary btn-lg mt-3">Vyhledat knihy</a>
        <a href="add.php" class="btn btn-success btn-lg mt-3">Přidat novou knihu</a>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
