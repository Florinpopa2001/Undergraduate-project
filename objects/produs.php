<?php
 //product object
 class Produs
 {
    //database connection
    private $conn;
    private $table_name = "produse";

    //object properties
    public $id_produs;
    public $nume;
    public $descriere;
    public $pret;
    public $forma_farmaceutica;
    public $cantitate;
    public $category_id;
    public $category_name;
    public $timestamp;

    public function __construct($db){
        $this->conn = $db;
    }
 }