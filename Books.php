<?php

class Books {
    private $dbConn;
    //konstruktor - předává jako parametr do databáze
    public function __construct($p_dbConn) {
        $this->dbConn = $p_dbConn;
    }

    //metoda, která vrátí všechny knihy
    public function getBooks() {
        $query = 'SELECT * FROM books';
        $stmt = $this->dbConn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //metoda hledající auta na základě zadaných parametrů
    public function filterBooks($p_jmeno, $p_prijmeni, $p_nazev_knihy, $p_isbn){
        $sql = 'SELECT * FROM books WHERE 1=1';
        $params = [];

        //přidání podmínek do dotazu podle paarametrů
        if (!empty($p_jmeno)){
            $sql .= " AND jmeno LIKE :jmeno";
            $params[':jmeno'] = '%' . $p_jmeno . '%';
        }

        if (!empty($p_prijmeni)){
            $sql .= " AND prijmeni LIKE :prijmeni";
            $params[':prijmeni'] = '%' . $p_prijmeni . '%';
        }

        if (!empty($p_nazev_knihy)){
            $sql .= " AND nazev_knihy LIKE :nazev_knihy";
            $params[':nazev_knihy'] = '%' . $p_nazev_knihy . '%';
        }

        if (!empty($p_isbn)){
            $sql .= " AND isbn LIKE :isbn";
            $params[':isbn'] = '%' . $p_isbn . '%';
        }

        //příprava sql dotazu
        $stmt = $this->dbConn->prepare($sql);

        //binding hodnot, pokud byly parametry přidány
        foreach($params as $param => $value) {
            $stmt->bindValue($param, $value, PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //mazání auta
    public function deleteBook($p_id){
        $sql = 'DELETE FROM books WHERE id = :id';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':id', $p_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    //vrácení konkrétního auta
    public function getBook($p_id){
        $sql = 'SELECT * FROM books WHERE id = :id';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':id', $p_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //funkce pro přidání nové knihy
    public function addBook($p_jmeno, $p_prijmeni, $p_nazev_knihy, $p_popis_knihy, $p_isbn){
        $sql = 'INSERT INTO books (jmeno, prijmeni, nazev_knihy, popis_knihy, isbn) VALUES (:jmeno, :prijmeni, :nazev_knihy, :popis_knihy, :isbn)';
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':jmeno', $p_jmeno, PDO::PARAM_STR);
        $stmt->bindParam(':prijmeni', $p_prijmeni, PDO::PARAM_STR);
        $stmt->bindParam(':nazev_knihy', $p_nazev_knihy, PDO::PARAM_STR);
        $stmt->bindParam(':popis_knihy', $p_popis_knihy, PDO::PARAM_INT);
        $stmt->bindParam(':isbn', $p_isbn, PDO::PARAM_INT);
        return $stmt->execute();
    }
}






?>