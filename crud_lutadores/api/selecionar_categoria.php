<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// API para inserir um lutador
require_once(__DIR__ . "/../model/Categoria.php");
require_once(__DIR__ . "/../controller/CategoriasController.php");

    // Chama o controller para salvar o lutador
    $categoriasCont = new CategoriasController();
    $categorias = $categoriasCont->listar();

echo json_encode($categorias, JSON_UNESCAPED_UNICODE);

